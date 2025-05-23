<?php
namespace App\Http\Controllers;
use App\Models\AuditTrail;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Message;
use App\Models\AvailableAppointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Mail\AppointmentSuccess;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index()
    {
        // Fetch all appointments
        $appointments = Appointment::all();
        // Return a view with the appointments data
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $availableAppointments = AvailableAppointment::all();
        return view('appointments.create', compact('availableAppointments'));
    }

    public function markAsRead($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            $appointment->updated_at = null;
            $appointment->save();
            return back()->with('success', 'Appointment marked as read.');
        }
        return back()->with('error', 'Appointment not found.');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'phone' => ['required', 'regex:/^09\d{9}$/'],
            'date' => 'required|date',
            'time' => 'required|string',
            'appointments' => 'required|array|min:1|max:3',
            'appointments.*' => 'string',
        ]);
        $selectedDate = $request->date;
        $time = $request->input('time', '00:00');

        if ($selectedDate < date('Y-m-d')) {
            return back()->withErrors(['error' => 'You cannot book an appointment for a past date.']);
        }
        
        $startOfMonth = date('Y-m-01', strtotime($selectedDate));
        $endOfMonth = date('Y-m-t', strtotime($selectedDate));
        
        $existingAppointment = Appointment::where('email', $user->email)
            // ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->whereIn('status', ['Pending'])
            ->exists();


        $existingCancelledAppointment = Appointment::where('email', $user->email)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->whereIn('status', ['Cancelled'])
            ->first();


        if ($existingAppointment) {
            return redirect()->route('calendar')->withErrors(['error' => 'You can only book one active pending.']);
        }
        
        // Check if the time slot exists
        $availableSlot = AvailableAppointment::where('date', $request->date)
            ->where('time_slot', $time)
            ->first();
            
        if (!$availableSlot) {
            return back()->withErrors(['error' => 'No available slots for the selected time.']);
        }

        if ($existingCancelledAppointment) {
            $existingCancelledAppointment->update([
                'status' => 'Pending',
                'date' => $request->date,
                'time' => $time,
                'appointments' => implode(', ', $request->input('appointments', [])),
            ]);

            return redirect()->route('calendar')->with('success', 'Your appointment has been rebooked.');
        }

        $appointment = Appointment::create([
            'patient_name' => $user->firstname . " " . $user->middleinitial . " " . $user->lastname,
            'user_id' => $user->id,
            'email' => $user->email,
            'doctor' => 'Ana Fatima Barroso',
            'status' => 'Pending',
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $time,
            'appointments' => implode(', ', $request->input('appointments', [])),
        ]);

        if ($appointment) {
            Message::create([
                'appointment_id' => $appointment->id,
                'message' => '',
                'user_id' => $request->user()->id,
            ]);
        } else {
            return back()->withErrors(['error' => 'Failed to create appointment.']);
        }
        
        // Send confirmation email
        Mail::to($user->email)->send(new AppointmentSuccess($user, $appointment));

        AuditTrail::create([
            'user_id' => $request->user()->id,
            'action' => 'Create Appointment',
            'model' => 'User',
            'changes' => null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);

        return redirect()->route('calendar')->with('success', 'Appointment successfully booked.');
    }

    public function graph()
    {
        $today = Carbon::today()->toDateString();
        $monthly = Carbon::now()->format('Y-m');

        $appointmentsToday = Appointment::whereDate('date', $today)->count();
        $remainingSlotsToday = max(0, 10 - $appointmentsToday); // Adjust max slots as needed

        $monthlyAppointments = Appointment::where('date', 'like', "$monthly%")->count();
        $remainingSlotsMonthly = max(0, 100 - $monthlyAppointments); // Adjust max slots as needed

        $appointmentsOverTime = Appointment::selectRaw("strftime('%m', date) as month, COUNT(*) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $item->month = date("F", mktime(0, 0, 0, $item->month, 1));
                return $item;
            });
            
        return view('admin.graph', compact(
            'appointmentsToday',
            'remainingSlotsToday',
            'monthlyAppointments',
            'remainingSlotsMonthly',
            'appointmentsOverTime'
        ));
    }
    
    
    public function storeAvailableAppointment(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'max_slots' => 'required|integer|min:1|max:2', // Limit to maximum 2 slots
        ]);
        
        // Create the available appointment slot
        AvailableAppointment::create([
            'date' => $request->date,
            'time_slot' => $request->time_slot,
            'max_slots' => $request->max_slots,
        ]);
        
        return back()->with('success', 'Appointment slot created successfully.');
    }
    
    public function updateAvailableAppointment(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'max_slots' => 'required|integer|min:1|max:2', // Limit to maximum 2 slots
        ]);
        
        $availableAppointment = AvailableAppointment::findOrFail($id);
        $availableAppointment->update([
            'date' => $request->date,
            'time_slot' => $request->time_slot,
            'max_slots' => $request->max_slots,
        ]);
        
        return back()->with('success', 'Appointment slot updated successfully.');
    }
}
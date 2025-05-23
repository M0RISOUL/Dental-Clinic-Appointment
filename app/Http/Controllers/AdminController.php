<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CareerJob;
use App\Models\Personnel;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; 
use App\Models\Appointment; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForInterview;


class AdminController extends Controller
{
    public function index() 
    {
        // Get appointment data for different time periods
        $appointmentData = [
            'thisWeek' => $this->getAppointmentData(now()->startOfWeek(), now()->endOfWeek()),
            'thisMonth' => $this->getAppointmentData(now()->startOfMonth(), now()->endOfMonth()),
            'last3Months' => $this->getAppointmentData(now()->subMonths(3)->startOfDay(), now()),
            'last6Months' => $this->getAppointmentData(now()->subMonths(6)->startOfDay(), now()),
            'thisYear' => $this->getAppointmentData(now()->startOfYear(), now()->endOfYear()),
        ];

        // Get patient registration data for different time periods
        $patientData = [
            'thisWeek' => $this->getPatientRegistrationData(now()->startOfWeek(), now()->endOfWeek()),
            'thisMonth' => $this->getPatientRegistrationData(now()->startOfMonth(), now()->endOfMonth()),
            'last3Months' => $this->getPatientRegistrationData(now()->subMonths(3)->startOfDay(), now()),
            'last6Months' => $this->getPatientRegistrationData(now()->subMonths(6)->startOfDay(), now()),
            'thisYear' => $this->getPatientRegistrationData(now()->startOfYear(), now()->endOfYear()),
        ];

        // Default to this week's data
        $currentAppointmentData = $appointmentData['thisWeek'];
        $currentPatientData = $patientData['thisWeek'];

        return view('admin.dashboard', compact(
            'appointmentData',
            'patientData',
            'currentAppointmentData',
            'currentPatientData'
        ));
    }
    
    
    /**
     * Get appointment data for a specific time period
     */
    private function getAppointmentData($startDate, $endDate)
    {
        $data = [];
        $currentDate = Carbon::parse($startDate);
        $endDateObj = Carbon::parse($endDate);
        
        // Determine if we should group by day, week, or month based on date range
        $diffInDays = $currentDate->diffInDays($endDateObj);
        
        if ($diffInDays <= 31) {
            // For short ranges, group by day
            while ($currentDate <= $endDateObj) {
                $label = $currentDate->format('M d');
                
                $pendingCount = Appointment::whereDate('date', $currentDate->format('Y-m-d'))
                    ->where('status', 'Pending')
                    ->count();
                    
                $approvedCount = Appointment::whereDate('date', $currentDate->format('Y-m-d'))
                    ->where('status', 'Approved')
                    ->count();
                    
                $attendedCount = Appointment::whereDate('date', $currentDate->format('Y-m-d'))
                    ->where('status', 'Attended')
                    ->count();
                
                $data['labels'][] = $label;
                $data['pending'][] = $pendingCount;
                $data['approved'][] = $approvedCount;
                $data['attended'][] = $attendedCount;
                
                $currentDate->addDay();
            }
        } else if ($diffInDays <= 180) {
            // For medium ranges, group by week
            while ($currentDate <= $endDateObj) {
                $weekStart = clone $currentDate;
                $weekEnd = clone $currentDate;
                $weekEnd->addDays(6);
                
                if ($weekEnd > $endDateObj) {
                    $weekEnd = clone $endDateObj;
                }
                
                $label = $weekStart->format('M d') . ' - ' . $weekEnd->format('M d');
                
                $pendingCount = Appointment::whereBetween('date', [
                        $weekStart->format('Y-m-d'), 
                        $weekEnd->format('Y-m-d')
                    ])
                    ->where('status', 'Pending')
                    ->count();
                    
                $approvedCount = Appointment::whereBetween('date', [
                        $weekStart->format('Y-m-d'), 
                        $weekEnd->format('Y-m-d')
                    ])
                    ->where('status', 'Approved')
                    ->count();
                    
                $attendedCount = Appointment::whereBetween('date', [
                        $weekStart->format('Y-m-d'), 
                        $weekEnd->format('Y-m-d')
                    ])
                    ->where('status', 'Attended')
                    ->count();
                
                $data['labels'][] = $label;
                $data['pending'][] = $pendingCount;
                $data['approved'][] = $approvedCount;
                $data['attended'][] = $attendedCount;
                
                $currentDate->addDays(7);
            }
        } else {
            // For long ranges, group by month
            while ($currentDate <= $endDateObj) {
                $label = $currentDate->format('M Y');
                
                $pendingCount = Appointment::whereYear('date', $currentDate->year)
                    ->whereMonth('date', $currentDate->month)
                    ->where('status', 'Pending')
                    ->count();
                    
                $approvedCount = Appointment::whereYear('date', $currentDate->year)
                    ->whereMonth('date', $currentDate->month)
                    ->where('status', 'Approved')
                    ->count();
                    
                $attendedCount = Appointment::whereYear('date', $currentDate->year)
                    ->whereMonth('date', $currentDate->month)
                    ->where('status', 'Attended')
                    ->count();
                
                $data['labels'][] = $label;
                $data['pending'][] = $pendingCount;
                $data['approved'][] = $approvedCount;
                $data['attended'][] = $attendedCount;
                
                $currentDate->addMonth();
            }
        }
        
        return $data;
    }

    /**
     * Get patient registration data for a specific time period
     */
    private function getPatientRegistrationData($startDate, $endDate)
    {
        $data = [];
        $currentDate = Carbon::parse($startDate);
        $endDateObj = Carbon::parse($endDate);
        
        $diffInDays = $currentDate->diffInDays($endDateObj);
        
        if ($diffInDays <= 31) {
            while ($currentDate <= $endDateObj) {
                $label = $currentDate->format('M d');
                
                $registrationCount = User::where('user_type', 'patient')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->count();
                
                $data['labels'][] = $label;
                $data['registrations'][] = $registrationCount;
                
                $currentDate->addDay();
            }
        } else if ($diffInDays <= 180) {
            // For medium ranges, group by week
            while ($currentDate <= $endDateObj) {
                $weekStart = clone $currentDate;
                $weekEnd = clone $currentDate;
                $weekEnd->addDays(6);
                
                if ($weekEnd > $endDateObj) {
                    $weekEnd = clone $endDateObj;
                }
                
                $label = $weekStart->format('M d') . ' - ' . $weekEnd->format('M d');
                
                $registrationCount = User::where('user_type', 'patient')
                    ->whereBetween('created_at', [
                        $weekStart->format('Y-m-d') . ' 00:00:00', 
                        $weekEnd->format('Y-m-d') . ' 23:59:59'
                    ])
                    ->count();
                
                $data['labels'][] = $label;
                $data['registrations'][] = $registrationCount;
                
                $currentDate->addDays(7);
            }
        } else {
            while ($currentDate <= $endDateObj) {
                $label = $currentDate->format('M Y');
                
                $registrationCount = User::where('user_type', 'patient')
                    ->whereYear('created_at', $currentDate->year)
                    ->whereMonth('created_at', $currentDate->month)
                    ->count();
                
                $data['labels'][] = $label;
                $data['registrations'][] = $registrationCount;
                
                $currentDate->addMonth();
            }
        }
        
        return $data;
    }

    // Add new staff or admin user
    public function store(Request $request) {
        Log::info('Request Data:', $request->all()); // Debugging
    
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middleinitial' => 'nullable|string|max:1',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'user_type' => 'required|string',
        ]);
    
        // Concatenate full name
        $fullName = trim("{$request->firstname} {$request->middleinitial} {$request->lastname}");
    
        // Create user
        $user = User::create([
            'name' => $fullName,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type
        ]);
    
        Log::info('User Created:', ['id' => $user->id, 'email' => $user->email]); // Debugging
    
        return redirect()->route('admin.users')->with('success', 'Registration successful. Please verify your email.');
    
        return back()->with('error', 'Failed to create user.');
    }
    
    
    public function jobs()
    {
        $jobs = CareerJob::all()->filter(function ($job) {
            $hiredCount = JobApplication::where('job_id', $job->id)->where('status', 'hired')->count();
            // Calculate the remaining vacancies
            $vacancyCount = $job->vacancy - $hiredCount;
            // Only return jobs with vacancies left
            return $vacancyCount > 0;
        });

        $applications = JobApplication::all();
        return view('admin.jobs', compact('jobs', 'applications'));
    }

    public function hire($id)
    {
        $job = JobApplication::find($id);
    
        if (!$job) {
            return redirect()->back()->with('error', 'Job not found.');
        }
    
        $job->status = 'For Interview';
        $job->save();
    
        // Message content for the interview invitation
        $message = 'You are invited for an interview regarding your job application. Please wait for our team to contact you with the schedule and venue.';
    
        // Check and send email
        if (!empty($job->email)) {
            $status = 'For Interview'; // Displayed in the email (used as a badge/class)
    
            $applicantName = $job->full_name ?? 'Applicant'; // Adjust based on your DB column
    
            Mail::to($job->email)->send(
                new ForInterview($message, $status, $applicantName)
            );
        }
    
        return redirect()->back()->with('success', 'Interview invitation sent to the applicant.');
    }


    public function storejob(Request $request)
    {
        $validatedData = $request->validate([
            'jobTitle' => 'required|string|max:255',
            // 'jobLocation' => 'required|string|max:255',
            // 'jobType' => 'required|string|in:Remote,Onsite',
            'vacancy' => 'required|integer|min:1',
            'jobExperience' => 'required|integer|min:0',
            'jobDescription' => 'required|string',
            'salaryRange' => 'required|integer|min:0|max:250000',
        ]);

        $jobData = [
            'title' => $validatedData['jobTitle'],
            // 'location' => $validatedData['jobLocation'],
            // 'jobtype' => $validatedData['jobType'],
            'vacancy' => $validatedData['vacancy'],
            'workexperience' => $validatedData['jobExperience'],
            'description' => $validatedData['jobDescription'],
            'salary' => $validatedData['salaryRange'],
        ];

        CareerJob::create(attributes: $jobData);
        return redirect()->back()->with('success', 'Job added successfully.');
    }

    public function updatejob(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jobTitle' => 'required|string|max:255',
            // 'jobLocation' => 'required|string|max:255',
            // 'jobType' => 'required|string|in:Remote,Onsite',
            'vacancy' => 'required|integer|min:1',
            'jobExperience' => 'required|integer|min:0',
            'jobDescription' => 'required|string',
            'salaryRange' => 'required|integer|min:0|max:250000',
        ]);

        $job = CareerJob::findOrFail($id);
        $job->update([
            'title' => $validatedData['jobTitle'],
            // 'location' => $validatedData['jobLocation'],
            // 'jobtype' => $validatedData['jobType'],
            'vacancy' => $validatedData['vacancy'],
            'workexperience' => $validatedData['jobExperience'],
            'description' => $validatedData['jobDescription'],
            'salary' => $validatedData['salaryRange'],
        ]);

        return redirect()->back()->with('success', 'Job updated successfully.');
    }
    
     public function personnel()
    {
        $personnel = Personnel::whereNotIn('name', ['Ana Fatima Barroso'])->get();
        $doctor = Personnel::find(1);
        return view('admin.personnel', compact('personnel', 'doctor'));
    }
    public function updatepersonnel(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',  // Description should be nullable
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:250',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $personnel = Personnel::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('personnel', $filename, 'public');

            if ($personnel->image && Storage::disk('public')->exists($personnel->image)) {
                Storage::disk('public')->delete($personnel->image);
            }

            $validatedData['image'] = $path;
        }

        // Update the personnel with the validated data
        $personnel->update($validatedData);

        // Redirect back with success message
        return back()->with('success', 'Personnel updated successfully.');
    }


    public function storepersonnel(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:250',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('personnel', $filename, 'public');
            $validatedData['image'] = $path;
        }
        Personnel::create($validatedData);
        return back()->with('success', 'Personnel added successfully.');
    }
    
    public function deletePersonnel($id)
    {
        $person = Personnel::find($id);
        if (!$person) {
            return redirect()->back()->with('error', 'Personnel not found.');
        }
        $person->delete();
        return redirect()->back()->with('success', 'Personnel deleted successfully.');
    }


    public function deletejob($id)
    {
        $job = CareerJob::find($id);
        if (!$job) {
            return redirect()->back()->with('error', 'Personnel not found.');
        }
        $job->delete();
        return redirect()->back()->with('success', 'Personnel deleted successfully.');
    }
    
    

    public function users() 
    {
        return view('admin.users');
    }

    public function reports() 
    {
        return view('admin.reports');
    }

    public function approvedAppointments() 
    {
        return view('admin.approved_appointments');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use App\Models\Message;
use App\Models\AvailableAppointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\get;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\File;
use App\Models\Review;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $userEmail = Auth::user()->email;
        $user = Auth::user();
        $query = AuditTrail::with('user')->orderBy('created_at', 'desc');

         $monthlyAppointments = DB::table('appointments')
                ->selectRaw("DATE_FORMAT(date, '%m') as month, COUNT(*) as count")
                ->groupBy(DB::raw("DATE_FORMAT(date, '%m')"))
                ->orderBy('month')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [Carbon::create()->month(intval($item->month))->format('M') => $item->count];
                });

        $monthlyCategories = $monthlyAppointments->keys();
        $monthlyData = $monthlyAppointments->values();


      $dailyAppointments = Appointment::where('email', auth()->user()->email)
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy(DB::raw('DATE(created_at)'))  // Group by the full expression
        ->pluck('count', 'date');


        $availableDates = AvailableAppointment::count();
        $currentAppointments = AvailableAppointment::whereDate('date', (Carbon::today()))->count();
        $cancelledAppointments = Appointment::where('status', 'Cancelled')
            ->where('user_id', $user->id)
            ->count();

        $auditTrails = AuditTrail::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(15)
            ->get();

        $search = $request->input('search');
        $allauditTrails = AuditTrail::where('user_id', Auth::id())
            ->with('user')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('action', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('firstname', 'like', "%{$search}%")
                                ->orWhere('lastname', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        if ($request->has('auditModal')) {
            session(['audit_modal_open' => true]);
        }


        $today = Carbon::now()->timezone('Asia/Singapore')->toDateString();
        $availableAppointments = AvailableAppointment::whereDate('date', $today)
            ->orderBy('date', 'desc')
            ->get();


        $appointmentCategories = Appointment::where('email', Auth::user()->email)
            ->whereIn('status', ['Attended'])
            ->get()
            ->groupBy('appointments')
            ->map(function ($group) {
                return $group->count();
            });

        // ATTENDANCE RATE CALCULATION
        $approvedCount = Appointment::where('email', $userEmail)
            ->where('status', 'Approved')
            ->count();

        $attendedCount = Appointment::where('email', $userEmail)
            ->where('status', 'Attended')
            ->count();

        $totalEligible = $approvedCount + $attendedCount;
        $attendanceRate = $totalEligible > 0 ? ($attendedCount / $totalEligible) * 100 : 0;

        $totalAppointments = Appointment::where('email', auth()->user()->email)->count();
        $upcomingappointment = Appointment::where('status', 'Approved')

            ->whereRaw("time LIKE '% - %'")
            ->orderByRaw("time ASC")
            ->first();

        $timeRange = $upcomingappointment->time ?? '';
        $times = explode(' - ', $timeRange);

        $start_time = $times[0] ?? null;
        $end_time = $times[1] ?? null;

        return view('dashboard', compact(
            'search',
            'allauditTrails',
            'auditTrails',
            'user',
            'dailyAppointments',
            'monthlyCategories',
            'monthlyData',
            'availableAppointments',
            'availableDates',
            'appointmentCategories',
            'currentAppointments',
            'totalAppointments',
            'attendanceRate',
            'cancelledAppointments',
            'attendedCount',
            'totalEligible',
            'upcomingappointment',
            'start_time',
            'end_time'
        ));
    }

    public function bookappointment($id)
    {
        $user = Auth::user();
        $appointment = AvailableAppointment::find($id);

        $services = [
            "Braces" => [
                "Metal Braces",
                "Free Consultation",
                "Free Monthly Oral Prophylaxis/Cleaning",
                "Free Photo Analysis",
                "Free Intraoral Photos",
                "Free Diagnostic Cast",
                "Free 1 set Ortho Wax",
                "Free Interdental Brush",
                "Referral Deductions"
            ],
            "Teeth Whitening" => ["Teeth Whitening"],
            "General Procedures" => [
                "Oral Prophylaxis",
                "Fluoride Treatment",
                "Tooth Filling/Pasta",
                "Anterior Tooth Filling/Pasta sa unahan",
                "Tooth Extraction",
                "Odontectomy/Wisdom Tooth Removal"
            ],
            "Dentures" => [
                "Complete Denture" => ["Ordinary", "Ivocap", "Thermosens"],
                "Partial Denture" => [
                    "Ordinary Denture US Plastic" => [
                        "1-2 units",
                        "3-4 units",
                        "5 and above",
                        "CD per arch"
                    ],
                    "IVOSTAR" => [
                        "1-2 units",
                        "3-4 units",
                        "5 and above",
                        "CD per arch"
                    ],
                    "FLEXITE" => [
                        "1-2 Units unilateral",
                        "2-3 Units bilateral",
                        "4-10 Units bilateral",
                        "10-12 Units bilateral"
                    ]
                ]
            ],
            "Fixed Bridge and Crowns" => [
                "Porcelain with Metal",
                "Porcelain with Tilite",
                "Emax",
                "Zirconia",
                "Temporary Plastic Crown"
            ],
            "Maryland Bridge" => ["Plastic", "Porcelain with Metal"],
            "Veneers" => ["Ceramage", "Emax"],
            "Retainers" => [
                "Retainers",
                "Promo for braces patient",
                "If outside patient"
            ],
            "X-ray" => ["Periapical X-ray"],
            "Root Canal Treatment" => [
                "Anterior Only",
                "Preop Periapical X-ray",
                "Restoration Buildup"
            ]
        ];
        
        
        
        
        return view('patient.bookappointment', compact('appointment', 'user', 'services'));
    }

    public function fetchAppointments($date)
    {
        $userEmail = auth()->user()->email;
        $now = Carbon::now();
        $year = $now->format('Y');
        $holidayDates = collect(Http::get("https://date.nager.at/api/v3/PublicHolidays/{$year}/PH")->json())
            ->pluck('date')
            ->toArray();

       $appointments = AvailableAppointment::where(function ($query) use ($date, $now) {
        $query->whereDate('date', '>=', $now->toDateString())
            ->orWhere(function ($q) use ($now) {
                $q->whereDate('date', $now->toDateString())
                    ->whereTime('time_slot', '>', $now->toTimeString());
                    });
            })
            ->whereRaw('(max_slots - (SELECT COUNT(*) FROM appointments WHERE appointments.date = available_appointments.date AND appointments.time = available_appointments.time_slot AND appointments.status IN ("Pending", "Approved", "Attended"))) >= 0')
            ->where('date', $date)
            ->get()
            ->filter(function ($slot) use ($holidayDates, $userEmail) {
                $slotDate = Carbon::parse($slot->date)->format('Y-m-d');
                if (in_array($slotDate, $holidayDates)) {
                    return false;
                }
                if (Carbon::parse($slot->date)->isSunday()) {
                    return false;
                }
                $bookedCount = Appointment::where('date', $slot->date)
                    ->where('time', $slot->time_slot)
                    ->whereIn('status', ['Pending', 'Approved', 'Attended'])
                    ->count();

                $appointmentExists = Appointment::where('date', $slot->date)
                    ->where('time', $slot->time_slot)
                    ->whereIn('status', ['Pending', 'Approved', 'Attended', 'Unattended'])
                    ->where('email', $userEmail)
                    ->exists();

                $slot->remaining_slots = max(($slot->max_slots ?? 0) - $bookedCount, 0);
                $slot->appointment_exists = $appointmentExists;

                return true;
            })
            ->map(function ($slot) {
                return $slot;
            });

        return response()->json($appointments);
    }
    
    
    public function fetchHolidays($year)
    {
        $url = "https://date.nager.at/api/v3/PublicHolidays/{$year}/PH";
        
        try {
            $response = Http::get($url);
            \Log::info('Response Status:', ['status' => $response->status()]);  // Log the response status
            \Log::info('Response Body:', ['body' => $response->body()]);  // Log the response body
    
            if ($response->failed()) {
                return response()->json(['error' => 'Failed to fetch holidays from API'], 500);
            }
    
            $holidays = $response->json();
            return response()->json($holidays);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching holidays:', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while fetching holidays'], 500);
        }
    }


    public function calendar(Request $request)
    {
        $userEmail = Auth::user()->email;
        $timezone = 'Asia/Singapore';
        $now = Carbon::now()->format('H:i:s');

        $selectedDate = $request->input('hiddenselectedDate');
        Log::info('Received Selected Date: ' . ($selectedDate ?? 'None'));
        if (!empty($selectedDate)) {
            $selectedDate = date('Y-m-d', strtotime($selectedDate));
        } else {
            $selectedDate = null;
        }

        $appointments = Appointment::where('email', $userEmail)
            ->select('id', 'patient_name', 'phone', 'date', 'time', 'status')
            ->get();

        $availableappointments = $selectedDate
            ? AvailableAppointment::where('date', $selectedDate)
                ->select('date', 'time_slot', 'max_slots')
                ->get()
                ->map(function ($appointment) use ($selectedDate) {
                    $bookedSlots = Appointment::where('date', $selectedDate)
                        ->where('time', $appointment->time_slot)
                        ->where('status', 'Pending')
                        ->count();
                    $appointment->remaining_slots = max(0, $appointment->max_slots - $bookedSlots);
                    return $appointment;
                })
            : collect();


        $now = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
        
        $allData = AvailableAppointment::all()->filter(function ($slot) use ($now) {
        [$start, $end] = explode(' - ', $slot->time_slot);
        
        $year = Carbon::now()->format('Y');
        $date = Carbon::parse($slot->date)->format('Y-m-d'); // Ensure correct format
    
        $holidayDates = collect(Http::get("https://date.nager.at/api/v3/PublicHolidays/{$year}/PH")->json())
            ->pluck('date')
            ->toArray();
        if (in_array($date, $holidayDates)) {
            return false;
        }
        if (Carbon::parse($date)->isSunday()) {
            return false;
        }
        $bookedSlots = Appointment::where('date', $slot->date)
            ->where('time', $slot->time_slot)
            ->whereIn('status', ['Pending', 'Approved', 'Attended'])
            ->count();
        $remainingSlots = max(0, $slot->max_slots - $bookedSlots);

        if ($remainingSlots <= 0) {
            return false;
        }
    
        try {
            $endDateTime = Carbon::createFromFormat('Y-m-d g:i A', "$date " . trim($end), 'Asia/Manila')
                ->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            dump("Error in conversion:", $slot->time_slot, $date, $end, $e->getMessage());
            return false;
        }
    
        return $endDateTime > $now;
    });




        $remainingSlotsByDate = [];  //FOR SLOTS AVAILABILITY
        
        foreach ($allData as $appointment) {
            $date = $appointment['date'];
            $timeSlot = $appointment['time_slot'];
            $maxSlots = $appointment['max_slots'];
            $bookedSlots = Appointment::where('date', $date)
                ->where('time', $timeSlot)
                ->whereIn('status', ['Pending', 'Approved', 'Attended'])
                ->count();
            $remainingSlots = max(0, $maxSlots - $bookedSlots);

            if (!isset($remainingSlotsByDate[$date])) {
                $remainingSlotsByDate[$date] = 0;
            }
            $remainingSlotsByDate[$date] += $remainingSlots;
        }
        $availableslots = $availableappointments->sum('remaining_slots');

        return view('patient.calendar', compact('appointments', 'allData', 'remainingSlotsByDate', 'availableappointments', 'selectedDate', 'availableslots'));
    }

    public function pricing()
    {
        // Get all pricing settings from the Setting model
        $settings = [
            // Braces
            'braces_type' => \App\Models\Setting::get('braces_type', 'Metal Braces'),
            'braces_low_dp_promo' => \App\Models\Setting::get('braces_low_dp_promo', 4000),
            'braces_monthly_adjustment' => \App\Models\Setting::get('braces_monthly_adjustment', 1000),
            'braces_total_package' => \App\Models\Setting::get('braces_total_package', 50000),
            'braces_inclusions' => json_decode(\App\Models\Setting::get('braces_inclusions', json_encode([
                "Free Consultation",
                "Free Monthly Oral Prophylaxis/Cleaning",
                "Free Photo Analysis",
                "Free Intraoral Photos",
                "Free Diagnostic Cast",
                "Free 1 set Ortho Wax",
                "Free interdental brush",
                "With referral deductions",
                "50% off Teeth Whitening after case",
                "Same day installation is possible but not guaranteed depending upon the case"
            ]))),
            
            // General Procedure
            'general_oral_prophylaxis' => \App\Models\Setting::get('general_oral_prophylaxis', 'starting ₱500'),
            'general_fluoride_treatment' => \App\Models\Setting::get('general_fluoride_treatment', 'starting ₱500'),
            'general_tooth_filling' => \App\Models\Setting::get('general_tooth_filling', 'starting ₱500'),
            'general_anterior_tooth_filling' => \App\Models\Setting::get('general_anterior_tooth_filling', 'minimum ₱800'),
            'general_tooth_extraction' => \App\Models\Setting::get('general_tooth_extraction', 'starting ₱500'),
            'general_odontectomy_wisdom_tooth_removal' => \App\Models\Setting::get('general_odontectomy_wisdom_tooth_removal', 'starting ₱5000'),
            
            // Teeth Whitening
            'whitening_description' => \App\Models\Setting::get('whitening_description', 'Teeth Whitening with FREE Cleaning'),
            'whitening_original_price' => \App\Models\Setting::get('whitening_original_price', 10000),
            'whitening_promo_price' => \App\Models\Setting::get('whitening_promo_price', 7000),
            
            // Dentures - Complete
            'dentures_complete_ordinary_per_arch' => \App\Models\Setting::get('dentures_complete_ordinary_per_arch', 6000),
            'dentures_complete_ordinary_upper_lower' => \App\Models\Setting::get('dentures_complete_ordinary_upper_lower', 12000),
            'dentures_complete_ivocap_per_arch' => \App\Models\Setting::get('dentures_complete_ivocap_per_arch', 20000),
            'dentures_complete_ivocap_upper_lower' => \App\Models\Setting::get('dentures_complete_ivocap_upper_lower', 40000),
            'dentures_complete_thermosens_per_arch' => \App\Models\Setting::get('dentures_complete_thermosens_per_arch', 15000),
            'dentures_complete_thermosens_upper_lower' => \App\Models\Setting::get('dentures_complete_thermosens_upper_lower', 30000),
            
            // Dentures - Partial
            'dentures_partial_ordinary_1_2_units' => \App\Models\Setting::get('dentures_partial_ordinary_1_2_units', 2500),
            'dentures_partial_ordinary_3_4_units' => \App\Models\Setting::get('dentures_partial_ordinary_3_4_units', 3500),
            'dentures_partial_ordinary_5_and_above' => \App\Models\Setting::get('dentures_partial_ordinary_5_and_above', 6000),
            'dentures_partial_ordinary_cd_per_arch' => \App\Models\Setting::get('dentures_partial_ordinary_cd_per_arch', 7000),
            'dentures_partial_ivostar_1_2_units' => \App\Models\Setting::get('dentures_partial_ivostar_1_2_units', 5000),
            'dentures_partial_ivostar_3_4_units' => \App\Models\Setting::get('dentures_partial_ivostar_3_4_units', 7000),
            'dentures_partial_ivostar_5_and_above' => \App\Models\Setting::get('dentures_partial_ivostar_5_and_above', 10000),
            'dentures_partial_ivostar_cd_per_arch' => \App\Models\Setting::get('dentures_partial_ivostar_cd_per_arch', 12000),
            'dentures_partial_flexite_1_2_units_unilateral' => \App\Models\Setting::get('dentures_partial_flexite_1_2_units_unilateral', 8000),
            'dentures_partial_flexite_2_3_units_bilateral' => \App\Models\Setting::get('dentures_partial_flexite_2_3_units_bilateral', 10000),
            'dentures_partial_flexite_4_10_units_bilateral' => \App\Models\Setting::get('dentures_partial_flexite_4_10_units_bilateral', 15000),
            'dentures_partial_flexite_10_12_units_bilateral' => \App\Models\Setting::get('dentures_partial_flexite_10_12_units_bilateral', 20000),
            
            // Fixed Bridge and Crowns
            'fixed_porcelain_with_metal' => \App\Models\Setting::get('fixed_porcelain_with_metal', 6000),
            'fixed_porcelain_with_tilite' => \App\Models\Setting::get('fixed_porcelain_with_tilite', 10000),
            'fixed_emax' => \App\Models\Setting::get('fixed_emax', 15000),
            'fixed_zirconia' => \App\Models\Setting::get('fixed_zirconia', 20000),
            'fixed_temporary_plastic_crown' => \App\Models\Setting::get('fixed_temporary_plastic_crown', 2500),
            'fixed_maryland_bridge_plastic' => \App\Models\Setting::get('fixed_maryland_bridge_plastic', 3500),
            'fixed_maryland_bridge_porcelain_with_metal' => \App\Models\Setting::get('fixed_maryland_bridge_porcelain_with_metal', 5000),
            
            // Veneers
            'veneers_ceramage' => \App\Models\Setting::get('veneers_ceramage', 7000),
            'veneers_emax' => \App\Models\Setting::get('veneers_emax', 15000),
            
            // Retainers
            'retainers_standard_per_arch' => \App\Models\Setting::get('retainers_standard_per_arch', 5000),
            'retainers_standard_per_tooth' => \App\Models\Setting::get('retainers_standard_per_tooth', 250),
            'retainers_promo_braces_patient_per_arch' => \App\Models\Setting::get('retainers_promo_braces_patient_per_arch', 3000),
            'retainers_promo_braces_patient_per_tooth' => \App\Models\Setting::get('retainers_promo_braces_patient_per_tooth', 250),
            'retainers_outside_patient_per_arch' => \App\Models\Setting::get('retainers_outside_patient_per_arch', 5000),
            'retainers_outside_patient_per_tooth' => \App\Models\Setting::get('retainers_outside_patient_per_tooth', 250),
            
            // X-ray
            'xray_periapical' => \App\Models\Setting::get('xray_periapical', 500),
            
            // Root Canal Treatment
            'rct_anterior_preop_periapical_xray' => \App\Models\Setting::get('rct_anterior_preop_periapical_xray', 500),
            'rct_anterior_per_canal' => \App\Models\Setting::get('rct_anterior_per_canal', 8000),
            'rct_anterior_includes' => \App\Models\Setting::get('rct_anterior_includes', 'All xray and restoration buildup'),
            
            // Page Content
            'pricing_title' => \App\Models\Setting::get('pricing_title', 'Affordable Dental Clinic Pricing'),
            'pricing_description' => \App\Models\Setting::get('pricing_description', 'Discover our comprehensive dental services designed to give you a healthy, confident smile. We offer transparent pricing, exceptional care, and personalized treatment plans tailored to your unique needs.'),
        ];
        
        // Create structured data for the view
        $braces = [
            "type" => $settings['braces_type'],
            "low_dp_promo" => $settings['braces_low_dp_promo'],
            "monthly_adjustment" => $settings['braces_monthly_adjustment'],
            "total_package" => $settings['braces_total_package'],
            "inclusions" => $settings['braces_inclusions']
        ];
    
        $generalProcedure = [
            "oral_prophylaxis" => $settings['general_oral_prophylaxis'],
            "fluoride_treatment" => $settings['general_fluoride_treatment'],
            "tooth_filling" => $settings['general_tooth_filling'],
            "anterior_tooth_filling" => $settings['general_anterior_tooth_filling'],
            "tooth_extraction" => $settings['general_tooth_extraction'],
            "odontectomy_wisdom_tooth_removal" => $settings['general_odontectomy_wisdom_tooth_removal']
        ];
    
        $teethWhitening = [
            "description" => $settings['whitening_description'],
            "original_price" => $settings['whitening_original_price'],
            "promo_price" => $settings['whitening_promo_price']
        ];
    
        $dentures = [
            "complete_denture" => [
                "ordinary" => [
                    "per_arch" => $settings['dentures_complete_ordinary_per_arch'],
                    "upper_lower" => $settings['dentures_complete_ordinary_upper_lower']
                ],
                "ivocap" => [
                    "per_arch" => $settings['dentures_complete_ivocap_per_arch'],
                    "upper_lower" => $settings['dentures_complete_ivocap_upper_lower']
                ],
                "thermosens" => [
                    "per_arch" => $settings['dentures_complete_thermosens_per_arch'],
                    "upper_lower" => $settings['dentures_complete_thermosens_upper_lower']
                ]
            ],
            "partial_denture" => [
                "ordinary_us_plastic" => [
                    "1-2_units" => $settings['dentures_partial_ordinary_1_2_units'],
                    "3-4_units" => $settings['dentures_partial_ordinary_3_4_units'],
                    "5_and_above" => $settings['dentures_partial_ordinary_5_and_above'],
                    "cd_per_arch" => $settings['dentures_partial_ordinary_cd_per_arch']
                ],
                "ivostar" => [
                    "1-2_units" => $settings['dentures_partial_ivostar_1_2_units'],
                    "3-4_units" => $settings['dentures_partial_ivostar_3_4_units'],
                    "5_and_above" => $settings['dentures_partial_ivostar_5_and_above'],
                    "cd_per_arch" => $settings['dentures_partial_ivostar_cd_per_arch']
                ],
                "flexite" => [
                    "1-2_units_unilateral" => $settings['dentures_partial_flexite_1_2_units_unilateral'],
                    "2-3_units_bilateral" => $settings['dentures_partial_flexite_2_3_units_bilateral'],
                    "4-10_units_bilateral" => $settings['dentures_partial_flexite_4_10_units_bilateral'],
                    "10-12_units_bilateral" => $settings['dentures_partial_flexite_10_12_units_bilateral']
                ]
            ]
        ];
    
        $fixedBridgeAndCrowns = [
            "porcelain_with_metal" => $settings['fixed_porcelain_with_metal'],
            "porcelain_with_tilite" => $settings['fixed_porcelain_with_tilite'],
            "emax" => $settings['fixed_emax'],
            "zirconia" => $settings['fixed_zirconia'],
            "temporary_plastic_crown" => $settings['fixed_temporary_plastic_crown'],
            "maryland_bridge" => [
                "plastic" => $settings['fixed_maryland_bridge_plastic'],
                "porcelain_with_metal" => $settings['fixed_maryland_bridge_porcelain_with_metal']
            ]
        ];
    
        $veneers = [
            "ceramage" => $settings['veneers_ceramage'],
            "emax" => $settings['veneers_emax']
        ];
    
        $retainers = [
            "standard" => [
                "per_arch" => $settings['retainers_standard_per_arch'],
                "per_tooth" => $settings['retainers_standard_per_tooth']
            ],
            "promo_if_braces_patient" => [
                "per_arch" => $settings['retainers_promo_braces_patient_per_arch'],
                "per_tooth" => $settings['retainers_promo_braces_patient_per_tooth']
            ],
            "outside_patient" => [
                "per_arch" => $settings['retainers_outside_patient_per_arch'],
                "per_tooth" => $settings['retainers_outside_patient_per_tooth']
            ]
        ];
    
        $xray = [
            "periapical" => $settings['xray_periapical']
        ];
    
        $rootCanalTreatment = [
            "anterior_only" => [
                "preop_periapical_xray" => $settings['rct_anterior_preop_periapical_xray'],
                "per_canal" => $settings['rct_anterior_per_canal'],
                "includes" => $settings['rct_anterior_includes']
            ]
        ];
    
        // Pass the title and description directly
        $pricing_title = $settings['pricing_title'];
        $pricing_description = $settings['pricing_description'];
    
        return view('patient.pricing', compact(
            'braces', 
            'generalProcedure', 
            'teethWhitening', 
            'dentures', 
            'fixedBridgeAndCrowns', 
            'veneers', 
            'retainers', 
            'xray', 
            'rootCanalTreatment',
            'pricing_title',
            'pricing_description'
        ));
    }


        public function storeReview(Request $request, $id)
        {
            $request->validate([
                'review' => 'required|string',
                'rating_input' => 'required|integer|min:1|max:5',
            ]);
        
            $appointment = Appointment::findOrFail($id);
            
            // Check if user has already reviewed this appointment
            $existingReview = Review::where('user_id', Auth::id())
                                    ->where('appointment_id', $appointment->id)
                                    ->first();
            
            if ($existingReview) {
                return back()->with('error', 'You have already submitted a review for this appointment.');
            }
            
            $response = Http::post(config('services.huggingface.url'), [
                'text' => $request->review
            ]);
        
            $sentimentData = $response->json();
            
            // Create review
            Review::create([
                'user_id' => Auth::id(),
                'appointment_id' => $appointment->id,
                'service' => $appointment->appointments,
                'review' => $request->review,
                'rating' => $request->rating_input,
                'sentiment' => $sentimentData['sentiment'] ?? 'neutral',
                'probability' => $sentimentData['confidence_score'] ?? 0.0,
            ]);
        
            return back()->with('success', 'Review submitted successfully!');
        }

    public function history(Request $request)
    {
        $userEmail = Auth::user()->email;
        $filterDate = $request->input('date');
        $filterStatus = $request->input('status');
        $now = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');

        $appointments = Appointment::where('email', $userEmail)
            ->when($filterDate, function ($query, $filterDate) {
                return $query->whereDate('date', $filterDate);
            })
            ->when($filterStatus, function ($query, $filterStatus) {
                return $query->where('status', $filterStatus);
            })
            ->select('id', 'patient_name', 'phone', 'date', 'time', 'status', 'appointments')
            ->get();

        $isEmpty = $appointments->isEmpty();


        $availableAppointments = AvailableAppointment::whereDate('date', '>=', Carbon::today()->toDateString()) // Include today
            ->get()
            ->filter(function ($slot) use ($now) {
                [$start, $end] = explode(' - ', $slot->time_slot);
                $date = Carbon::parse($slot->date)->format('Y-m-d');

                try {
                    $endDateTime = Carbon::createFromFormat('Y-m-d g:i A', "$date " . trim($end), 'Asia/Manila')
                        ->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    dump("Error in conversion:", $slot->time_slot, $date, $end, $e->getMessage());
                    return false;
                }

                return $endDateTime > $now;
            })
            ->map(function ($slot) {
                $pendingCount = Appointment::whereDate('date', $slot->date)
                    ->where('time', $slot->time_slot)
                    ->whereIn('status', ['Pending', 'Approved', 'Attended'])
                    ->count();

                $remainingSlots = max($slot->max_slots - $pendingCount, 0); // Ensure no negative values
    
                return [
                    'id' => $slot->id,
                    'date' => $slot->date,
                    'time_slot' => $slot->time_slot,
                    'remaining_slots' => $remainingSlots,
                ];
            })
            ->toArray();
        return view('patient.history', compact('availableAppointments', 'appointments', 'isEmpty', 'filterDate', 'filterStatus'));
    }

    //For Displaying the Modal Details 
    public function viewHistory($appointmentId)
    {
            
        $user_id = Auth::user()->id;

         $appointment = Appointment::where('id', $appointmentId)
            ->where('user_id', $user_id)
            ->select('id', 'user_id', 'patient_name', 'phone', 'date', 'time', 'status', 'appointments')
            ->firstOrFail();
        
        $userMessage = Message::where('appointment_id', $appointmentId)
            ->select('message')
            ->first();


        return response()->json([
            'appointment' => $appointment,
            'message' => $userMessage ? $userMessage->message : 'No message available.',
        ]);
    }

    public function cancelAppointment($id)
    {
        //FOR CANCELLING APPOINTMENTS
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Cancelled';
        $appointment->save();
        return redirect()->back()->with('error', value: 'Appointment has been cancelled successfully!');
    }


    public function updateAppointment(Request $request, $id)
    {
        $request->validate([
            'reschedule_appointments.*' => 'exists:appointments,id',
        ]);
        $newAppointmentId = $request->input('reschedule_appointments');
        $oldAppointment = Appointment::findOrFail($id);
        $newAppointment = AvailableAppointment::findOrFail($newAppointmentId);
        $oldAppointment->date = $newAppointment->date;
        $oldAppointment->time = $newAppointment->time_slot;
        $oldAppointment->status = 'Pending';
        $oldAppointment->save();

        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'action' => 'Rescheduled an Appointment',
            'model' => 'User',
            'changes' => null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);

        return redirect()->back()->with('success', 'Appointment has been updated successfully!');
    }

    //Reschedule
    public function getAvailableSlots(Request $request)
    {
        $selectedDate = $request->input('date');
        if (!$selectedDate) {
            return response()->json(['error' => 'Date not provided'], 400);
        }

        $availableappointments = AvailableAppointment::where('date', $selectedDate)
            ->select('time_slot', 'max_slots')
            ->get()
            ->map(function ($appointment) use ($selectedDate) {
                // Count how many appointments are booked for this slot
                $bookedSlots = Appointment::where('date', $selectedDate)
                    ->where('time', $appointment->time_slot)
                    ->whereIn('status', ['pending', 'approved'])
                    ->count();

                // Deduct booked slots from max slots to get remaining slots
                $appointment->remaining_slots = max(0, $appointment->max_slots - $bookedSlots);
                return $appointment;
            });

        return response()->json($availableappointments);
    }

    public function reschedule(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'selectedDate' => 'required|date',
            'time' => 'required|string',
        ]);

        // Find the appointment to reschedule
        $appointment = Appointment::findOrFail($id);

        // Parse the new date and time
        $newDate = Carbon::parse($request->input('selectedDate'))->format('Y-m-d');
        $newTime = $request->input('time');

        // Check if the selected slot exists
        $availableSlot = AvailableAppointment::where('date', $newDate)
            ->where('time_slot', $newTime)
            ->first();

        if (!$availableSlot) {
            return redirect()->back()->with('error', 'The selected time slot is not available.');
        }

        // Count booked slots for the selected date and time
        $bookedSlots = Appointment::where('date', $newDate)
            ->where('time', $newTime)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        // Check if the slot is fully booked
        if ($bookedSlots >= $availableSlot->max_slots) {
            return redirect()->back()->with('error', 'The selected time slot is fully booked.');
        }

        // Update only the date and time of the appointment
        $appointment->update([
            'date' => $newDate,
            'time' => $newTime,
            'status' => 'Pending', // Reset status to pending for approval
        ]);

        // Log the change in the audit trail
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'action' => 'Rescheduled Appointment',
            'model' => 'Appointment',
            'changes' => json_encode(['new_date' => $newDate, 'new_time' => $newTime]),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return redirect()->back()->with('success', 'Appointment rescheduled successfully.');
    }


}

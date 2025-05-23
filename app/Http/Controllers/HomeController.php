<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use App\Models\CareerJob;
use App\Models\JobApplication;
use App\Models\Personnel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

public function about()
{
    // Get all about page settings
    $settings = [
        // Hero Section
        'about_hero_title' => Setting::get('about_hero_title', 'About ANA FATIMA BARROSO'),
        'about_hero_subtitle' => Setting::get('about_hero_subtitle', 'Dental Clinic'),
        'about_hero_description' => Setting::get('about_hero_description', 'Where advanced dental care meets compassionate service. Our mission is to provide exceptional dental care in a comfortable and welcoming environment.'),
        
        // Main Content
        'about_main_title' => Setting::get('about_main_title', 'Experience Excellence in Dental Care'),
        'about_main_description' => Setting::get('about_main_description', 'At ANA FATIMA BARROSO Dental Clinic, we combine state-of-the-art technology with gentle, personalized care. Our commitment to your oral health goes beyond treating teeth – we create beautiful, confident smiles that last a lifetime.'),
        
        // Stats
        'about_years_experience' => Setting::get('about_years_experience', '10+'),
        'about_happy_patients' => Setting::get('about_happy_patients', '1000+'),
        
        // Features
        'about_feature1_title' => Setting::get('about_feature1_title', 'Excellence in Patient Care'),
        'about_feature1_description' => Setting::get('about_feature1_description', 'Unparalleled commitment to your comfort and satisfaction'),
        'about_feature2_title' => Setting::get('about_feature2_title', 'Modern Facilities'),
        'about_feature2_description' => Setting::get('about_feature2_description', 'State-of-the-art equipment and sterilization protocols'),
        'about_feature3_title' => Setting::get('about_feature3_title', 'Expert Team'),
        'about_feature3_description' => Setting::get('about_feature3_description', 'Highly qualified professionals with years of experience'),
        
        // Services
        'about_service1_title' => Setting::get('about_service1_title', 'Advanced Technology'),
        'about_service1_description' => Setting::get('about_service1_description', 'Utilizing the latest dental technology for precise diagnostics and treatments.'),
        'about_service2_title' => Setting::get('about_service2_title', 'Convenient Hours'),
        'about_service2_description' => Setting::get('about_service2_description', 'Flexible scheduling options to accommodate your busy lifestyle.'),
        'about_service3_title' => Setting::get('about_service3_title', 'Patient-Centered Care'),
        'about_service3_description' => Setting::get('about_service3_description', 'Personalized treatment plans tailored to your unique needs.'),
        
        // Testimonials
        'about_testimonial1_name' => Setting::get('about_testimonial1_name', 'John Doe'),
        'about_testimonial1_role' => Setting::get('about_testimonial1_role', 'Regular Patient'),
        'about_testimonial1_text' => Setting::get('about_testimonial1_text', 'Outstanding dental care and professional staff. The clinic\'s modern facilities and attention to patient comfort made my visits pleasant and stress-free.'),
        'about_testimonial2_name' => Setting::get('about_testimonial2_name', 'Maria Garcia'),
        'about_testimonial2_role' => Setting::get('about_testimonial2_role', 'New Patient'),
        'about_testimonial2_text' => Setting::get('about_testimonial2_text', 'The online appointment system is so convenient, and the dental team is incredibly skilled and friendly. I\'ve found my permanent dental clinic!'),
        
        // CTA Section
        'about_cta_title' => Setting::get('about_cta_title', 'Ready to Transform Your Smile?'),
        'about_cta_description' => Setting::get('about_cta_description', 'Take the first step towards better dental health. Book your appointment today and experience our exceptional care in a comfortable, modern environment.'),
        
        // Why Choose Us
        'about_why_choose_title' => Setting::get('about_why_choose_title', 'Why Choose Us'),
        'about_why_choose_description' => Setting::get('about_why_choose_description', 'Experience the difference with our comprehensive approach to dental care'),
        'about_feature_quality_title' => Setting::get('about_feature_quality_title', 'Quality Care'),
        'about_feature_quality_description' => Setting::get('about_feature_quality_description', 'Highest standards of dental treatment and patient care'),
        'about_feature_timely_title' => Setting::get('about_feature_timely_title', 'Timely Service'),
        'about_feature_timely_description' => Setting::get('about_feature_timely_description', 'Prompt appointments and minimal waiting times'),
        'about_feature_facility_title' => Setting::get('about_feature_facility_title', 'Modern Facility'),
        'about_feature_facility_description' => Setting::get('about_feature_facility_description', 'State-of-the-art equipment and comfortable environment'),
        'about_feature_staff_title' => Setting::get('about_feature_staff_title', 'Expert Staff'),
        'about_feature_staff_description' => Setting::get('about_feature_staff_description', 'Highly trained and experienced dental professionals'),
        
        // Contact Information
        'about_contact_address' => Setting::get('about_contact_address', '123 Dental Street, City, State 12345'),
        'about_contact_phone' => Setting::get('about_contact_phone', '8715-5170'),
        'about_contact_hours' => Setting::get('about_contact_hours', 'Monday - Saturday: 9AM - 6PM'),
        
        // Image paths
        'about_clinic_image' => Setting::get('about_clinic_image', 'images/clinic.jpg'),
    ];
    
    return view('about', compact('settings'));
}

  public function doctor()
    {
        $personnel = Personnel::whereNotIn('position', ['Doctor','General Dentist, Orthodontics, Cosmetic Dentist' ])->get();
        $doctor = Personnel::whereIn('position', ['Doctor'])
                ->orWhereIn('position', ['General Dentist, Orthodontics, Cosmetic Dentist'])
                ->get();
        return view('doctor', compact('personnel', 'doctor'));
    }

    
    public function applyjob(Request $request, $jobId)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits:11',
            'resume' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $existingApplication = JobApplication::where('job_id', $jobId)
            ->where('email', $request->input('email'))
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this job.');
        }

        $jobApplication = new JobApplication();
        $jobApplication->job_id = $jobId;
        $jobApplication->fullname = $request->input('fullname');
        $jobApplication->email = $request->input('email');
        $jobApplication->status = 'pending';
        $jobApplication->phone = $request->input('phone');

        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('resumes', $filename, 'public');

            if ($jobApplication->resume && Storage::disk('public')->exists($jobApplication->resume)) {
                Storage::disk('public')->delete($jobApplication->resume);
            }

            $jobApplication->resume = $path;
        }
        $jobApplication->save();
        return back()->with('success', 'Application submitted successfully.');
    }
    
    
    public function careers()
    {
        $jobs = CareerJob::paginate(5);
        $jobsCount = CareerJob::count();
        return view('careers', ['jobs' => $jobs, 'jobsCount' => $jobsCount]);
    }
    
    public function filter(Request $request)
    {
        $query = CareerJob::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('jobtype')) {
            $query->where('jobtype', $request->jobtype);
        }

        if ($request->filled('workexperience')) {
            $query->where('workexperience', '>=', $request->workexperience);
        }

        if ($request->filled('salary')) {
            $query->where('salary', '<=', $request->salary);
        }

        $jobs = $query->paginate(5);
        $jobsCount = $query->get()->count();

        return view('careers', compact('jobs', 'jobsCount'));
    }


    public function contact()
    {
        // Get all contact settings
        $settings = [
            'contact_address' => Setting::get('contact_address', '605 9 de Febrero St. Brgy, Pleasant Hills Mandaluyong City'),
            'contact_email' => Setting::get('contact_email', 'anafatima0717@gmail.com'),
            'contact_phone' => Setting::get('contact_phone', '+63 9154677338'),
            'contact_opening_hours' => Setting::get('contact_opening_hours', 'Monday - Saturday: 9:00 AM - 6:00 PM<br>Sunday: Closed'),
            'contact_emergency_phone' => Setting::get('contact_emergency_phone', '+63 9154677338'),
            'contact_faq1_question' => Setting::get('contact_faq1_question', 'What are your operating hours?'),
            'contact_faq1_answer' => Setting::get('contact_faq1_answer', 'We are open Monday through Saturday from 9:00 AM to 6:00 PM. We are closed on Sundays and holidays.'),
            'contact_faq2_question' => Setting::get('contact_faq2_question', 'Do you accept walk-in patients?'),
            'contact_faq2_answer' => Setting::get('contact_faq2_answer', 'While we welcome walk-ins, we recommend scheduling an appointment to ensure prompt service and minimize waiting time.'),
            'contact_faq3_question' => Setting::get('contact_faq3_question', 'What payment methods do you accept?'),
            'contact_faq3_answer' => Setting::get('contact_faq3_answer', 'We accept cash, credit cards, and major insurance providers. Please contact us for specific insurance coverage details.'),
            'contact_faq4_question' => Setting::get('contact_faq4_question', 'How do I schedule an appointment?'),
            'contact_faq4_answer' => Setting::get('contact_faq4_answer', 'You can schedule an appointment through our website, by calling us, or sending an email. We\'ll respond promptly to confirm your booking.'),
        ];
        
        return view('contact', compact('settings'));
    }

    public function services()
    {
        // Get all services settings
        $settings = [
            // Main Services Section
            'services_subtitle' => Setting::get('services_subtitle', 'Our Expertise'),
            'services_title' => Setting::get('services_title', 'Comprehensive Dental Services'),
            'services_description' => Setting::get('services_description', 'Providing exceptional dental care with state-of-the-art technology and personalized treatment plans'),
            
            // Service 1
            'service1_title' => Setting::get('service1_title', 'Tooth Restoration'),
            'service1_description' => Setting::get('service1_description', 'Tooth restoration is a dental procedure used to repair or replace damaged, decayed, or missing teeth, enhancing both function and appearance. Treatments such as fillings, crowns, bridges, or implants are commonly used to restore teeth.'),
            'service1_recommendation' => Setting::get('service1_recommendation', 'Recommended for damaged teeth'),
            'service1_icon' => Setting::get('service1_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>'),
            
            // Service 2
            'service2_title' => Setting::get('service2_title', 'Teeth Extraction'),
            'service2_description' => Setting::get('service2_description', 'Tooth extraction is the process of removing a tooth from its socket in the bone. This procedure is typically done when a tooth is severely decayed, damaged, or impacted.'),
            'service2_recommendation' => Setting::get('service2_recommendation', 'For severely damaged teeth'),
            'service2_icon' => Setting::get('service2_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'),
            
            // Service 3
            'service3_title' => Setting::get('service3_title', 'Teeth Whitening'),
            'service3_description' => Setting::get('service3_description', 'Teeth whitening is a cosmetic dental procedure aimed at lightening the color of teeth to enhance their appearance. It can be done using professional treatments in a dental office or at-home whitening products.'),
            'service3_recommendation' => Setting::get('service3_recommendation', 'For a brighter smile'),
            'service3_icon' => Setting::get('service3_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>'),
            
            // Service 4
            'service4_title' => Setting::get('service4_title', 'Oral Prophylaxis'),
            'service4_description' => Setting::get('service4_description', 'Oral prophylaxis is a professional cleaning procedure performed by a dentist or dental hygienist to remove plaque, tartar, and stains from the teeth.'),
            'service4_recommendation' => Setting::get('service4_recommendation', 'Recommended every 6 months'),
            'service4_icon' => Setting::get('service4_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>'),
            
            // Service 5
            'service5_title' => Setting::get('service5_title', 'Odontectomy'),
            'service5_description' => Setting::get('service5_description', 'Odontectomy is a surgical procedure that involves the removal of impacted or partially erupted teeth, typically wisdom teeth.'),
            'service5_recommendation' => Setting::get('service5_recommendation', 'For impacted wisdom teeth'),
            'service5_icon' => Setting::get('service5_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>'),
            
            // Service 6
            'service6_title' => Setting::get('service6_title', 'Orthodontics'),
            'service6_description' => Setting::get('service6_description', 'Orthodontics is a branch of dentistry that focuses on diagnosing, preventing, and treating misaligned teeth and jaws.'),
            'service6_recommendation' => Setting::get('service6_recommendation', 'For straighter teeth'),
            'service6_icon' => Setting::get('service6_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>'),
            
            // Advantages Section
            'advantages_subtitle' => Setting::get('advantages_subtitle', 'Our Advantages'),
            'advantages_title' => Setting::get('advantages_title', 'Why Choose Our Dental Services'),
            'advantages_description' => Setting::get('advantages_description', 'We combine expertise, technology, and compassionate care to provide you with the best dental experience'),
            
            // Advantage 1
            'advantage1_title' => Setting::get('advantage1_title', 'Experienced Professionals'),
            'advantage1_description' => Setting::get('advantage1_description', 'Our team of highly qualified dental professionals has years of experience in providing top-quality dental care.'),
            'advantage1_icon' => Setting::get('advantage1_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>'),
            
            // Advantage 2
            'advantage2_title' => Setting::get('advantage2_title', 'Advanced Technology'),
            'advantage2_description' => Setting::get('advantage2_description', 'We utilize state-of-the-art dental equipment and techniques to ensure efficient and effective treatments.'),
            'advantage2_icon' => Setting::get('advantage2_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>'),
            
            // Advantage 3
            'advantage3_title' => Setting::get('advantage3_title', 'Patient-Centered Care'),
            'advantage3_description' => Setting::get('advantage3_description', 'We prioritize your comfort and satisfaction, providing personalized care tailored to your unique needs.'),
            'advantage3_icon' => Setting::get('advantage3_icon', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>'),
            
            // CTA Section
            'cta_title' => Setting::get('cta_title', 'Ready to Schedule Your Appointment?'),
            'cta_description' => Setting::get('cta_description', 'Our friendly staff will assist you in scheduling the best time for your dental needs. We offer a variety of services, and our team is dedicated to providing high-quality care.'),
            'cta_button_text' => Setting::get('cta_button_text', 'Book an Appointment'),
            'cta_satisfaction' => Setting::get('cta_satisfaction', '100%'),
            'cta_satisfaction_text' => Setting::get('cta_satisfaction_text', 'Patient Satisfaction'),
            'cta_satisfaction_description' => Setting::get('cta_satisfaction_description', 'We\'re committed to providing exceptional dental care that meets your needs and exceeds your expectations.'),
            
            // FAQ Section
            'faq_title' => Setting::get('faq_title', 'Frequently Asked Questions'),
            
            // FAQ 1
            'faq1_question' => Setting::get('faq1_question', 'How often should I visit the dentist?'),
            'faq1_answer' => Setting::get('faq1_answer', 'Most dental professionals recommend visiting the dentist every six months for regular check-ups and cleanings. However, some individuals may need more frequent visits depending on their oral health needs.'),
            
            // FAQ 2
            'faq2_question' => Setting::get('faq2_question', 'What should I do in a dental emergency?'),
            'faq2_answer' => Setting::get('faq2_answer', 'In case of a dental emergency, contact our office immediately. For severe pain, broken teeth, or other urgent issues, we offer emergency appointments to address your needs promptly.'),
            
            // FAQ 3
            'faq3_question' => Setting::get('faq3_question', 'How can I improve my oral hygiene at home?'),
            'faq3_answer' => Setting::get('faq3_answer', 'Maintain good oral hygiene by brushing twice daily with fluoride toothpaste, flossing daily, using mouthwash, limiting sugary foods and drinks, and avoiding tobacco products. Regular dental check-ups are also essential.'),
            
            // FAQ 4
            'faq4_question' => Setting::get('faq4_question', 'Do you accept dental insurance?'),
            'faq4_answer' => Setting::get('faq4_answer', 'Yes, we accept most major dental insurance plans. Our administrative team will help you understand your coverage and maximize your benefits. Please contact our office for specific information about your plan.'),
        ];
        
        return view('service', compact('settings'));
    }
    public function service()
    {
        return view('service');
    }
}

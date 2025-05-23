<x-sidebar-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">About Page Settings</h1>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.settings.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Hero Section</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="about_hero_title" class="block text-sm font-medium text-gray-700 mb-1">Hero Title</label>
                        <input type="text" name="about_hero_title" id="about_hero_title" value="{{ $settings['about_hero_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_hero_subtitle" class="block text-sm font-medium text-gray-700 mb-1">Hero Subtitle</label>
                        <input type="text" name="about_hero_subtitle" id="about_hero_subtitle" value="{{ $settings['about_hero_subtitle'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="about_hero_description" class="block text-sm font-medium text-gray-700 mb-1">Hero Description</label>
                        <textarea name="about_hero_description" id="about_hero_description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ $settings['about_hero_description'] }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Main Content</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="about_clinic_image" class="block text-sm font-medium text-gray-700 mb-1">Clinic Image</label>
                        <input type="file" name="about_clinic_image" id="about_clinic_image" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <p class="mt-1 text-sm text-gray-500">Current image: {{ $settings['about_clinic_image'] }}</p>
                    </div>
                    
                    <div>
                        <label for="about_main_title" class="block text-sm font-medium text-gray-700 mb-1">Main Content Title</label>
                        <input type="text" name="about_main_title" id="about_main_title" value="{{ $settings['about_main_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="about_main_description" class="block text-sm font-medium text-gray-700 mb-1">Main Content Description</label>
                        <textarea name="about_main_description" id="about_main_description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ $settings['about_main_description'] }}</textarea>
                    </div>
                    
                    <div>
                        <label for="about_years_experience" class="block text-sm font-medium text-gray-700 mb-1">Years Experience</label>
                        <input type="text" name="about_years_experience" id="about_years_experience" value="{{ $settings['about_years_experience'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_happy_patients" class="block text-sm font-medium text-gray-700 mb-1">Happy Patients</label>
                        <input type="text" name="about_happy_patients" id="about_happy_patients" value="{{ $settings['about_happy_patients'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                </div>
            </div>
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Features</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="about_feature1_title" class="block text-sm font-medium text-gray-700 mb-1">Feature 1 Title</label>
                        <input type="text" name="about_feature1_title" id="about_feature1_title" value="{{ $settings['about_feature1_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature1_description" class="block text-sm font-medium text-gray-700 mb-1">Feature 1 Description</label>
                        <input type="text" name="about_feature1_description" id="about_feature1_description" value="{{ $settings['about_feature1_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature2_title" class="block text-sm font-medium text-gray-700 mb-1">Feature 2 Title</label>
                        <input type="text" name="about_feature2_title" id="about_feature2_title" value="{{ $settings['about_feature2_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature2_description" class="block text-sm font-medium text-gray-700 mb-1">Feature 2 Description</label>
                        <input type="text" name="about_feature2_description" id="about_feature2_description" value="{{ $settings['about_feature2_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature3_title" class="block text-sm font-medium text-gray-700 mb-1">Feature 3 Title</label>
                        <input type="text" name="about_feature3_title" id="about_feature3_title" value="{{ $settings['about_feature3_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature3_description" class="block text-sm font-medium text-gray-700 mb-1">Feature 3 Description</label>
                        <input type="text" name="about_feature3_description" id="about_feature3_description" value="{{ $settings['about_feature3_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                </div>
            </div>
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Services</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="about_service1_title" class="block text-sm font-medium text-gray-700 mb-1">Service 1 Title</label>
                        <input type="text" name="about_service1_title" id="about_service1_title" value="{{ $settings['about_service1_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_service1_description" class="block text-sm font-medium text-gray-700 mb-1">Service 1 Description</label>
                        <input type="text" name="about_service1_description" id="about_service1_description" value="{{ $settings['about_service1_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_service2_title" class="block text-sm font-medium text-gray-700 mb-1">Service 2 Title</label>
                        <input type="text" name="about_service2_title" id="about_service2_title" value="{{ $settings['about_service2_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_service2_description" class="block text-sm font-medium text-gray-700 mb-1">Service 2 Description</label>
                        <input type="text" name="about_service2_description" id="about_service2_description" value="{{ $settings['about_service2_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_service3_title" class="block text-sm font-medium text-gray-700 mb-1">Service 3 Title</label>
                        <input type="text" name="about_service3_title" id="about_service3_title" value="{{ $settings['about_service3_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_service3_description" class="block text-sm font-medium text-gray-700 mb-1">Service 3 Description</label>
                        <input type="text" name="about_service3_description" id="about_service3_description" value="{{ $settings['about_service3_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                </div>
            </div>
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Testimonials</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="about_testimonial1_name" class="block text-sm font-medium text-gray-700 mb-1">Testimonial 1 Name</label>
                        <input type="text" name="about_testimonial1_name" id="about_testimonial1_name" value="{{ $settings['about_testimonial1_name'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_testimonial1_role" class="block text-sm font-medium text-gray-700 mb-1">Testimonial 1 Role</label>
                        <input type="text" name="about_testimonial1_role" id="about_testimonial1_role" value="{{ $settings['about_testimonial1_role'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="about_testimonial1_text" class="block text-sm font-medium text-gray-700 mb-1">Testimonial 1 Text</label>
                        <textarea name="about_testimonial1_text" id="about_testimonial1_text" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ $settings['about_testimonial1_text'] }}</textarea>
                    </div>
                    
                    <div>
                        <label for="about_testimonial2_name" class="block text-sm font-medium text-gray-700 mb-1">Testimonial 2 Name</label>
                        <input type="text" name="about_testimonial2_name" id="about_testimonial2_name" value="{{ $settings['about_testimonial2_name'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_testimonial2_role" class="block text-sm font-medium text-gray-700 mb-1">Testimonial 2 Role</label>
                        <input type="text" name="about_testimonial2_role" id="about_testimonial2_role" value="{{ $settings['about_testimonial2_role'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="about_testimonial2_text" class="block text-sm font-medium text-gray-700 mb-1">Testimonial 2 Text</label>
                        <textarea name="about_testimonial2_text" id="about_testimonial2_text" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ $settings['about_testimonial2_text'] }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Call to Action</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="about_cta_title" class="block text-sm font-medium text-gray-700 mb-1">CTA Title</label>
                        <input type="text" name="about_cta_title" id="about_cta_title" value="{{ $settings['about_cta_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="about_cta_description" class="block text-sm font-medium text-gray-700 mb-1">CTA Description</label>
                        <textarea name="about_cta_description" id="about_cta_description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ $settings['about_cta_description'] }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Why Choose Us</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="about_why_choose_title" class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
                        <input type="text" name="about_why_choose_title" id="about_why_choose_title" value="{{ $settings['about_why_choose_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="about_why_choose_description" class="block text-sm font-medium text-gray-700 mb-1">Section Description</label>
                        <textarea name="about_why_choose_description" id="about_why_choose_description" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ $settings['about_why_choose_description'] }}</textarea>
                    </div>
                    
                    <div>
                        <label for="about_feature_quality_title" class="block text-sm font-medium text-gray-700 mb-1">Quality Care Title</label>
                        <input type="text" name="about_feature_quality_title" id="about_feature_quality_title" value="{{ $settings['about_feature_quality_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature_quality_description" class="block text-sm font-medium text-gray-700 mb-1">Quality Care Description</label>
                        <input type="text" name="about_feature_quality_description" id="about_feature_quality_description" value="{{ $settings['about_feature_quality_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature_timely_title" class="block text-sm font-medium text-gray-700 mb-1">Timely Service Title</label>
                        <input type="text" name="about_feature_timely_title" id="about_feature_timely_title" value="{{ $settings['about_feature_timely_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature_timely_description" class="block text-sm font-medium text-gray-700 mb-1">Timely Service Description</label>
                        <input type="text" name="about_feature_timely_description" id="about_feature_timely_description" value="{{ $settings['about_feature_timely_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature_facility_title" class="block text-sm font-medium text-gray-700 mb-1">Modern Facility Title</label>
                        <input type="text" name="about_feature_facility_title" id="about_feature_facility_title" value="{{ $settings['about_feature_facility_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature_facility_description" class="block text-sm font-medium text-gray-700 mb-1">Modern Facility Description</label>
                        <input type="text" name="about_feature_facility_description" id="about_feature_facility_description" value="{{ $settings['about_feature_facility_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature_staff_title" class="block text-sm font-medium text-gray-700 mb-1">Expert Staff Title</label>
                        <input type="text" name="about_feature_staff_title" id="about_feature_staff_title" value="{{ $settings['about_feature_staff_title'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_feature_staff_description" class="block text-sm font-medium text-gray-700 mb-1">Expert Staff Description</label>
                        <input type="text" name="about_feature_staff_description" id="about_feature_staff_description" value="{{ $settings['about_feature_staff_description'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                </div>
            </div>
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Contact Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="about_contact_address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <input type="text" name="about_contact_address" id="about_contact_address" value="{{ $settings['about_contact_address'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="about_contact_phone" id="about_contact_phone" value="{{ $settings['about_contact_phone'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    
                    <div>
                        <label for="about_contact_hours" class="block text-sm font-medium text-gray-700 mb-1">Opening Hours</label>
                        <input type="text" name="about_contact_hours" id="about_contact_hours" value="{{ $settings['about_contact_hours'] }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-sidebar-layout>
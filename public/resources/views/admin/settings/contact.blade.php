<x-sidebar-layout>
    <div class="py-6">
        <!-- Header with Icon -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-teal-400 to-teal-500 p-3 rounded-lg shadow-md mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Contact Page Settings</h1>
                    <p class="text-gray-500">Manage your clinic's contact information and FAQs</p>
                </div>
            </div>
            
            <!-- Preview Button -->
            <a href="{{ route('contact') }}" target="_blank" class="flex items-center px-4 py-2 bg-white border border-teal-300 text-teal-600 rounded-lg hover:bg-teal-50 transition-all duration-300 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Preview Page
            </a>
        </div>
        
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg shadow-sm flex items-start" role="alert">
                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-medium">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif
        
        <form action="{{ route('admin.settings.update-contact') }}" method="POST">
            @csrf
            
            <!-- Tabs Navigation -->
            <div x-data="{ activeTab: 'contact' }" class="mb-6">
                <div class="flex border-b border-gray-200">
                    <button type="button" @click="activeTab = 'contact'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'contact', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'contact' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Contact Information
                        </div>
                    </button>
                    <button type="button" @click="activeTab = 'faqs'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'faqs', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'faqs' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Frequently Asked Questions
                        </div>
                    </button>
                </div>
                
                <!-- Contact Information Tab -->
                <div x-show="activeTab === 'contact'" class="mt-6 bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="bg-teal-100 p-2 rounded-full">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold ml-3 text-gray-800">Clinic Contact Details</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Address
                                </span>
                            </label>
                            <div class="relative">
                                <textarea name="settings[contact_address]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['contact_address'] }}</textarea>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="group">
                            <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Email
                                </span>
                            </label>
                            <div class="relative">
                                <input type="email" name="settings[contact_email]" value="{{ $settings['contact_email'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="group">
                            <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Phone
                                </span>
                            </label>
                            <div class="relative">
                                <input type="text" name="settings[contact_phone]" value="{{ $settings['contact_phone'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="group">
                            <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    </svg>
                                    Emergency Phone
                                </span>
                            </label>
                            <div class="relative">
                                <input type="text" name="settings[contact_emergency_phone]" value="{{ $settings['contact_emergency_phone'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="md:col-span-2 group">
                            <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Opening Hours
                                </span>
                            </label>
                            <div class="relative">
                                <textarea name="settings[contact_opening_hours]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['contact_opening_hours'] }}</textarea>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Use &lt;br&gt; for line breaks
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- FAQs Tab -->
                <div x-show="activeTab === 'faqs'" class="mt-6 bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Frequently Asked Questions</h2>
                        </div>
                        <div class="text-sm text-gray-500">
                            These FAQs will appear on your contact page
                        </div>
                    </div>
                    
                    <!-- FAQ Accordion -->
                    <div x-data="{ activeFaq: null }" class="space-y-4">
                        <!-- FAQ 1 -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden transition-all duration-200 hover:shadow-md" :class="{'ring-2 ring-teal-300': activeFaq === 1}">
                            <div @click="activeFaq = activeFaq === 1 ? null : 1" class="flex items-center justify-between p-4 cursor-pointer bg-gray-50 hover:bg-teal-50 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="bg-teal-100 text-teal-700 font-bold rounded-full w-8 h-8 flex items-center justify-center mr-3">1</div>
                                    <h3 class="font-medium text-gray-700">First Question</h3>
                                </div>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="{'rotate-180': activeFaq === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <div x-show="activeFaq === 1" x-collapse class="p-4 bg-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">Question</label>
                                        <input type="text" name="settings[contact_faq1_question]" value="{{ $settings['contact_faq1_question'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">Answer</label>
                                        <textarea name="settings[contact_faq1_answer]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['contact_faq1_answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ 2 -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden transition-all duration-200 hover:shadow-md" :class="{'ring-2 ring-teal-300': activeFaq === 2}">
                            <div @click="activeFaq = activeFaq === 2 ? null : 2" class="flex items-center justify-between p-4 cursor-pointer bg-gray-50 hover:bg-teal-50 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="bg-teal-100 text-teal-700 font-bold rounded-full w-8 h-8 flex items-center justify-center mr-3">2</div>
                                    <h3 class="font-medium text-gray-700">Second Question</h3>
                                </div>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="{'rotate-180': activeFaq === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <div x-show="activeFaq === 2" x-collapse class="p-4 bg-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">Question</label>
                                        <input type="text" name="settings[contact_faq2_question]" value="{{ $settings['contact_faq2_question'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">Answer</label>
                                        <textarea name="settings[contact_faq2_answer]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['contact_faq2_answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ 3 -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden transition-all duration-200 hover:shadow-md" :class="{'ring-2 ring-teal-300': activeFaq === 3}">
                            <div @click="activeFaq = activeFaq === 3 ? null : 3" class="flex items-center justify-between p-4 cursor-pointer bg-gray-50 hover:bg-teal-50 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="bg-teal-100 text-teal-700 font-bold rounded-full w-8 h-8 flex items-center justify-center mr-3">3</div>
                                    <h3 class="font-medium text-gray-700">Third Question</h3>
                                </div>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="{'rotate-180': activeFaq === 3}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <div x-show="activeFaq === 3" x-collapse class="p-4 bg-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">Question</label>
                                        <input type="text" name="settings[contact_faq3_question]" value="{{ $settings['contact_faq3_question'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">Answer</label>
                                        <textarea name="settings[contact_faq3_answer]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['contact_faq3_answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ 4 -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden transition-all duration-200 hover:shadow-md" :class="{'ring-2 ring-teal-300': activeFaq === 4}">
                            <div @click="activeFaq = activeFaq === 4 ? null : 4" class="flex items-center justify-between p-4 cursor-pointer bg-gray-50 hover:bg-teal-50 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="bg-teal-100 text-teal-700 font-bold rounded-full w-8 h-8 flex items-center justify-center mr-3">4</div>
                                    <h3 class="font-medium text-gray-700">Fourth Question</h3>
                                </div>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="{'rotate-180': activeFaq === 4}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <div x-show="activeFaq === 4" x-collapse class="p-4 bg-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">Question</label>
                                        <input type="text" name="settings[contact_faq4_question]" value="{{ $settings['contact_faq4_question'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">Answer</label>
                                        <textarea name="settings[contact_faq4_answer]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['contact_faq4_answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Save Button Section -->
            <div class="mt-8 flex justify-between items-center">
                <div class="text-sm text-gray-500 italic">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Changes will be immediately visible on your contact page
                    </span>
                </div>
                <div class="flex space-x-4">
                    <button type="button" onclick="window.location.reload()" class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-50 transition-all duration-300 shadow-sm hover:shadow flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-3 rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
    
</x-sidebar-layout>
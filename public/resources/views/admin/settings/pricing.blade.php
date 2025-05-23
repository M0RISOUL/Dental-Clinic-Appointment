<x-sidebar-layout>
    <div class="py-6">
        <!-- Header with Icon -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-teal-400 to-teal-500 p-3 rounded-lg shadow-md mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Pricing Settings</h1>
                    <p class="text-gray-500">Manage your clinic's pricing information and service packages</p>
                </div>
            </div>
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
        
        <form action="{{ route('admin.settings.pricing.update') }}" method="POST">
            @csrf
            
            <!-- Tabs Navigation -->
            <div x-data="{ activeTab: 'general' }" class="mb-6">
                <div class="flex flex-wrap border-b border-gray-200">
                    <button type="button" @click="activeTab = 'general'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'general', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'general' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            General & Braces
                        </div>
                    </button>
                    <button type="button" @click="activeTab = 'dentures'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'dentures', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'dentures' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Dentures
                        </div>
                    </button>
                    <button type="button" @click="activeTab = 'crowns'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'crowns', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'crowns' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            Crowns & Veneers
                        </div>
                    </button>
                    <button type="button" @click="activeTab = 'other'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'other', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'other' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            Other Services
                        </div>
                    </button>
                </div>
                
                <!-- General & Braces Tab -->
                <div x-show="activeTab === 'general'" class="mt-6">
                    <!-- Page Content Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Page Content</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Page Title
                                    </span>
                                </label>
                                <input type="text" name="pricing_title" value="{{ $settings['pricing_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="md:col-span-2 group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Page Description
                                    </span>
                                </label>
                                <textarea name="pricing_description" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['pricing_description'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Braces Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Braces</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Braces Type
                                    </span>
                                </label>
                                <input type="text" name="braces_type" value="{{ $settings['braces_type'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Total Package Price (₱)
                                    </span>
                                </label>
                                <input type="number" name="braces_total_package" value="{{ $settings['braces_total_package'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Low DP Promo (₱)
                                    </span>
                                </label>
                                <input type="number" name="braces_low_dp_promo" value="{{ $settings['braces_low_dp_promo'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Monthly Adjustment (₱)
                                    </span>
                                </label>
                                <input type="number" name="braces_monthly_adjustment" value="{{ $settings['braces_monthly_adjustment'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                        Inclusions
                                    </span>
                                </label>
                                
                                <div id="inclusions-container" class="space-y-2 mb-3">
                                    @if(is_array($settings['braces_inclusions']))
                                        @foreach($settings['braces_inclusions'] as $index => $inclusion)
                                            <div class="flex items-center space-x-2">
                                                <input type="text" name="braces_inclusions[]" value="{{ $inclusion }}" class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent hover:border-teal-300 transition-colors duration-200">
                                                <button type="button" class="remove-inclusion bg-red-100 text-red-600 p-3 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                
                                <button type="button" id="add-inclusion" class="flex items-center text-teal-600 bg-teal-50 px-4 py-2 rounded-lg hover:bg-teal-100 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add Inclusion
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- General Procedures Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">General Procedures</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Oral Prophylaxis
                                    </span>
                                </label>
                                <input type="text" name="general_oral_prophylaxis" value="{{ $settings['general_oral_prophylaxis'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Fluoride Treatment
                                    </span>
                                </label>
                                <input type="text" name="general_fluoride_treatment" value="{{ $settings['general_fluoride_treatment'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Tooth Filling
                                    </span>
                                </label>
                                <input type="text" name="general_tooth_filling" value="{{ $settings['general_tooth_filling'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Anterior Tooth Filling
                                    </span>
                                </label>
                                <input type="text" name="general_anterior_tooth_filling" value="{{ $settings['general_anterior_tooth_filling'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Tooth Extraction
                                    </span>
                                </label>
                                <input type="text" name="general_tooth_extraction" value="{{ $settings['general_tooth_extraction'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Odontectomy/Wisdom Tooth Removal
                                    </span>
                                </label>
                                <input type="text" name="general_odontectomy_wisdom_tooth_removal" value="{{ $settings['general_odontectomy_wisdom_tooth_removal'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Teeth Whitening Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mt-6">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Teeth Whitening</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2 group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Description
                                    </span>
                                </label>
                                <input type="text" name="whitening_description" value="{{ $settings['whitening_description'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Original Price (₱)
                                    </span>
                                </label>
                                <input type="number" name="whitening_original_price" value="{{ $settings['whitening_original_price'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Promo Price (₱)
                                    </span>
                                </label>
                                <input type="number" name="whitening_promo_price" value="{{ $settings['whitening_promo_price'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Dentures Tab -->
                <div x-show="activeTab === 'dentures'" class="mt-6">
                    <!-- Complete Dentures Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Complete Dentures</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Ordinary - Per Arch (₱)
                                    </span>
                                </label>
                                <input type="number" name="dentures_complete_ordinary_per_arch" value="{{ $settings['dentures_complete_ordinary_per_arch'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Ordinary - Upper & Lower (₱)
                                    </span>
                                </label>
                                <input type="number" name="dentures_complete_ordinary_upper_lower" value="{{ $settings['dentures_complete_ordinary_upper_lower'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Ivocap - Per Arch (₱)
                                    </span>
                                </label>
                                <input type="number" name="dentures_complete_ivocap_per_arch" value="{{ $settings['dentures_complete_ivocap_per_arch'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Ivocap - Upper & Lower (₱)
                                    </span>
                                </label>
                                <input type="number" name="dentures_complete_ivocap_upper_lower" value="{{ $settings['dentures_complete_ivocap_upper_lower'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Thermosens - Per Arch (₱)
                                    </span>
                                </label>
                                <input type="number" name="dentures_complete_thermosens_per_arch" value="{{ $settings['dentures_complete_thermosens_per_arch'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Thermosens - Upper & Lower (₱)
                                    </span>
                                </label>
                                <input type="number" name="dentures_complete_thermosens_upper_lower" value="{{ $settings['dentures_complete_thermosens_upper_lower'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Partial Dentures Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Partial Dentures</h2>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-700 mb-4 border-b pb-2">Ordinary</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            1-2 Units (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_ordinary_1_2_units" value="{{ $settings['dentures_partial_ordinary_1_2_units'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            3-4 Units (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_ordinary_3_4_units" value="{{ $settings['dentures_partial_ordinary_3_4_units'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            5 and Above (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_ordinary_5_and_above" value="{{ $settings['dentures_partial_ordinary_5_and_above'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            CD Per Arch (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_ordinary_cd_per_arch" value="{{ $settings['dentures_partial_ordinary_cd_per_arch'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-700 mb-4 border-b pb-2">Ivostar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            1-2 Units (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_ivostar_1_2_units" value="{{ $settings['dentures_partial_ivostar_1_2_units'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            3-4 Units (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_ivostar_3_4_units" value="{{ $settings['dentures_partial_ivostar_3_4_units'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            5 and Above (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_ivostar_5_and_above" value="{{ $settings['dentures_partial_ivostar_5_and_above'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            CD Per Arch (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_ivostar_cd_per_arch" value="{{ $settings['dentures_partial_ivostar_cd_per_arch'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-700 mb-4 border-b pb-2">Flexite</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            1-2 Units Unilateral (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_flexite_1_2_units_unilateral" value="{{ $settings['dentures_partial_flexite_1_2_units_unilateral'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            2-3 Units Bilateral (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_flexite_2_3_units_bilateral" value="{{ $settings['dentures_partial_flexite_2_3_units_bilateral'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            4-10 Units Bilateral (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_flexite_4_10_units_bilateral" value="{{ $settings['dentures_partial_flexite_4_10_units_bilateral'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            10-12 Units Bilateral (₱)
                                        </span>
                                    </label>
                                    <input type="number" name="dentures_partial_flexite_10_12_units_bilateral" value="{{ $settings['dentures_partial_flexite_10_12_units_bilateral'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Crowns & Veneers Tab -->
                <div x-show="activeTab === 'crowns'" class="mt-6">
                    <!-- Fixed Bridge and Crowns Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Fixed Bridge and Crowns</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Porcelain with Metal (₱)
                                    </span>
                                </label>
                                <input type="number" name="fixed_porcelain_with_metal" value="{{ $settings['fixed_porcelain_with_metal'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Porcelain with Tilite (₱)
                                    </span>
                                </label>
                                <input type="number" name="fixed_porcelain_with_tilite" value="{{ $settings['fixed_porcelain_with_tilite'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Porcelain with Zirconia (₱)
                                    </span>
                                </label>
                            <input type="number" name="fixed_porcelain_with_zirconia" 
                                value="{{ $settings['fixed_porcelain_with_zirconia'] ?? '' }}" 
                                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Emax (₱)
                                    </span>
                                </label>
                                <input type="number" name="fixed_emax" value="{{ $settings['fixed_emax'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Veneers Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Veneers</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Composite (Direct) (₱)
                                    </span>
                                </label>
                                <input type="number" name="veneers_composite_direct" value="{{ $settings['veneers_composite_direct'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Porcelain (Indirect) (₱)
                                    </span>
                                </label>
                                <input type="number" name="veneers_porcelain_indirect" value="{{ $settings['veneers_porcelain_indirect'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Emax (₱)
                                    </span>
                                </label>
                                <input type="number" name="veneers_emax" value="{{ $settings['veneers_emax'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Zirconia (₱)
                                    </span>
                                </label>
                                <input type="number" name="veneers_zirconia" value="{{ $settings['veneers_zirconia'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Other Services Tab -->
                <div x-show="activeTab === 'other'" class="mt-6">
                    <!-- Retainers Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Retainers</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Hawley (₱)
                                    </span>
                                </label>
                                <input type="number" name="retainers_hawley" value="{{ $settings['retainers_hawley'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Essix (₱)
                                    </span>
                                </label>
                                <input type="number" name="retainers_essix" value="{{ $settings['retainers_essix'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Fixed (₱)
                                    </span>
                                </label>
                                <input type="number" name="retainers_fixed" value="{{ $settings['retainers_fixed'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Root Canal Treatment Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Root Canal Treatment</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Anterior (₱)
                                    </span>
                                </label>
                                <input type="number" name="root_canal_anterior" value="{{ $settings['root_canal_anterior'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Premolar (₱)
                                    </span>
                                </label>
                                <input type="number" name="root_canal_premolar" value="{{ $settings['root_canal_premolar'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Molar (₱)
                                    </span>
                                </label>
                                <input type="number" name="root_canal_molar" value="{{ $settings['root_canal_molar'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Implants Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Implants</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Single Tooth (₱)
                                    </span>
                                </label>
                                <input type="number" name="implants_single_tooth" value="{{ $settings['implants_single_tooth'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Multiple Teeth (₱)
                                    </span>
                                </label>
                                <input type="number" name="implants_multiple_teeth" value="{{ $settings['implants_multiple_teeth'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="md:col-span-2 group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Implant Note
                                    </span>
                                </label>
                                <textarea name="implants_note" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['implants_note'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Save Button -->
            <div class="flex justify-end mt-8">
                <button type="submit" class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-3 rounded-lg font-medium shadow-md hover:from-teal-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50 transition-all duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add inclusion field
            document.getElementById('add-inclusion').addEventListener('click', function() {
                const container = document.getElementById('inclusions-container');
                const newField = document.createElement('div');
                newField.className = 'flex items-center space-x-2';
                newField.innerHTML = `
                    <input type="text" name="braces_inclusions[]" class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent hover:border-teal-300 transition-colors duration-200">
                    <button type="button" class="remove-inclusion bg-red-100 text-red-600 p-3 rounded-lg hover:bg-red-200 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                `;
                container.appendChild(newField);
                
                // Add event listener to the new remove button
                newField.querySelector('.remove-inclusion').addEventListener('click', function() {
                    container.removeChild(newField);
                });
            });
            
            // Remove inclusion field
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-inclusion')) {
                    const button = e.target.closest('.remove-inclusion');
                    const field = button.closest('.flex');
                    field.parentNode.removeChild(field);
                }
            });
        });
    </script>
    @endpush
</x-sidebar-layout>
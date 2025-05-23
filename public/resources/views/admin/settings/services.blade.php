<x-sidebar-layout>
    <div class="py-6">
        <!-- Header with Icon -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-teal-400 to-teal-500 p-3 rounded-lg shadow-md mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Services Page Settings</h1>
                    <p class="text-gray-500">Manage your dental services and page content</p>
                </div>
            </div>
            
            <!-- Preview Button -->
            <a href="{{ route('services') }}" target="_blank" class="flex items-center px-4 py-2 bg-white border border-teal-300 text-teal-600 rounded-lg hover:bg-teal-50 transition-all duration-300 shadow-sm">
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
        
        <form action="{{ route('admin.settings.update-services') }}" method="POST">
            @csrf
            
            <!-- Tabs Navigation -->
            <div x-data="{ activeTab: 'header' }" class="mb-6">
                <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap pb-px">
                    <button type="button" @click="activeTab = 'header'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'header', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'header' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Header Section
                        </div>
                    </button>
                    <button type="button" @click="activeTab = 'services'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'services', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'services' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Services
                        </div>
                    </button>
                    <button type="button" @click="activeTab = 'advantages'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'advantages', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'advantages' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Advantages
                        </div>
                    </button>
                    <button type="button" @click="activeTab = 'cta'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'cta', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'cta' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                            </svg>
                            Call to Action
                        </div>
                    </button>
                    <button type="button" @click="activeTab = 'faq'" :class="{ 'border-teal-500 text-teal-600': activeTab === 'faq', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'faq' }" class="py-3 px-6 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            FAQs
                        </div>
                    </button>
                </div>
                
                <!-- Header Section Tab -->
                <div x-show="activeTab === 'header'" class="mt-6 bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="bg-teal-100 p-2 rounded-full">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold ml-3 text-gray-800">Services Page Header</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Subtitle
                                </span>
                            </label>
                            <input type="text" name="settings[services_subtitle]" value="{{ $settings['services_subtitle'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                        </div>
                        
                        <div class="group">
                            <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                    Main Title
                                </span>
                            </label>
                            <input type="text" name="settings[services_title]" value="{{ $settings['services_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                        </div>
                        
                        <div class="md:col-span-2 group">
                            <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                    </svg>
                                    Description
                                </span>
                            </label>
                            <textarea name="settings[services_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['services_description'] }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Services Tab -->
                <div x-show="activeTab === 'services'" class="mt-6">
                    <div x-data="{ activeService: 1 }" class="space-y-6">
                        <!-- Service Navigation -->
                        <div class="bg-white rounded-xl shadow-md p-4 border border-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="bg-teal-100 p-2 rounded-full">
                                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold ml-3 text-gray-800">Dental Services</h2>
                            </div>
                            
                            <div class="grid grid-cols-3 sm:grid-cols-6 gap-2">
                                <button type="button" @click="activeService = 1" :class="{'bg-teal-100 text-teal-700': activeService === 1, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeService !== 1}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Service 1
                                </button>
                                <button type="button" @click="activeService = 2" :class="{'bg-teal-100 text-teal-700': activeService === 2, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeService !== 2}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Service 2
                                </button>
                                <button type="button" @click="activeService = 3" :class="{'bg-teal-100 text-teal-700': activeService === 3, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeService !== 3}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Service 3
                                </button>
                                <button type="button" @click="activeService = 4" :class="{'bg-teal-100 text-teal-700': activeService === 4, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeService !== 4}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Service 4
                                </button>
                                <button type="button" @click="activeService = 5" :class="{'bg-teal-100 text-teal-700': activeService === 5, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeService !== 5}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Service 5
                                </button>
                                                                <button type="button" @click="activeService = 6" :class="{'bg-teal-100 text-teal-700': activeService === 6, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeService !== 6}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Service 6
                                </button>
                            </div>
                        </div>
                        
                        <!-- Service 1 -->
                        <div x-show="activeService === 1" class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                    <span class="text-teal-700 font-bold">1</span>
                                </div>
                                <h3 class="text-lg font-semibold ml-3 text-gray-800">Service 1</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Title
                                    </label>
                                    <input type="text" name="settings[service1_title]" value="{{ $settings['service1_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Recommendation Text
                                    </label>
                                    <input type="text" name="settings[service1_recommendation]" value="{{ $settings['service1_recommendation'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    <p class="text-sm text-gray-500 mt-1">Short text shown at the bottom of the service card</p>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Description
                                    </label>
                                    <textarea name="settings[service1_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['service1_description'] }}</textarea>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Icon SVG Path
                                    </label>
                                    <div class="flex space-x-4">
                                        <div class="w-1/6">
                                            <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {!! $settings['service1_icon'] !!}
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-500">Preview</p>
                                        </div>
                                        <div class="w-5/6">
                                            <textarea name="settings[service1_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['service1_icon'] }}</textarea>
                                            <p class="text-sm text-gray-500 mt-1">Enter the SVG path data for the icon</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Service 2 -->
                        <div x-show="activeService === 2" class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                    <span class="text-teal-700 font-bold">2</span>
                                </div>
                                <h3 class="text-lg font-semibold ml-3 text-gray-800">Service 2</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Title
                                    </label>
                                    <input type="text" name="settings[service2_title]" value="{{ $settings['service2_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Recommendation Text
                                    </label>
                                    <input type="text" name="settings[service2_recommendation]" value="{{ $settings['service2_recommendation'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    <p class="text-sm text-gray-500 mt-1">Short text shown at the bottom of the service card</p>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Description
                                    </label>
                                    <textarea name="settings[service2_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['service2_description'] }}</textarea>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Icon SVG Path
                                    </label>
                                    <div class="flex space-x-4">
                                        <div class="w-1/6">
                                            <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {!! $settings['service2_icon'] !!}
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-500">Preview</p>
                                        </div>
                                        <div class="w-5/6">
                                            <textarea name="settings[service2_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['service2_icon'] }}</textarea>
                                            <p class="text-sm text-gray-500 mt-1">Enter the SVG path data for the icon</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Service 3 -->
                        <div x-show="activeService === 3" class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                    <span class="text-teal-700 font-bold">3</span>
                                </div>
                                <h3 class="text-lg font-semibold ml-3 text-gray-800">Service 3</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Title
                                    </label>
                                    <input type="text" name="settings[service3_title]" value="{{ $settings['service3_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Recommendation Text
                                    </label>
                                    <input type="text" name="settings[service3_recommendation]" value="{{ $settings['service3_recommendation'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    <p class="text-sm text-gray-500 mt-1">Short text shown at the bottom of the service card</p>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Description
                                    </label>
                                    <textarea name="settings[service3_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['service3_description'] }}</textarea>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Icon SVG Path
                                    </label>
                                    <div class="flex space-x-4">
                                        <div class="w-1/6">
                                            <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {!! $settings['service3_icon'] !!}
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-500">Preview</p>
                                        </div>
                                        <div class="w-5/6">
                                            <textarea name="settings[service3_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['service3_icon'] }}</textarea>
                                            <p class="text-sm text-gray-500 mt-1">Enter the SVG path data for the icon</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Service 4 -->
                        <div x-show="activeService === 4" class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                    <span class="text-teal-700 font-bold">4</span>
                                </div>
                                <h3 class="text-lg font-semibold ml-3 text-gray-800">Service 4</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Title
                                    </label>
                                    <input type="text" name="settings[service4_title]" value="{{ $settings['service4_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Recommendation Text
                                    </label>
                                    <input type="text" name="settings[service4_recommendation]" value="{{ $settings['service4_recommendation'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    <p class="text-sm text-gray-500 mt-1">Short text shown at the bottom of the service card</p>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Description
                                    </label>
                                    <textarea name="settings[service4_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['service4_description'] }}</textarea>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Icon SVG Path
                                    </label>
                                    <div class="flex space-x-4">
                                        <div class="w-1/6">
                                            <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {!! $settings['service4_icon'] !!}
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-500">Preview</p>
                                        </div>
                                        <div class="w-5/6">
                                            <textarea name="settings[service4_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['service4_icon'] }}</textarea>
                                            <p class="text-sm text-gray-500 mt-1">Enter the SVG path data for the icon</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Service 5 -->
                        <div x-show="activeService === 5" class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                    <span class="text-teal-700 font-bold">5</span>
                                </div>
                                <h3 class="text-lg font-semibold ml-3 text-gray-800">Service 5</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Title
                                    </label>
                                    <input type="text" name="settings[service5_title]" value="{{ $settings['service5_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Recommendation Text
                                    </label>
                                    <input type="text" name="settings[service5_recommendation]" value="{{ $settings['service5_recommendation'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    <p class="text-sm text-gray-500 mt-1">Short text shown at the bottom of the service card</p>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Description
                                    </label>
                                    <textarea name="settings[service5_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['service5_description'] }}</textarea>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Icon SVG Path
                                    </label>
                                    <div class="flex space-x-4">
                                        <div class="w-1/6">
                                            <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {!! $settings['service5_icon'] !!}
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-500">Preview</p>
                                        </div>
                                        <div class="w-5/6">
                                            <textarea name="settings[service5_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['service5_icon'] }}</textarea>
                                            <p class="text-sm text-gray-500 mt-1">Enter the SVG path data for the icon</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Service 6 -->
                        <div x-show="activeService === 6" class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                    <span class="text-teal-700 font-bold">6</span>
                                </div>
                                <h3 class="text-lg font-semibold ml-3 text-gray-800">Service 6</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Title
                                    </label>
                                    <input type="text" name="settings[service6_title]" value="{{ $settings['service6_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                </div>
                                
                                <div class="group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Recommendation Text
                                    </label>
                                    <input type="text" name="settings[service6_recommendation]" value="{{ $settings['service6_recommendation'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    <p class="text-sm text-gray-500 mt-1">Short text shown at the bottom of the service card</p>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Service Description
                                    </label>
                                    <textarea name="settings[service6_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['service6_description'] }}</textarea>
                                </div>
                                
                                <div class="md:col-span-2 group">
                                    <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                        Icon SVG Path
                                    </label>
                                    <div class="flex space-x-4">
                                        <div class="w-1/6">
                                            <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {!! $settings['service6_icon'] !!}
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-500">Preview</p>
                                        </div>
                                        <div class="w-5/6">
                                            <textarea name="settings[service6_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['service6_icon'] }}</textarea>
                                            <p class="text-sm text-gray-500 mt-1">Enter the SVG path data for the icon</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Advantages Tab -->
                <div x-show="activeTab === 'advantages'" class="mt-6">
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Why Choose Us Section</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    Section Subtitle
                                </label>
                                <input type="text" name="settings[advantages_subtitle]" value="{{ $settings['advantages_subtitle'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    Section Title
                                </label>
                                <input type="text" name="settings[advantages_title]" value="{{ $settings['advantages_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="md:col-span-2 group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    Section Description
                                </label>
                                <textarea name="settings[advantages_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['advantages_description'] }}</textarea>
                            </div>
                        </div>
                        
                        <div x-data="{ activeAdvantage: 1 }" class="space-y-6">
                            <!-- Advantage Navigation -->
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" @click="activeAdvantage = 1" :class="{'bg-teal-100 text-teal-700': activeAdvantage === 1, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeAdvantage !== 1}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Advantage 1
                                </button>
                                <button type="button" @click="activeAdvantage = 2" :class="{'bg-teal-100 text-teal-700': activeAdvantage === 2, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeAdvantage !== 2}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Advantage 2
                                </button>
                                <button type="button" @click="activeAdvantage = 3" :class="{'bg-teal-100 text-teal-700': activeAdvantage === 3, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeAdvantage !== 3}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    Advantage 3
                                </button>
                            </div>
                            
                            <!-- Advantage 1 -->
                            <div x-show="activeAdvantage === 1" class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <span class="text-teal-700 font-bold">1</span>
                                    </div>
                                    <h3 class="text-lg font-semibold ml-3 text-gray-800">Advantage 1</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Title
                                        </label>
                                        <input type="text" name="settings[advantage1_title]" value="{{ $settings['advantage1_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Description
                                        </label>
                                        <textarea name="settings[advantage1_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['advantage1_description'] }}</textarea>
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Icon SVG Path
                                        </label>
                                        <div class="flex space-x-4">
                                            <div class="w-1/6">
                                                <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                    <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        {!! $settings['advantage1_icon'] !!}
                                                    </svg>
                                                </div>
                                                <p class="text-xs text-gray-500">Preview</p>
                                            </div>
                                            <div class="w-5/6">
                                                <textarea name="settings[advantage1_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['advantage1_icon'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Advantage 2 -->
                            <div x-show="activeAdvantage === 2" class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <span class="text-teal-700 font-bold">2</span>
                                    </div>
                                    <h3 class="text-lg font-semibold ml-3 text-gray-800">Advantage 2</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Title
                                        </label>
                                        <input type="text" name="settings[advantage2_title]" value="{{ $settings['advantage2_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Description
                                        </label>
                                        <textarea name="settings[advantage2_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['advantage2_description'] }}</textarea>
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Icon SVG Path
                                        </label>
                                        <div class="flex space-x-4">
                                            <div class="w-1/6">
                                                <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                    <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        {!! $settings['advantage2_icon'] !!}
                                                    </svg>
                                                </div>
                                                <p class="text-xs text-gray-500">Preview</p>
                                            </div>
                                            <div class="w-5/6">
                                                <textarea name="settings[advantage2_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['advantage2_icon'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Advantage 3 -->
                            <div x-show="activeAdvantage === 3" class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <span class="text-teal-700 font-bold">3</span>
                                    </div>
                                    <h3 class="text-lg font-semibold ml-3 text-gray-800">Advantage 3</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Title
                                        </label>
                                        <input type="text" name="settings[advantage3_title]" value="{{ $settings['advantage3_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Description
                                        </label>
                                        <textarea name="settings[advantage3_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['advantage3_description'] }}</textarea>
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Icon SVG Path
                                        </label>
                                        <div class="flex space-x-4">
                                            <div class="w-1/6">
                                                <div class="bg-teal-100 rounded-full w-12 h-12 flex items-center justify-center mb-2">
                                                    <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        {!! $settings['advantage3_icon'] !!}
                                                    </svg>
                                                </div>
                                                <p class="text-xs text-gray-500">Preview</p>
                                            </div>
                                            <div class="w-5/6">
                                                <textarea name="settings[advantage3_icon]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200 font-mono text-sm" rows="2">{{ $settings['advantage3_icon'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- CTA Tab -->
                <div x-show="activeTab === 'cta'" class="mt-6">
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Call to Action Section</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    CTA Title
                                </label>
                                <input type="text" name="settings[cta_title]" value="{{ $settings['cta_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    Button Text
                                </label>
                                <input type="text" name="settings[cta_button_text]" value="{{ $settings['cta_button_text'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                            </div>
                            
                            <div class="md:col-span-2 group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    CTA Description
                                </label>
                                <textarea name="settings[cta_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['cta_description'] }}</textarea>
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    Satisfaction Percentage
                                </label>
                                <input type="text" name="settings[cta_satisfaction]" value="{{ $settings['cta_satisfaction'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                <p class="text-sm text-gray-500 mt-1">Example: 100%</p>
                            </div>
                            
                            <div class="group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    Satisfaction Text
                                </label>
                                <input type="text" name="settings[cta_satisfaction_text]" value="{{ $settings['cta_satisfaction_text'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                <p class="text-sm text-gray-500 mt-1">Example: Patient Satisfaction</p>
                            </div>
                            
                            <div class="md:col-span-2 group">
                                <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                    Satisfaction Description
                                </label>
                                <textarea name="settings[cta_satisfaction_description]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="2">{{ $settings['cta_satisfaction_description'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Tab -->
                <div x-show="activeTab === 'faq'" class="mt-6">
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-teal-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold ml-3 text-gray-800">Frequently Asked Questions</h2>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 mb-2 font-medium">
                                FAQ Section Title
                            </label>
                            <input type="text" name="settings[faq_title]" value="{{ $settings['faq_title'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        
                        <div x-data="{ activeFaq: 1 }" class="space-y-6">
                            <!-- FAQ Navigation -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                <button type="button" @click="activeFaq = 1" :class="{'bg-teal-100 text-teal-700': activeFaq === 1, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFaq !== 1}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    FAQ 1
                                </button>
                                <button type="button" @click="activeFaq = 2" :class="{'bg-teal-100 text-teal-700': activeFaq === 2, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFaq !== 2}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    FAQ 2
                                </button>
                                <button type="button" @click="activeFaq = 3" :class="{'bg-teal-100 text-teal-700': activeFaq === 3, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFaq !== 3}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    FAQ 3
                                </button>
                                <button type="button" @click="activeFaq = 4" :class="{'bg-teal-100 text-teal-700': activeFaq === 4, 'bg-gray-100 text-gray-700 hover:bg-gray-200': activeFaq !== 4}" class="py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200 focus:outline-none">
                                    FAQ 4
                                </button>
                            </div>
                            
                            <!-- FAQ 1 -->
                            <div x-show="activeFaq === 1" class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <span class="text-teal-700 font-bold">1</span>
                                    </div>
                                    <h3 class="text-lg font-semibold ml-3 text-gray-800">FAQ 1</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Question
                                        </label>
                                        <input type="text" name="settings[faq1_question]" value="{{ $settings['faq1_question'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Answer
                                        </label>
                                        <textarea name="settings[faq1_answer]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['faq1_answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- FAQ 2 -->
                            <div x-show="activeFaq === 2" class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <span class="text-teal-700 font-bold">2</span>
                                    </div>
                                    <h3 class="text-lg font-semibold ml-3 text-gray-800">FAQ 2</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Question
                                        </label>
                                        <input type="text" name="settings[faq2_question]" value="{{ $settings['faq2_question'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Answer
                                        </label>
                                        <textarea name="settings[faq2_answer]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['faq2_answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- FAQ 3 -->
                            <div x-show="activeFaq === 3" class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <span class="text-teal-700 font-bold">3</span>
                                    </div>
                                    <h3 class="text-lg font-semibold ml-3 text-gray-800">FAQ 3</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Question
                                        </label>
                                        <input type="text" name="settings[faq3_question]" value="{{ $settings['faq3_question'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Answer
                                        </label>
                                        <textarea name="settings[faq3_answer]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['faq3_answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- FAQ 4 -->
                            <div x-show="activeFaq === 4" class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <span class="text-teal-700 font-bold">4</span>
                                    </div>
                                    <h3 class="text-lg font-semibold ml-3 text-gray-800">FAQ 4</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Question
                                        </label>
                                        <input type="text" name="settings[faq4_question]" value="{{ $settings['faq4_question'] }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200">
                                    </div>
                                    
                                    <div class="group">
                                        <label class="block text-gray-700 mb-2 font-medium group-hover:text-teal-600 transition-colors duration-200">
                                            Answer
                                        </label>
                                        <textarea name="settings[faq4_answer]" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-teal-500 focus:border-transparent group-hover:border-teal-300 transition-colors duration-200" rows="3">{{ $settings['faq4_answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Save Button -->
            <div class="mt-8 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-all duration-300 shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-sidebar-layout>
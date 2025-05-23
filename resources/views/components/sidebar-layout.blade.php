<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>ANA FATIMA BARROSO Dental Clinic Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Tailwind & Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js" defer></script>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/fontawesome/all.min.css">
    <x-toastr-notification />
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-teal-50/30 overflow-x-hidden">
    <!-- Mobile Header -->
    <header
        class="fixed top-0 left-0 right-0 bg-white shadow z-40 px-4 py-3 flex items-center justify-between md:flex lg:hidden sm:flex">
        <div class="flex items-center space-x-3">
            <img src="{{ Auth::user()->image_path ? asset(path: 'storage/' . Auth::user()->image_path) : asset('images/default-avatar.png') }}"
                class="h-9 w-9 rounded-full object-cover border-2 border-teal-200" />
            <div>
                <span class="block text-teal-800 font-medium text-sm">{{ \Auth::user()->firstname }}
                    {{ \Auth::user()->middleinitial }}. {{ \Auth::user()->lastname }}</span>
                <span class="block text-teal-500 text-xs">@if (Auth::user()->user_type === 'admin') Administrator @else
                Staff @endif</span>
            </div>
        </div>
        <button type="button" id="burger-button"
            class="text-teal-600 p-2 rounded hover:bg-teal-50 hover:text-teal-800 transition md:block lg:hidden sm:block">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </header>
    <!-- Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-30 cursor-pointer"></div>
    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 w-72 h-screen bg-white shadow-xl z-50 transform -translate-x-full transition-transform duration-300 lg:translate-x-0 flex flex-col">
        <!-- Logo & Profile -->
        <div class="flex flex-col items-center border-b border-teal-100 px-4 py-6">
            <div class="flex flex-row items-center justify-between  px-4 py-2 w-full">
                <!-- Clinic Logo -->
                <img src="/images/logo.png" alt="Clinic Logo" class="h-16 object-contain" />

                <div class="relative">
                    <a href="{{ route('messages') }}"
                        class="px-3 py-2 bg-teal-500 text-white text-xs font-medium rounded-lg shadow hover:bg-teal-600 transition flex items-center space-x-2">
                        <span class="text-center">Inbox</span>
                    </a>

                    <!-- Red Circle Notification -->
                    <span
                        class="absolute -top-1 -right-1 h-3 w-3 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
                </div>

            </div>
            <img src="{{ Auth::user()->image_path ? asset(path: 'storage/' . Auth::user()->image_path) : asset('images/default-avatar.png') }}" alt="Admin Avatar"
                class="h-24 w-24 rounded-full object-cover border-4 border-teal-100 shadow" />
            <div class="mt-4 text-center">
                <h2 class="text-lg font-semibold text-teal-800">{{ \Auth::user()->firstname }}
                    {{ \Auth::user()->middleinitial }}. {{ \Auth::user()->lastname }}
                </h2>
                <p class="text-sm text-teal-500">@if (Auth::user()->user_type === 'admin') Administrator @else Staff
                @endif</p>
            </div>

        </div>
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-4 py-4">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                @if (request()->routeIs('admin.dashboard')) bg-teal-50 text-teal-600 font-medium @endif">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                Dashboard
            </a>
            <!-- Appointments -->
            <a href="{{ route('appointments.index') }}" class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                @if (request()->routeIs('appointments.index')) bg-teal-50 text-teal-600 font-medium @endif">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 01-1-1H5a2 2 0 01-1 1v12a2 2 0 002 2z">
                    </path>
                </svg>
                Manage Appointments
            </a>

            <!-- Manage Slots -->
            <a href="{{ route('admin.appointments.create') }}" class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                @if (request()->routeIs('admin.appointments.create')) bg-teal-50 text-teal-600 font-medium @endif">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                Manage Slots
            </a>
            <!-- Calendar -->
            <a href="{{ route('admin.calendar') }}" class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                @if (request()->routeIs('admin.calendar')) bg-teal-50 text-teal-600 font-medium @endif">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Calendar
            </a>
            
            
            <!-- Manage Inventory -->
            <a href="{{ route('admin.inventory') }}" class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                @if (request()->routeIs('admin.inventory')) bg-teal-50 text-teal-600 font-medium @endif">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Manage Inventory
            </a>
            <!-- Manage Jobs -->
            <a href="{{ route('admin.manage_jobs') }}" class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                @if (request()->routeIs('admin.manage_jobs')) bg-teal-50 text-teal-600 font-medium @endif">
                <!-- Job management icon (briefcase) -->
              <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path fill="currentColor" d="M8 1V0v1Zm4 0V0v1Zm2 4v1h1V5h-1ZM6 5H5v1h1V5Zm2-3h4V0H8v2Zm4 0a1 1 0 0 1 .707.293L14.121.879A3 3 0 0 0 12 0v2Zm.707.293A1 1 0 0 1 13 3h2a3 3 0 0 0-.879-2.121l-1.414 1.414ZM13 3v2h2V3h-2Zm1 1H6v2h8V4ZM7 5V3H5v2h2Zm0-2a1 1 0 0 1 .293-.707L5.879.879A3 3 0 0 0 5 3h2Zm.293-.707A1 1 0 0 1 8 2V0a3 3 0 0 0-2.121.879l1.414 1.414ZM2 6h16V4H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v12h2V6h-2Zm0 12v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V6H0v12h2ZM2 6V4a2 2 0 0 0-2 2h2Zm16.293 3.293C16.557 11.029 13.366 12 10 12c-3.366 0-6.557-.97-8.293-2.707L.293 10.707C2.557 12.971 6.366 14 10 14c3.634 0 7.444-1.03 9.707-3.293l-1.414-1.414ZM10 9v2a2 2 0 0 0 2-2h-2Zm0 0H8a2 2 0 0 0 2 2V9Zm0 0V7a2 2 0 0 0-2 2h2Zm0 0h2a2 2 0 0 0-2-2v2Z"></path>
            </svg>        
              Manage Jobs
            </a>
            <!-- Patient Records -->
            <a href="{{ route('admin.patient-records') }}" class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
@if (request()->routeIs('admin.patient-records')) bg-teal-50 text-teal-600 font-medium @endif">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
                Patient Records
            </a>
            <!-- Graphs Dropdown -->
            <div x-data="{ open: false }" class="mb-1">
                <button @click="open = !open"
                    class="w-full flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 transition">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Graphs and Reports
                    <svg class="w-5 h-5 ml-auto transform transition-transform" :class="open ? 'rotate-180' : ''"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <!-- Dropdown items -->
                <div x-show="open" x-transition class="mt-1 ml-8 space-y-1 bg-white rounded">
                    <a href="{{ route('admin.graphs.appointments') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-teal-50 hover:text-teal-600 rounded-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 01-2-2H6a2 2 0 01-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Appointment Analytics
                    </a>
                    <a href="{{ route('admin.reports.status_during_period', ['status' => 'Pending']) }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-teal-50 hover:text-teal-600 rounded-lg {{ request()->routeIs('admin.reports.status_during_period') && request()->status == 'Pending' ? 'bg-teal-50 text-teal-600' : '' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Appointment Status History
                    </a>
                    <a href="{{ route('admin.graphs.inventory') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-teal-50 hover:text-teal-600 rounded-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z">
                            </path>
                        </svg>
                        Inventory Metrics
                    </a>
                    <a href="{{ route('admin.graphs.users') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-teal-50 hover:text-teal-600 rounded-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        User Registration Analytics
                    </a>
                </div>
            </div>
            <!-- Log History -->
            @can('view-logHistory')
                <a href="{{ route('admin.log-history') }}"
                    class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    Log History
                </a>
            @endcan

            @can('view-users')
                <!-- Users -->
                <a href="{{ route('admin.users') }}"
                    class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                                                                                                                                                                                                                                @if (request()->routeIs('admin.users')) bg-teal-50 text-teal-600 font-medium @endif">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Users
                </a>
            @endcan

            <!-- Sentiment Analysis -->
            <a href="{{ route('admin.sentiment') }}" class="flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                @if (request()->routeIs('admin.sentiment')) bg-teal-50 text-teal-600 font-medium @endif">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Sentiment Analysis
            </a>
            
            <!-- Settings Dropdown -->
            <div x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }" class="mb-1">
                <!-- Settings Parent Item -->
                <button @click="open = !open" class="w-full flex items-center p-3 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600 mb-1
                    @if (request()->routeIs('admin.settings.*')) bg-teal-50 text-teal-600 font-medium @endif">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                    <span class="flex-1 text-left">Settings</span>
                    <svg class="w-4 h-4 ml-2 transition-transform duration-200" 
                        :class="{'rotate-180': open, 'rotate-0': !open}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <!-- Dropdown Menu -->
                <div x-show="open" x-transition:enter="transition ease-out duration-100" 
                    x-transition:enter-start="transform opacity-0 scale-95" 
                    x-transition:enter-end="transform opacity-100 scale-100" 
                    x-transition:leave="transition ease-in duration-75" 
                    x-transition:leave-start="transform opacity-100 scale-100" 
                    x-transition:leave-end="transform opacity-0 scale-95" 
                    class="pl-8 mt-1 space-y-1">
                    
                    <!-- Contact Page Settings -->
                    <a href="{{ route('admin.settings.contact') }}" class="flex items-center p-2 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600
                        @if (request()->routeIs('admin.settings.contact')) bg-teal-50 text-teal-600 font-medium @endif">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Contact
                    </a>
                            <!-- About Page Settings -->
                    <a href="{{ route('admin.settings.about') }}" class="flex items-center p-2 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600
                        @if (request()->routeIs('admin.settings.about')) bg-teal-50 text-teal-600 font-medium @endif">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        About
                    </a>
                    
                    <!-- Services Page Settings -->
                    <a href="{{ route('admin.settings.services') }}" class="flex items-center p-2 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600
                        @if (request()->routeIs('admin.settings.services')) bg-teal-50 text-teal-600 font-medium @endif">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        Services
                    </a>
                        <!-- Pricing Page Settings -->
                <a href="{{ route('admin.settings.pricing') }}" class="flex items-center p-2 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600
                    @if (request()->routeIs('admin.settings.pricing')) bg-teal-50 text-teal-600 font-medium @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    Pricing
                </a>
                
                <a href="{{ route('admin.personnel') }}" class="flex items-center p-2 rounded-lg hover:bg-teal-50 hover:text-teal-600 text-gray-600
                    @if (request()->routeIs('admin.personnel')) bg-teal-50 text-teal-600 font-medium @endif">
                   <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4H1m3 4H1m3 4H1m3 4H1m6.071.286a3.429 3.429 0 1 1 6.858 0M4 1h12a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Zm9 6.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path>
                    </svg>
                    Personnel
                </a>
                </div>
            </div>
        </nav>

        <!-- Logout at the bottom -->
        <div class="border-t border-teal-100 px-4 py-3">
            <form id="logout-form" method="POST" action="/logout">
                @csrf
                <button type="button" onclick="showLogoutModal()"
                    class="flex items-center w-full px-3 py-2 text-gray-600 rounded-lg hover:bg-red-50 hover:text-red-600 transition">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>
    <!-- Main content area -->
    <main class="lg:ml-72 pt-16 lg:pt-0 min-h-screen">
        <div class="p-6 max-w-[2000px] mx-auto">
            <div class="bg-white rounded-lg shadow-md border border-teal-100 p-6">
                {{ $slot }}
            </div>
        </div>
    </main>
    
        <!-- Improved Logout Modal-->
        <div id="logout-modal" class="hidden fixed inset-0 z-50">
            <!-- Backdrop with blur effect -->
            <div class="absolute inset-0 bg-gray-800 bg-opacity-60 backdrop-blur-sm transition-opacity duration-300"></div>
            
            <!-- Modal Container -->
            <div class="fixed inset-0 flex items-center justify-center px-4 py-6">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden border-2 border-teal-200 transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
                    <!-- Modal Header -->
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 px-6 py-4 flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white">Confirm Logout</h3>
                        <button onclick="hideLogoutModal()" class="text-white hover:text-red-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="px-6 py-5">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-700 font-medium mb-2">
                                    Are you sure you want to log out?
                                </p>
                                <p class="text-gray-500 text-sm">
                                    You'll need to sign in again to access your account and manage appointments.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Footer with Increased Button Spacing -->
                    <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse space-y-3 sm:space-y-0 border-t border-teal-100">
                        <button type="button" onclick="confirmLogout()"
                            class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-xl shadow-md hover:from-red-600 hover:to-red-700 focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition-all duration-300 transform hover:scale-105">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Log Out
                            </span>
                        </button>
                        <!-- Added margin between buttons -->
                        <div class="sm:mr-4"></div>
                        <button type="button" onclick="hideLogoutModal()"
                            class="w-full sm:w-auto px-6 py-2.5 bg-white text-teal-700 font-medium rounded-xl border-2 border-teal-300 hover:bg-teal-50 focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50 transition-all duration-300">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Scripts -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const burgerButton = document.getElementById('burger-button');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            const isOpen = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
            document.body.classList.toggle('overflow-hidden');
        }

        // Burger button click
        burgerButton?.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleSidebar();
        });

        // Overlay click
        overlay?.addEventListener('click', toggleSidebar);

        // Click outside
        document.addEventListener('click', (e) => {
            if (
                window.innerWidth < 1024 && // For mobile and tablet
                !sidebar.contains(e.target) &&
                !burgerButton.contains(e.target) &&
                !sidebar.classList.contains('-translate-x-full')
            ) {
                toggleSidebar();
            }
        });

        // Resize handler
        window.addEventListener('resize', () => {
            const width = window.innerWidth;
            if (width >= 1024) { // Desktop
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else { // Mobile and Tablet
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Initialize sidebar state on page load
        window.addEventListener('load', () => {
            const width = window.innerWidth;
            if (width < 1024) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Improved Logout functions with animation
        function showLogoutModal() {
            const modal = document.getElementById('logout-modal');
            const modalContent = document.getElementById('modal-content');
            
            // Show the modal container first
            modal.classList.remove('hidden');
            
            // Trigger a reflow to ensure the transition works
            void modalContent.offsetWidth;
            
            // Animate in the modal content
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
            
            document.body.classList.add('overflow-hidden');
        }

        function hideLogoutModal() {
            const modal = document.getElementById('logout-modal');
            const modalContent = document.getElementById('modal-content');
            
            // Animate out
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            // Hide the modal after animation completes
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }

        // ESC key handler
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                hideLogoutModal();
                if (!sidebar.classList.contains('-translate-x-full') && window.innerWidth < 1024) {
                    toggleSidebar();
                }
            }
        });
    </script>
    @stack('scripts')
    <!-- Screen Size Indicator (Optional - for debugging) -->
    <div class="fixed bottom-0 right-0 bg-teal-800 text-white p-2 text-sm z-50">
        <span class="sm:hidden">Mobile View (Hidden Sidebar)</span>
        <span class="hidden sm:inline md:inline lg:hidden">Medium View (Burger Menu)</span>
        <span class="hidden lg:inline">Large View (Fixed Sidebar)</span>
    </div>
</body>

</html>
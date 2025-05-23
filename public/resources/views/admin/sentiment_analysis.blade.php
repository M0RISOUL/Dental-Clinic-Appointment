<x-sidebar-layout>
    <!-- Header Section -->
    <div class="mb-8 rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-teal-700 to-teal-600 p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center">
                    <div class="bg-white/20 backdrop-blur-sm p-3 rounded-lg mr-4 shadow-inner">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-1 tracking-tight">Sentiment Analysis</h1>
                        <p class="text-teal-100">Monitor and analyze patient feedback and reviews</p>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0">
                    <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-white text-teal-700 shadow-md hover:shadow-lg transition-shadow">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Feedback Analytics
                    </span>
                </div>
            </div>
        </div>
        <div class="bg-teal-50 px-6 py-3 border-t border-teal-200">
            <div class="flex items-center text-sm text-teal-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Analyze patient sentiment and feedback trends from this dashboard.</span>
            </div>
        </div>
    </div>

    <!-- Section Title: Key Metrics -->
    <div class="flex items-center mb-4">
        <div class="h-8 w-1 bg-gradient-to-b from-teal-600 to-teal-400 rounded-full mr-3"></div>
        <h2 class="text-xl font-bold text-teal-800">Key Metrics</h2>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Positive Sentiment Card -->
        <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-md border border-teal-200 p-5 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-teal-900">Positive Reviews</h2>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-teal-800">
                            {{ number_format(($positiveCount / max($totalReviews, 1)) * 100, 0) }}%
                        </p>
                        <span class="ml-2 text-xs text-teal-600">{{ $positiveCount }} reviews</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Neutral Sentiment Card -->
        <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-md border border-teal-200 p-5 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-teal-900">Neutral Reviews</h2>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-teal-800">
                            {{ number_format(($neutralCount / max($totalReviews, 1)) * 100, 0) }}%
                        </p>
                        <span class="ml-2 text-xs text-teal-600">{{ $neutralCount }} reviews</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Negative Sentiment Card -->
        <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-md border border-teal-200 p-5 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-teal-900">Negative Reviews</h2>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-teal-800">
                            {{ number_format(($negativeCount / max($totalReviews, 1)) * 100, 0) }}%
                        </p>
                        <span class="ml-2 text-xs text-teal-600">{{ $negativeCount }} reviews</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Average Rating Card -->
        <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-md border border-teal-200 p-5 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-teal-900">Average Rating</h2>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-teal-800">
                            {{ number_format($averageRating, 1) }}/5
                        </p>
                        <span class="ml-2 text-xs text-teal-600">from {{ $totalReviews }} reviews</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Title: Sentiment Trends -->
    <div class="flex items-center mb-4">
        <div class="h-8 w-1 bg-gradient-to-b from-teal-600 to-teal-400 rounded-full mr-3"></div>
        <h2 class="text-xl font-bold text-teal-800">Sentiment Trends</h2>
    </div>

    <!-- Sentiment Trend Chart -->
    <div class="bg-white rounded-xl shadow-md border border-teal-200 p-6 mb-8 hover:shadow-lg transition-shadow">
        <h3 class="text-lg font-semibold text-teal-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
            </svg>
            Sentiment Trends Over Time
        </h3>
        <div class="h-96">
            <canvas id="sentimentTrendChart"></canvas>
        </div>
    </div>

    <!-- Section Title: Filters -->
    <div class="flex items-center mb-4">
        <div class="h-8 w-1 bg-gradient-to-b from-teal-600 to-teal-400 rounded-full mr-3"></div>
        <h2 class="text-xl font-bold text-teal-800">Filter & Search</h2>
    </div>

    <!-- Filters and Search -->
    <div class="bg-gradient-to-r from-teal-50 to-white rounded-xl shadow-md p-6 mb-8 border border-teal-100">
        <form action="{{ route('admin.sentiment') }}" method="GET" class="flex flex-wrap gap-5 items-end">
            <!-- Date Range Filter -->
            <div class="flex-1 min-w-[200px]">
                <label for="dateRange" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Date Range
                </label>
                <div class="relative">
                    <select id="dateRange" name="date_range" class="w-full p-2.5 border border-teal-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 bg-white appearance-none shadow-sm">
                        <option value="7" {{ request('date_range') == '7' ? 'selected' : '' }}>Last 7 days</option>
                        <option value="30" {{ request('date_range') == '30' ? 'selected' : '' }}>Last 30 days</option>
                        <option value="90" {{ request('date_range') == '90' ? 'selected' : '' }}>Last 90 days</option>
                        <option value="365" {{ request('date_range') == '365' ? 'selected' : '' }}>This year</option>
                        <option value="all" {{ request('date_range') == 'all' ? 'selected' : '' }}>All time</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-teal-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Sentiment Filter -->
            <div class="flex-1 min-w-[200px]">
                <label for="sentiment" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Sentiment
                </label>
                <div class="relative">
                    <select id="sentiment" name="sentiment" class="w-full p-2.5 border border-teal-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 bg-white appearance-none shadow-sm">
                        <option value="" {{ request('sentiment') == '' ? 'selected' : '' }}>All Sentiments</option>
                        <option value="positive" {{ request('sentiment') == 'positive' ? 'selected' : '' }}>Positive</option>
                        <option value="neutral" {{ request('sentiment') == 'neutral' ? 'selected' : '' }}>Neutral</option>
                        <option value="negative" {{ request('sentiment') == 'negative' ? 'selected' : '' }}>Negative</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-teal-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Service Filter -->
            <div class="flex-1 min-w-[200px]">
                <label for="service" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Service
                </label>
                <div class="relative">
                    <select id="service" name="service" class="w-full p-2.5 border border-teal-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 bg-white appearance-none shadow-sm">
                        <option value="" {{ request('service') == '' ? 'selected' : '' }}>All Services</option>
                        @foreach($services as $service)
                        <option value="{{ $service }}" {{ request('service') == $service ? 'selected' : '' }}>{{ $service }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-teal-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Search -->
            <div class="flex-1 min-w-[200px]">
                <label for="search" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search Reviews
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search reviews..."
                        class="pl-10 w-full p-2.5 border border-teal-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 bg-white shadow-sm" />
                </div>
            </div>
            
            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="bg-teal-600 text-white px-5 py-2.5 rounded-lg hover:bg-teal-700 transition shadow-md font-medium flex items-center gap-2 hover:shadow-lg transform hover:-translate-y-0.5 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Apply Filters
                </button>
            </div>
            
            <!-- Reset Filters -->
            <div>
                <a href="{{ route('admin.sentiment') }}"
                    class="bg-white text-teal-700 border border-teal-200 px-5 py-2.5 rounded-lg hover:bg-teal-50 transition shadow-md font-medium inline-flex items-center hover:shadow-lg transform hover:-translate-y-0.5 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Section Title: Reviews -->
    <div class="flex items-center mb-4">
        <div class="h-8 w-1 bg-gradient-to-b from-teal-600 to-teal-400 rounded-full mr-3"></div>
        <h2 class="text-xl font-bold text-teal-800">Patient Reviews</h2>
    </div>

    <!-- Reviews Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-teal-100 mb-8 hover:shadow-lg transition-shadow">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gradient-to-r from-teal-100 to-teal-50">
                    <tr>
                        <th class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider whitespace-nowrap border-r border-teal-200">Appointment ID</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider whitespace-nowrap border-r border-teal-200">Patient</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider whitespace-nowrap border-r border-teal-200">Rating</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider whitespace-nowrap border-r border-teal-200">Service</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider whitespace-nowrap border-r border-teal-200">Review</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider whitespace-nowrap border-r border-teal-200">Sentiment</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-teal-100">
                    @forelse ($reviews as $review)
                    <tr class="hover:bg-teal-50 transition-colors duration-150">
                        <!-- Appointment ID -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-900 font-medium border-r border-teal-50">
                            {{ $review->appointment_id }}
                        </td>
                        
                        <!-- Patient -->
                        <td class="px-6 py-4 whitespace-nowrap border-r border-teal-50">
                            <div class="flex items-center">
                                @php
                                $initials = $review->user && $review->user->name
                                    ? collect(explode(' ', $review->user->name))->map(fn($n) => strtoupper(substr($n, 0, 1)))->join('')
                                    : 'NA';
                                @endphp
                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center text-white font-medium shadow-sm">
                                    {{ $initials }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $review->user->name ?? 'Unknown' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Rating (Stars) -->
                        <td class="px-6 py-4 whitespace-nowrap border-r border-teal-50">
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                @endfor
                            </div>
                        </td>
                        
                        <!-- Service -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-600 border-r border-teal-50">
                            {{ $review->service }}
                        </td>
                        
                        <!-- Review Text -->
                        <td class="px-6 py-4 border-r border-teal-50">
                            <p class="text-sm text-teal-600 max-w-xs truncate" title="{{ $review->review }}">
                                {{ $review->review }}
                            </p>
                        </td>
                        
                        <!-- Sentiment -->
                        <td class="px-6 py-4 whitespace-nowrap border-r border-teal-50">
                            @if ($review->sentiment === 'positive')
                            <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-xs font-medium rounded-full bg-green-100 text-green-800 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ ucfirst($review->sentiment) }}
                            </span>
                            @elseif ($review->sentiment === 'neutral')
                            <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ ucfirst($review->sentiment) }}
                            </span>
                            @elseif ($review->sentiment === 'negative')
                            <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-xs font-medium rounded-full bg-red-100 text-red-800 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ ucfirst($review->sentiment) }}
                            </span>
                            @else
                            <span class="px-3 py-1.5 inline-flex items-center gap-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-800 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Not Analyzed
                            </span>
                            @endif
                            @if($review->probability)
                            <div class="mt-1 text-xs text-gray-500">{{ number_format($review->probability * 100, 0) }}% confidence</div>
                            @endif
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="px-3 py-1.5 text-sm bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center shadow-sm hover:shadow-md"
                                onclick="openViewModal('{{ $review->id }}', '{{ $review->appointment_id }}', '{{ $review->user->name ?? 'Unknown' }}', '{{ $review->rating }}', '{{ $review->service }}', '{{ addslashes($review->review) }}', '{{ $review->sentiment }}', '{{ $review->probability }}', '{{ $review->created_at }}')">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Details
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-teal-600">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-teal-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No reviews found</p>
                                <p class="text-sm text-teal-500 mt-1">Try adjusting your filters or search criteria</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 border-t border-teal-100">
            {{ $reviews->withQueryString()->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Section Title: Analytics -->
    <div class="flex items-center mb-4">
        <div class="h-8 w-1 bg-gradient-to-b from-teal-600 to-teal-400 rounded-full mr-3"></div>
        <h2 class="text-xl font-bold text-teal-800">Analytics & Insights</h2>
    </div>

    <!-- Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Sentiment Distribution Pie Chart -->
        <div class="bg-white rounded-xl shadow-md border border-teal-200 p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-teal-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                Sentiment Distribution
            </h3>
            <div class="h-80">
                <canvas id="sentimentPieChart"></canvas>
            </div>
        </div>
        
        <!-- Rating Distribution -->
        <div class="bg-white rounded-xl shadow-md border border-teal-200 p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-teal-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
                Rating Distribution
            </h3>
            <div class="h-80">
                <canvas id="ratingDistributionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
        <!-- Review Volume -->
        <div class="bg-white rounded-xl shadow-md border border-teal-200 p-6 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
                <h3 class="text-md font-medium text-gray-700">Review Volume</h3>
            </div>
            <div class="flex items-baseline">
                <p class="text-3xl font-semibold text-gray-800">{{ $reviewsThisMonth }}</p>
                <span class="ml-2 text-sm text-purple-600 font-medium">this month</span>
            </div>
            <div class="mt-2 text-sm text-gray-500 flex items-center">
                @if($reviewGrowth > 0)
                <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <span class="text-green-600">+{{ $reviewGrowth }}%</span>
                @elseif($reviewGrowth < 0)
                <svg class="w-4 h-4 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                </svg>
                <span class="text-red-600">{{ $reviewGrowth }}%</span>
                @else
                <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                </svg>
                <span>No change</span>
                @endif
                <span class="ml-1">from last month</span>
            </div>
        </div>
        
        <!-- Patient Satisfaction Index -->
        <div class="bg-white rounded-xl shadow-md border border-teal-200 p-6 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 rounded-full bg-amber-100 text-amber-600 mr-4 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-md font-medium text-gray-700">Satisfaction Index</h3>
            </div>
            <div class="flex items-baseline">
                <p class="text-3xl font-semibold text-gray-800">{{ number_format($satisfactionIndex, 1) }}</p>
                <span class="ml-2 text-sm text-amber-600 font-medium">out of 10</span>
            </div>
            <div class="mt-2 text-sm text-gray-500">
                Based on sentiment analysis and rating scores
            </div>
        </div>
    </div>

    <!-- Section Title: Service Analysis -->
    <div class="flex items-center mb-4">
        <div class="h-8 w-1 bg-gradient-to-b from-teal-600 to-teal-400 rounded-full mr-3"></div>
        <h2 class="text-xl font-bold text-teal-800">Service Analysis</h2>
    </div>

    <!-- Service Analysis Section -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-teal-100 mb-8 hover:shadow-lg transition-shadow">
        <div class="bg-gradient-to-r from-teal-700 to-teal-600 px-6 py-4">
            <h2 class="text-lg font-medium text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Sentiment Analysis Summary
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <!-- Summary Stats -->
                <div>
                    <h3 class="text-md font-semibold text-teal-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Key Metrics
                    </h3>
                    <div class="space-y-4 bg-teal-50 p-5 rounded-xl border border-teal-100 shadow-sm">
                        <div class="flex justify-between items-center pb-3 border-b border-teal-100">
                            <span class="text-sm text-teal-700 font-medium">Total Reviews</span>
                            <span class="text-sm font-semibold text-teal-900 bg-teal-100 px-3 py-1 rounded-full">{{ $totalReviews }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-teal-100">
                            <span class="text-sm text-teal-700 font-medium">Average Rating</span>
                            <div class="flex items-center">
                                <span class="text-sm font-semibold text-teal-900 bg-teal-100 px-3 py-1 rounded-full">{{ number_format($averageRating, 1) }}/5.0</span>
                                <div class="ml-2 flex text-yellow-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-teal-100">
                            <span class="text-sm text-teal-700 font-medium">Positive Sentiment</span>
                            <div class="flex items-center">
                                <span class="text-sm font-semibold text-green-800 bg-green-100 px-3 py-1 rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ number_format(($positiveCount / max($totalReviews, 1)) * 100, 0) }}% ({{ $positiveCount }} reviews)
                                </span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-teal-100">
                            <span class="text-sm text-teal-700 font-medium">Neutral Sentiment</span>
                            <div class="flex items-center">
                                <span class="text-sm font-semibold text-yellow-800 bg-yellow-100 px-3 py-1 rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ number_format(($neutralCount / max($totalReviews, 1)) * 100, 0) }}% ({{ $neutralCount }} reviews)
                                </span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-teal-100">
                            <span class="text-sm text-teal-700 font-medium">Negative Sentiment</span>
                            <div class="flex items-center">
                                <span class="text-sm font-semibold text-red-800 bg-red-100 px-3 py-1 rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ number_format(($negativeCount / max($totalReviews, 1)) * 100, 0) }}% ({{ $negativeCount }} reviews)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Service Analysis Table -->
                <div class="mt-6">
                    <h3 class="text-md font-semibold text-teal-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Service-Based Analysis
                    </h3>
                    <div class="overflow-x-auto max-h-96 overflow-y-auto bg-white rounded-xl border border-teal-200 shadow-md">
                        <table class="min-w-full divide-y divide-teal-200">
                            <thead class="bg-teal-50 sticky top-0 z-10">
                                <tr>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Service</th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Reviews</th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Avg. Rating</th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Positive</th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Neutral</th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Negative</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-teal-100">
                                @foreach($serviceAnalysis as $analysis)
                                <tr class="hover:bg-teal-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-teal-800">{{ $analysis->service }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-600">{{ $analysis->total }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm text-teal-600 font-medium mr-2">{{ number_format($analysis->avg_rating, 1) }}</span>
                                            <div class="flex text-yellow-400">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= round($analysis->avg_rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm text-teal-600">{{ $analysis->positive_count }}</span>
                                            <span class="ml-2 text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full">({{ number_format(($analysis->positive_count / max($analysis->total, 1)) * 100, 0) }}%)</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm text-teal-600">{{ $analysis->neutral_count }}</span>
                                            <span class="ml-2 text-xs text-yellow-600 bg-yellow-50 px-2 py-0.5 rounded-full">({{ number_format(($analysis->neutral_count / max($analysis->total, 1)) * 100, 0) }}%)</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm text-teal-600">{{ $analysis->negative_count }}</span>
                                            <span class="ml-2 text-xs text-red-600 bg-red-50 px-2 py-0.5 rounded-full">({{ number_format(($analysis->negative_count / max($analysis->total, 1)) * 100, 0) }}%)</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- View Review Modal -->
<div id="viewModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 overflow-hidden transform transition-all max-h-[90vh] flex flex-col">
        <!-- Modal Header-->
        <div class="px-6 py-5 border-b rounded-t-2xl bg-gradient-to-r from-teal-700 to-teal-600 flex-shrink-0">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-medium text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Patient Review Details
                </h3>
                <button onclick="closeViewModal()" class="text-white hover:text-teal-200 focus:outline-none transition-colors p-1 rounded-full hover:bg-white/10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Modal Content -->
        <div class="px-6 py-5 bg-gradient-to-b from-teal-50 to-white overflow-y-auto flex-grow">
            <!-- Patient Info Section -->
            <div class="flex flex-col sm:flex-row sm:items-center mb-6 bg-white p-5 rounded-xl shadow-sm border border-teal-100">
                <div class="flex items-center">
                    <div id="modal-initials" class="h-16 w-16 rounded-full bg-gradient-to-br from-teal-600 to-teal-500 flex items-center justify-center text-white font-bold text-xl shadow-md">
                        JD
                    </div>
                    <div class="ml-4">
                        <h4 id="modal-patient-name" class="text-lg font-semibold text-teal-900">John Doe</h4>
                        <div class="flex items-center mt-1 text-sm text-teal-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="modal-date">March 15, 2023</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-auto">
                    <p id="modal-appointment-id" class="text-sm text-teal-700 flex items-center bg-teal-100 px-3 py-1.5 rounded-full shadow-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        APT-2023-052
                    </p>
                </div>
            </div>
            
            <!-- Review Details Grid  -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                <!-- Service  -->
                <div class="bg-white p-5 rounded-xl border border-teal-200 shadow-sm hover:shadow-md transition-shadow">
                    <h5 class="text-sm font-medium text-teal-700 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Service Type
                    </h5>
                    <div class="flex items-center mt-2">
                        <div class="p-2.5 rounded-full bg-teal-100 mr-3">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <p id="modal-service" class="text-base text-teal-900 font-medium">Dental Cleaning</p>
                    </div>
                    <div class="mt-3 text-xs text-teal-500 flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span id="modal-date-full">March 15, 2023 at 2:30 PM</span>
                    </div>
                </div>
                
                <!-- Rating  -->
                <div class="bg-white p-5 rounded-xl border border-teal-200 shadow-sm hover:shadow-md transition-shadow">
                    <h5 class="text-sm font-medium text-teal-700 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Patient Rating
                    </h5>
                    <div class="mt-2">
                        <div id="modal-rating" class="flex items-center">
                            <!-- Stars will be inserted here by JavaScript -->
                        </div>
                        <div class="mt-3 flex items-center">
                            <div class="h-2 flex-grow rounded-full bg-gray-200 overflow-hidden">
                                <div id="modal-rating-bar" class="h-full bg-yellow-400" style="width: 80%"></div>
                            </div>
                            <span id="modal-rating-text" class="ml-3 text-lg font-semibold text-teal-800">4.0/5</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sentiment  -->
            <div class="mb-6">
                <h5 class="text-sm font-medium text-teal-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Sentiment Analysis
                </h5>
                <div class="bg-white p-5 rounded-xl border border-teal-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <div id="modal-sentiment-icon" class="p-3.5 rounded-full bg-green-100 text-green-600 mb-3 sm:mb-0 sm:mr-4 inline-flex">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                <h4 id="modal-sentiment" class="text-lg font-semibold text-teal-900">Positive</h4>
                                <span id="modal-probability" class="text-sm bg-teal-100 text-teal-800 px-2.5 py-0.5 rounded-full">95% confidence</span>
                            </div>
                            <div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                    <div id="modal-probability-bar" class="bg-green-600 h-2.5 rounded-full" style="width: 95%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>0%</span>
                                    <span>50%</span>
                                    <span>100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Review Text -->
            <div>
                <h5 class="text-sm font-medium text-teal-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Patient Feedback
                </h5>
                <div class="bg-white p-5 rounded-xl border border-teal-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex mb-3">
                        <svg class="w-5 h-5 text-teal-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <p id="modal-review" class="text-gray-700 leading-relaxed">
                            The dental cleaning service was excellent. The staff was friendly and professional. I would highly recommend this clinic to anyone looking for quality dental care.
                        </p>
                    </div>
                    <div class="text-xs text-gray-500 italic border-t border-gray-100 pt-3 mt-2">
                        Submitted on <span id="modal-date-submitted">March 15, 2023</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="px-6 py-4 bg-teal-50 border-t border-teal-200 flex justify-end flex-shrink-0">
            <button onclick="closeViewModal()" class="bg-white text-teal-700 border border-teal-300 px-4 py-2 rounded-lg hover:bg-teal-50 transition shadow-sm font-medium flex items-center">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Close
            </button>
        </div>
    </div>
</div>

    <!-- JavaScript for Charts and Modal -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sentiment Trend Chart
        const sentimentTrendCtx = document.getElementById('sentimentTrendChart').getContext('2d');
        const sentimentTrendChart = new Chart(sentimentTrendCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($sentimentTrend['labels']) !!},
                datasets: [
                    {
                        label: 'Positive',
                        data: {!! json_encode($sentimentTrend['positive']) !!},
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Neutral',
                        data: {!! json_encode($sentimentTrend['neutral']) !!},
                        borderColor: '#F59E0B',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Negative',
                        data: {!! json_encode($sentimentTrend['negative']) !!},
                        borderColor: '#EF4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 6,
                            font: {
                                family: "'Inter', sans-serif",
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: {
                            family: "'Inter', sans-serif",
                            size: 13
                        },
                        bodyFont: {
                            family: "'Inter', sans-serif",
                            size: 12
                        },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                const datasetIndex = context.datasetIndex;
                                const index = context.dataIndex;
                                const value = context.raw;
                                const label = context.dataset.label;
                                
                                // Get the actual count from the counts array
                                const counts = {!! json_encode($chartData['counts']) !!};
                                let countType = '';
                                
                                if (datasetIndex === 0) countType = 'positive';
                                else if (datasetIndex === 1) countType = 'neutral';
                                else if (datasetIndex === 2) countType = 'negative';
                                
                                const count = counts[countType][index];
                                
                                return `${label}: ${count} reviews (${value}%)`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(107, 114, 128, 0.1)'
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            },
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        // Sentiment Pie Chart
        const sentimentPieCtx = document.getElementById('sentimentPieChart').getContext('2d');
        const sentimentPieChart = new Chart(sentimentPieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Positive', 'Neutral', 'Negative'],
                datasets: [{
                    data: [{{ $positiveCount }}, {{ $neutralCount }}, {{ $negativeCount }}],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                family: "'Inter', sans-serif",
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: {
                            family: "'Inter', sans-serif",
                            size: 13
                        },
                        bodyFont: {
                            family: "'Inter', sans-serif",
                            size: 12
                        },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                cutout: '65%'
            }
        });

        // Rating Distribution Chart
        const ratingDistributionCtx = document.getElementById('ratingDistributionChart').getContext('2d');
        const ratingDistributionChart = new Chart(ratingDistributionCtx, {
            type: 'bar',
            data: {
                labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
                datasets: [{
                    label: 'Number of Reviews',
                    data: {!! json_encode($ratingDistribution) !!},
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(16, 185, 129, 0.7)'
                    ],
                    borderColor: [
                        'rgba(239, 68, 68, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(16, 185, 129, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: {
                            family: "'Inter', sans-serif",
                            size: 13
                        },
                        bodyFont: {
                            family: "'Inter', sans-serif",
                            size: 12
                        },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(107, 114, 128, 0.1)'
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        function openViewModal(id, appointmentId, patientName, rating, service, review, sentiment, probability, date) {
            // Set modal content
            document.getElementById('modal-patient-name').textContent = patientName;
            document.getElementById('modal-appointment-id').textContent = appointmentId;
            document.getElementById('modal-service').textContent = service;
            document.getElementById('modal-review').textContent = review;
            document.getElementById('modal-date').textContent = formatDate(date);
            document.getElementById('modal-date-full').textContent = formatDate(date, true);
            document.getElementById('modal-date-submitted').textContent = formatDate(date);
            
            // Set patient initials
            const initials = getInitials(patientName);
            document.getElementById('modal-initials').textContent = initials;
            
            // Set rating
            document.getElementById('modal-rating-text').textContent = rating + '/5';
            document.getElementById('modal-rating-bar').style.width = (rating / 5 * 100) + '%';
            
            // Generate star HTML directly
            const starsHTML = Array(5).fill(0).map((_, i) => {
                const starClass = i < rating ? 'text-yellow-400' : 'text-gray-300';
                return `<svg class="w-6 h-6 mr-1 ${starClass}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>`;
            }).join('');
            
            document.getElementById('modal-rating').innerHTML = starsHTML;
            
            // Set sentiment and probability - Fixed for decimal probability values
            const sentimentElement = document.getElementById('modal-sentiment');
            const sentimentIcon = document.getElementById('modal-sentiment-icon');
            const probabilityBar = document.getElementById('modal-probability-bar');
            const probabilityText = document.getElementById('modal-probability');
            
            // Convert probability to percentage if it's in decimal form (e.g., 0.95)
            let probabilityPercentage = probability;
            if (probability <= 1) {
                probabilityPercentage = probability * 100;
            }
            
            // Round to 1 decimal place for display
            const displayProbability = Math.round(probabilityPercentage * 10) / 10;
            
            sentimentElement.textContent = sentiment;
            probabilityText.textContent = displayProbability + '% confidence';
            probabilityBar.style.width = displayProbability + '%';
            
            // Set sentiment colors based on sentiment type
            if (sentiment.toLowerCase() === 'positive') {
                sentimentElement.classList.remove('text-yellow-800', 'text-red-800');
                sentimentElement.classList.add('text-green-800');
                
                sentimentIcon.classList.remove('bg-yellow-100', 'bg-red-100', 'text-yellow-600', 'text-red-600');
                sentimentIcon.classList.add('bg-green-100', 'text-green-600');
                
                probabilityBar.classList.remove('bg-yellow-500', 'bg-red-500');
                probabilityBar.classList.add('bg-green-600');
                
                probabilityText.classList.remove('bg-yellow-100', 'bg-red-100', 'text-yellow-800', 'text-red-800');
                probabilityText.classList.add('bg-green-100', 'text-green-800');
            } 
            else if (sentiment.toLowerCase() === 'neutral') {
                sentimentElement.classList.remove('text-green-800', 'text-red-800');
                sentimentElement.classList.add('text-yellow-800');
                
                sentimentIcon.classList.remove('bg-green-100', 'bg-red-100', 'text-green-600', 'text-red-600');
                sentimentIcon.classList.add('bg-yellow-100', 'text-yellow-600');
                
                probabilityBar.classList.remove('bg-green-600', 'bg-red-500');
                probabilityBar.classList.add('bg-yellow-500');
                
                probabilityText.classList.remove('bg-green-100', 'bg-red-100', 'text-green-800', 'text-red-800');
                probabilityText.classList.add('bg-yellow-100', 'text-yellow-800');
            } 
            else if (sentiment.toLowerCase() === 'negative') {
                sentimentElement.classList.remove('text-green-800', 'text-yellow-800');
                sentimentElement.classList.add('text-red-800');
                
                sentimentIcon.classList.remove('bg-green-100', 'bg-yellow-100', 'text-green-600', 'text-yellow-600');
                sentimentIcon.classList.add('bg-red-100', 'text-red-600');
                
                probabilityBar.classList.remove('bg-green-600', 'bg-yellow-500');
                probabilityBar.classList.add('bg-red-500');
                
                probabilityText.classList.remove('bg-green-100', 'bg-yellow-100', 'text-green-800', 'text-yellow-800');
                probabilityText.classList.add('bg-red-100', 'text-red-800');
            }
            
            // Show modal and prevent background scrolling
            document.getElementById('viewModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Helper function to format date
        function formatDate(dateString, includeTime = false) {
            const date = new Date(dateString);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            
            if (includeTime) {
                return date.toLocaleDateString('en-US', { ...options, hour: '2-digit', minute: '2-digit' });
            }
            
            return date.toLocaleDateString('en-US', options);
        }

        // Helper function to get initials from name
        function getInitials(name) {
            return name
                .split(' ')
                .map(part => part.charAt(0))
                .join('')
                .toUpperCase();
        }

        // Close modal when clicking outside
        document.getElementById('viewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeViewModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('viewModal').classList.contains('hidden')) {
                closeViewModal();
            }
        });
        </script>
</x-sidebar-layout>
    
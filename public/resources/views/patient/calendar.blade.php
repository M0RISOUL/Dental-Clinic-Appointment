@php
    use Carbon\Carbon;
@endphp

<x-patientnav-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Custom Calendar</title>
    </head>

    <body class="bg-gray-100 min-h-screen flex items-center justify-center">
        
        <div class=" mx-5 p-4 pr-0 pl-0">

            <div
                class="mb-4 flex flex-col sm:flex-row bg-teal-50 p-5 shadow-lg rounded-lg border-2 border-teal-400 justify-between my-12 items-center space-y-4 sm:space-y-0">
                <a href="{{ route('patient.dashboard') }}"
                    class="flex items-center sm:w-auto w-full bg-red-500 rounded-lg text-white p-2 text-lg shadow-lg font-semibold 
                        hover:bg-red-600 transition duration-200">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Go Back
                </a>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto">
                    <div class="flex flex-col">
                        <label for="monthSelect" class="text-teal-700 font-semibold mb-1">Month</label>
                        <select id="monthSelect"
                            class="border-2 border-teal-400 text-teal-700 font-bold p-2 rounded bg-white shadow w-full sm:w-auto">
                            <option value="0">January</option>
                            <option value="1">February</option>
                            <option value="2">March</option>
                            <option value="3">April</option>
                            <option value="4">May</option>
                            <option value="5">June</option>
                            <option value="6">July</option>
                            <option value="7">August</option>
                            <option value="8">September</option>
                            <option value="9">October</option>
                            <option value="10">November</option>
                            <option value="11">December</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="yearSelect" class="text-teal-700 font-semibold mb-1">Year</label>
                        <select id="yearSelect"
                            class="border-2 border-teal-400 text-teal-700 font-bold p-2 rounded bg-white shadow w-full sm:w-auto">
                        </select>
                    </div>
                </div>

            </div>

            @if ($errors->any())
                <div class=" bg-red-500  text-white text-md p-6 w-full rounded-lg my-5">
                    @foreach ($errors->all() as $error)
                        <p><i class="fas fa-exclamation-circle text-white"></i> {{ $error }}</p>
                    @endforeach
                </div>
            @endif
            

            <div
                class="relative flex bg-white flex-col w-full h-full text-gray-700 shadow-md rounded-xl bg-clip-border">
                <div
                    class="flex-1 bg-teal-50 shadow-lg rounded-lg border-l-4 border-t-2  border-r-2 border-b-2 border-teal-400 p-6  mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="space-y-3 text-gray-600">
                            <h3 class="text-lg font-semibold text-teal-700 mb-2">
                                Important Disclaimer
                            </h3>
                            <p class="text-base">
                                Please note the following appointment booking guidelines:
                            </p>
                            <ul class="list-disc ml-5 space-y-2">
                                <li>Users can only have one active approved appointment at a time.</li>
                                <li>If an approved appointment is not attended, it will be marked as unattended.
                                </li>
                                <li>Users can reschedule an appointment if it is marked as unattended.</li>
                                <li>Approved appointments can be canceled, and users may reschedule afterward.</li>
                            </ul>
                            <div class="mt-4 flex items-center">
                                <p class="text-sm bg-teal-100 rounded-lg p-2">
                                    <span class="font-semibold">💡 Note:</span>
                                    Ensure you attend or manage your appointments promptly to avoid scheduling
                                    conflicts.
                                </p>
                            </div>
                        </div>


                        <div class="bg-teal-100 border-teal-500 border-b-4 border-l-2 border-r-2 rounded-lg shadow-lg">
                            <div
                                class="p-2 flex items-center bg-teal-500 text-lg text-teal-50 font-semibold rounded-t-lg">
                                <i class="fa-solid fa-thumbtack text-teal-50"></i>
                                <h2 class="text-xl mx-2">Legend</h2>
                            </div>

                            <div class="p-2 space-y-5">
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-blue-300 border-2 border-blue-500 rounded"></div>
                                    <span class="text-sm text-gray-700"><span
                                            class="font-bold text-blue-500">Attended</span> - The participant has
                                        successfully attended
                                        the event.</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-gray-300 border-2 border-gray-500 rounded"></div>
                                    <span class="text-sm text-gray-700"><span
                                            class="font-bold text-gray-500">Unattended</span> - The participant was
                                        expected
                                        but did
                                        not attend.</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-orange-300 border-2 border-orange-500 rounded"></div>
                                    <span class="text-sm text-gray-700"><span
                                            class="font-bold text-orange-500">Pending</span> - Attendance status is
                                        not
                                        yet
                                        confirmed.</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-red-300 border-2 border-red-500  rounded"></div>
                                    <span class="text-sm text-gray-700"><span
                                            class="font-bold text-red-500">Cancelled</span>- The event or attendance
                                        was
                                        canceled.</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-teal-300 border-2 border-teal-500  rounded"></div>
                                    <span class="text-sm text-gray-700"><span
                                            class="font-bold text-teal-500">Approved</span> - Attendance has been
                                        approved or
                                        confirmed.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @php
                    $activeAnnouncement = App\Models\ClinicAnnouncement::where('is_active', true)->latest()->first();
                @endphp
                
                @if($activeAnnouncement)
                <div id="clinicAnnouncementSection" class="mb-6">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-teal-200 relative">
                        <div class="absolute top-3 left-3 opacity-10">
                            <svg class="h-12 w-12 text-teal-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C7.5 2 4 5.5 4 9c0 2.3 1.1 4.1 2 5.4.3.4.6.8.8 1.2.2.4.3.9.3 1.4v3c0 .6.4 1 1 1h1c.6 0 1-.4 1-1v-1h4v1c0 .6.4 1 1 1h1c.6 0 1-.4 1-1v-3c0-.5.1-1 .3-1.4.2-.4.5-.8.8-1.2.9-1.3 2-3.1 2-5.4 0-3.5-3.5-7-8-7zm-3 15v-1h6v1H9zm6-2H9c0-1.2-.4-2.2-.8-3-.3-.5-.6-.9-.9-1.4-.7-1-1.3-2.2-1.3-3.6 0-2.5 2.7-5 6-5s6 2.5 6 5c0 1.4-.6 2.6-1.3 3.6-.3.5-.6.9-.9 1.4-.4.8-.8 1.8-.8 3z"/>
                            </svg>
                        </div>
                        <div class="absolute bottom-3 right-3 opacity-10">
                            <svg class="h-12 w-12 text-teal-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C7.5 2 4 5.5 4 9c0 2.3 1.1 4.1 2 5.4.3.4.6.8.8 1.2.2.4.3.9.3 1.4v3c0 .6.4 1 1 1h1c.6 0 1-.4 1-1v-1h4v1c0 .6.4 1 1 1h1c.6 0 1-.4 1-1v-3c0-.5.1-1 .3-1.4.2-.4.5-.8.8-1.2.9-1.3 2-3.1 2-5.4 0-3.5-3.5-7-8-7zm-3 15v-1h6v1H9zm6-2H9c0-1.2-.4-2.2-.8-3-.3-.5-.6-.9-.9-1.4-.7-1-1.3-2.2-1.3-3.6 0-2.5 2.7-5 6-5s6 2.5 6 5c0 1.4-.6 2.6-1.3 3.6-.3.5-.6.9-.9 1.4-.4.8-.8 1.8-.8 3z"/>
                            </svg>
                        </div>
                        
                        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white p-4 flex items-center">
                            <div class="flex-shrink-0 bg-white rounded-full p-2 mr-3">
                                <svg class="h-6 w-6 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold">Dental Clinic Announcement</h3>
                            
                            <div class="ml-auto flex items-center">
                                <span class="relative flex h-3 w-3 mr-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                </span>
                                <span class="text-sm font-medium">New</span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-5">
                            <h4 class="text-xl font-bold text-teal-700 mb-3 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-teal-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                {{ $activeAnnouncement->title }}
                            </h4>
                            
                            <div class="mt-3 text-gray-700 leading-relaxed bg-teal-50 p-4 rounded-lg border border-teal-100">
                                {{ $activeAnnouncement->message }}
                            </div>
                            
                            @if($activeAnnouncement->closure_start_date && $activeAnnouncement->closure_end_date)
                            <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-3">
                                <p class="text-red-700 font-semibold flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    Clinic Closure Period:
                                </p>
                                <p class="ml-7 text-red-600">
                                    {{ \Carbon\Carbon::parse($activeAnnouncement->closure_start_date)->format('F j, Y') }} to 
                                    {{ \Carbon\Carbon::parse($activeAnnouncement->closure_end_date)->format('F j, Y') }}
                                </p>
                            </div>
                            @endif
                            
                            <div class="mt-4 flex justify-end items-center">
                                <span class="text-sm text-teal-600">
                                    <svg class="inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($activeAnnouncement->created_at)->format('F j, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="justify-center ">
                    <div class="border-2 border-teal-500 p-2 rounded-lg relative animate-border" id="divborder">
                        <div class="bg-teal-500 w-full text-center text-3xl text-white p-4 font-bold rounded-t-lg">
                            APPOINTMENT CALENDAR
                        </div>
                        <div class="bg-teal-200 p-4 content-center rounded-b-lg shadow-lg flex flex-wrap gap-1 sm:grid sm:grid-cols-7"
                            id="calendar">
                            <div
                                class="text-center font-bold text-base text-gray-700 uppercase tracking-wide bg-gray-200 p-2 rounded">
                                Sun</div>
                            <div
                                class="text-center font-bold text-base text-gray-700 uppercase tracking-wide bg-gray-200 p-2 rounded">
                                Mon</div>
                            <div
                                class="text-center font-bold text-base text-gray-700 uppercase tracking-wide bg-gray-200 p-2 rounded">
                                Tue</div>
                            <div
                                class="text-center font-bold text-base text-gray-700 uppercase tracking-wide bg-gray-200 p-2 rounded">
                                Wed</div>
                            <div
                                class="text-center font-bold text-base text-gray-700 uppercase tracking-wide bg-gray-200 p-2 rounded">
                                Thu</div>
                            <div
                                class="text-center font-bold text-base text-gray-700 uppercase tracking-wide bg-gray-200 p-2 rounded">
                                Fri</div>
                            <div
                                class="text-center font-bold text-base text-gray-700 uppercase tracking-wide bg-gray-200 p-2 rounded">
                                Sat</div>
                        </div>
                    </div>
                </div>
            </div>


            <div
                class="relative flex my-10 flex-col w-full h-full  text-gray-700 bg-teal-50 border-2 border-teal-500 shadow-md rounded-xl bg-clip-border">
                <div
                    class="relative mx-4 mt-4 overflow-hidden shadow-lg text-gray-700 p-4 bg-teal-100 rounded-lg border-2 border-teal-500 bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class="block text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Appointments List
                            </h5>
                            <p class="block mt-1 text-base antialiased font-normal leading-relaxed text-gray-700">
                                See information about all appointments
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                        <div class="block w-full overflow-hidden md:w-max">
                            <nav class="flex items-center gap-3">
                                    @php
                                        $today = \Carbon\Carbon::today();
                                        $minDate = $today->copy()->subYears(5)->format('Y-m-d');
                                        $maxDate = $today->format('Y-m-d');
                                    @endphp
                                   <input type="date" id="dateFilter" onchange="filterDate()" value="{{ request('date') }}"
                                    min="{{ $minDate }}" max="{{ $maxDate }}"
                                    class="h-full rounded-[7px]  border-teal-600 border-4 bg-teal-50 px-3 py-2.5 text-sm font-normal text-blue-gray-700 outline-none transition-all focus:border-2 focus:border-teal-600">

                                <div class="flex">
                                    <button onclick="resetFilter()"
                                        class="px-4 py-3 text-white bg-teal-600 rounded-lg shadow-md transition-all hover:bg-teal-700">
                                        Reset
                                    </button>
                                </div>
                            </nav>
                        </div>


                        <div class="w-full md:w-72">
                            <div class="relative h-10 w-full min-w-[200px]">
                                <div
                                    class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                        </path>
                                    </svg>
                                </div>

                                <input oninput="filterAppointments()" id="searchInput"
                                    class="peer h-full w-full rounded-[7px]  border-teal-600 border-4 bg-teal-50 px-3 py-2.5 !pr-9 text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-teal-600 focus:border-2 focus:border-teal-600 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                    placeholder=" " />


                                <label
                                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-teal-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-teal-600 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-teal-600 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Search
                                </label>

                                <script></script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 px-0  overflow-x-auto">

                    <table class="w-full mt-4  text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th
                                    class="p-4 border-r-0 border-l-0 bg-teal-100 border-2 border-teal-600 bg-blue-gray-50/50">
                                    <p class="flex text-lg justify-center font-semibold text-teal-600 leading-none ">
                                        Date
                                    </p>
                                </th>
                                <th
                                    class="p-4 border-r-0 border-l-0 bg-teal-100 border-2 border-teal-600 bg-blue-gray-50/50">
                                    <p class="block text-lg  font-semibold text-teal-600 leading-none ">
                                        Time Slot
                                    </p>
                                </th>
                                <th
                                    class="p-4 border-r-0 border-l-0 bg-teal-100 border-2 border-teal-600 bg-blue-gray-50/50">
                                    <p class="block text-lg  font-semibold text-teal-600 leading-none ">
                                        Max Slot
                                    </p>
                                </th>
                                <th
                                    class="p-4 border-r-0 border-l-0 bg-teal-100 border-2 border-teal-600 bg-blue-gray-50/50">
                                </th>
                            </tr>
                        </thead>
                        <tbody id="appointmentsTableBody">

                            @if ($allData->isEmpty())
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-gray-700 flex-col">
                                        <i class="fa-solid fa-calendar-xmark fa-2x text-teal-600 mb-2"></i>
                                        <p> No available slots at the moment.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($allData as $slots)
                                    @php
                                        $appointmentExists = App\Models\Appointment::where('date', $slots->date)
                                            ->where('time', $slots->time_slot)
                                            ->whereIn('status', ['Pending', 'Approved', 'Attended', 'Unattended'])
                                            ->exists();

                                        $remainingSlots =
                                            $slots->remaining_slots ??
                                            $slots->max_slots -
                                                App\Models\Appointment::where('date', $slots->date)
                                                    ->where('time', $slots->time_slot)
                                                    ->whereIn('status', ['Pending', 'Approved', 'Attended'])
                                                    ->count();
                                        

                                    @endphp
                                    <tr data-date="{{ Carbon::parse($slots->date)->format('F j, Y') }}">
                                        <td class="p-4 border-b border-teal-100">
                                            <div class="flex items-center justify-center gap-3">
                                                <img src="{{ Auth::user()->image_path ? asset('storage/' . Auth::user()->image_path) : asset('images/logo.png') }}"
                                                    alt="Avatar"
                                                    class="relative shadow-lg inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                                <div class="flex flex-col">
                                                    <p
                                                        class="block text-md antialiased font-normal leading-normal text-blue-gray-900">
                                                        {{ Carbon::parse($slots->date)->format('F j, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-teal-100">
                                            <div class="flex flex-col">
                                                <p
                                                    class="block text-md antialiased font-normal leading-normal text-blue-gray-900">
                                                    {{ $slots->time_slot }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-teal-100">
                                            <div class="w-max">
                                                <div
                                                    class="relative grid items-center px-2 py-1 text-md font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                                    <span>{{ $remainingSlots }} Slots Remaining</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b w-full flex justify-center border-teal-100">
                                            @if (!$appointmentExists)
                                                <a href="{{ route('patient.bookappointment', ['id' => $slots->id]) }}"
                                                    class="relative flex p-2 bg-teal-500 flex-row space-x-2 items-center justify-center h-12 w-44 select-none rounded-lg text-center align-middle text-xs font-medium uppercase hover:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                    <i class="fa-solid fa-pen fa-lg text-white"></i>
                                                    <span class="mt-1 text-lg font-semibold text-white">CREATE</span>
                                                </a>
                                            @else
                                                <a href="{{ route('history') }}"
                                                    class="flex flex-col items-center text-center px-5 py-2 text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition">
                                                    <span class="text-lg font-semibold">Appointment Already Set</span>
                                                    <div class="flex flex-row items-center justify-center mt-1">
                                                        <p class="text-sm text-gray-200 mx-2">Click to view</p>
                                                        <i class="fa-solid fa-arrow-right mt-0.5"></i>
                                                    </div>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>

                    </table>
                </div>

            </div>
        </div>


    </body>

    </html>

    <script>
        function resetFilter() {
            document.getElementById("dateFilter").value = "";
            filterDate();
        }

        function filterAppointments() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let tableBody = document.getElementById("appointmentsTableBody");
            let rows = tableBody.getElementsByTagName("tr");
            for (let row of rows) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            }
        }

         function filterDate() { //Added
            let dateValue = document.getElementById("dateFilter").value;
            console.log("Selected Date:", dateValue);
            let tableBody = document.getElementById("appointmentsTableBody");
            let rows = tableBody.getElementsByTagName("tr");

            for (let row of rows) {
                let rowDateText = row.getAttribute("data-date");
                let rowDate = convertDate(rowDateText);
                console.log(`Row Date (Converted): ${rowDate} | Original: ${rowDateText}`);

                if (!dateValue || rowDate === dateValue) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                    tableBody.innerHTML =
                        ` <tr>
                        <td colspan="100%" class="text-center py-4">
                            <div class="inline-block bg-red-200 border-2 border-red-500 text-red-500 font-semibold px-3 py-3 rounded-lg shadow">
                                <i class="fa-solid fa-face-sad-cry text-red-500"></i>
                                 No appointments available, Kindly Choose Another Date.
                            </div>
                        </td>
                    </tr>`;
                }
            }
        }

        function convertDate(dateString) {
            let dateObj = new Date(dateString);
            if (isNaN(dateObj)) {
                console.log(`⚠️ Invalid date format: ${dateString}`);
                return "";
            }

            let year = dateObj.getFullYear();
            let month = (dateObj.getMonth() + 1).toString().padStart(2, "0");
            let day = dateObj.getDate().toString().padStart(2, "0");

            return `${year}-${month}-${day}`;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".checkbox-item");
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener("change", function() {
                    let checkedBoxes = document.querySelectorAll(".checkbox-item:checked");

                    if (checkedBoxes.length > 3) {
                        this.checked = false;
                        alert("You can only select up to 3 checkboxes.");
                    }
                });
            });
        });

        function selectAppointmentTime(button) {
            const selectedTime = button.getAttribute('data-time');
            document.getElementById('time').value = selectedTime;

            document.querySelectorAll('.appointment-button').forEach(btn => {
                btn.classList.remove('bg-teal-600', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-900');
            });

            button.classList.remove('bg-gray-100', 'text-gray-900');
            button.classList.add('bg-teal-600', 'text-white');
        }

    //   function fetchAppointments(selectedDate) {
    //         $.ajax({
    //             url: `/appointments/${selectedDate}`,
    //             type: 'GET',
    //             dataType: 'json',
    //             success: function (data) {
    //                 console.log("Fetched Appointments Data:", data); // Debugging output
    //                 updateAppointmentsTable(data);
    //             },
    //             error: function (error) {
    //                 console.error("Error fetching appointments:", error);
    //                 document.getElementById("appointmentsTableBody").innerHTML =
    //                     ` <tr>
    //                     <td colspan="100%" class="text-center py-4">
    //                         <div class="inline-block bg-red-200 border-2 border-red-500 text-red-500 font-semibold px-3 py-3 rounded-lg shadow">
    //                             <i class="fa-solid fa-face-sad-cry text-red-500"></i>
    //                              Failed to load appointments, Kindly Choose Another Date.
    //                         </div>
    //                     </td>
    //                 </tr>`;
    //             }
    //         });
    //     }

        function updateAppointmentsTable(appointments) {
            const tableBody = document.getElementById("appointmentsTableBody");
            tableBody.innerHTML = ""; // Clear existing rows

            // If no appointments are available, show a message
              if (!appointments || appointments.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="100%" class="text-center py-4">
                            <div class="inline-block bg-red-200 border-2 border-red-500 text-red-500 font-semibold px-3 py-3 rounded-lg shadow">
                                <i class="fa-solid fa-face-sad-cry text-red-500"></i>
                                 No appointments available, Kindly Choose Another Date.
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }


            console.log(appointments); // Debugging: Log the appointments array
            appointments.forEach(slot => {
                const appointmentExists = slot.appointment_exists; // Check if an appointment exists
                const remainingSlots = slot.remaining_slots; // Check remaining slots

                const row = document.createElement("tr");

                row.innerHTML = `
                    <td class="p-4 border-b border-teal-100">
                        <div class="flex items-center justify-center gap-3">
                            <img src="/images/logo.png" alt="Logo"
                                class="relative shadow-lg inline-block h-9 w-9 rounded-full object-cover object-center" />
                            <div class="flex flex-col">
                                <p class="block text-md antialiased font-normal leading-normal text-blue-gray-900">
                                    ${new Date(slot.date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 border-b border-teal-100">
                        <div class="flex flex-col">
                            <p class="block text-md antialiased font-normal leading-normal text-blue-gray-900">
                                ${slot.time_slot}
                            </p>
                        </div>
                    </td>
                    <td class="p-4 border-b border-teal-100">
                        <div class="w-max">
                            <div class="relative grid items-center px-2 py-1 text-md font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                <span>${slot.remaining_slots} Slots Remaining</span>
                            </div>
                        </div>
                   <td class="p-4 border-b w-full flex justify-center border-teal-100">
                ${!appointmentExists && remainingSlots > 0 ?
                    `<a href="/patient/bookappointment/${slot.id}" 
                        class="relative flex p-2 bg-teal-500 flex-row space-x-2 items-center justify-center h-12 w-44 select-none rounded-lg text-center align-middle text-xs font-medium uppercase hover:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        <i class="fa-solid fa-pen fa-lg text-white"></i>
                        <span class="mt-1 text-lg font-semibold text-white">CREATE</span>
                    </a>`
                    :
                    appointmentExists ?
                    `<a href="/patient/history">
                        <span class="px-5 py-2 text-white bg-teal-600 rounded-lg flex flex-col items-center text-center hover:bg-teal-700 transition">
                            <span class="text-lg font-semibold">Appointment Already Set</span>
                            <div class="flex flex-row items-center justify-center mt-1">
                                <p class="text-sm text-gray-200 mx-2">Click to view</p>
                                <i class="fa-solid fa-arrow-right mt-0.5"></i>
                            </div>
                        </span>
                    </a>`
                    :
                    `<div class="flex items-center justify-center bg-red-400 border border-red-400 text-white px-4 py-3 rounded-lg shadow-md" role="alert">
                        <i class="fa-solid fa-circle-exclamation text-white text-xl mr-3"></i>
                        <span class="font-semibold text-lg">No available slots</span>
                    </div>
                    `
                }
            </td>
                `;

                console.log(appointmentExists); // Debugging: Log if an appointment exists
                tableBody.appendChild(row);
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const appointments = @json($appointments);
            var remainingSlotsByDate = @json($remainingSlotsByDate);
            const calendar = document.querySelector('#calendar');
            const monthSelect = document.getElementById('monthSelect');
            const yearSelect = document.getElementById('yearSelect');
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth();
            const currentYear = currentDate.getFullYear();
        
            for (let year = currentYear - 5; year <= currentYear; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.innerText = year;
                if (year === currentYear) {
                    option.selected = true;
                }
                yearSelect.appendChild(option);
            }
        
            monthSelect.value = currentMonth;
            
        
            async function fetchHolidays(year) {
                try {
                    const url = `https://date.nager.at/api/v3/PublicHolidays/${year}/PH`; 

                    const response = await fetch(url, {
                        method: "GET",
                        headers: {
                            "Accept": "application/json"

                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status} - ${response.statusText}`);
                    }

                    const data = await response.json();

                    return data;
                } catch (error) {
                    console.error("Failed to fetch holidays:", error);
                    return [];
                }
            }
        
            async function renderCalendar(month, year) {
                const holidays = await fetchHolidays(year);
                const holidayDates = holidays.map(h => h.date); // Extract holiday dates

                const firstDayOfMonth = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const today = new Date();
                const isSmallScreen = window.matchMedia("(max-width: 640px)").matches;
                calendar.innerHTML = "";
                
                if (isSmallScreen) {
                    const listContainer = document.createElement("ul"); // List for better structure
                    listContainer.className = "space-y-2 w-full";
        
                    for (let day = 1; day <= daysInMonth; day++) {
                        const currentDate = new Date(Date.UTC(year, month, day));
                        const dateString = currentDate.toISOString().split("T")[0];
        
                        const dayOfWeek = currentDate.getDay();
                        const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                        const dayName = daysOfWeek[dayOfWeek];
        
                        // Check if the date is within a clinic closure period
                        let isClinicClosed = false;
                        let closureReason = "";
                        
                        @if($activeAnnouncement && $activeAnnouncement->closure_start_date && $activeAnnouncement->closure_end_date)
                            const closureStartDate = new Date('{{ $activeAnnouncement->closure_start_date }}');
                            
                            // Create end date and add one day
                            const closureEndDate = new Date('{{ $activeAnnouncement->closure_end_date }}');
                            closureEndDate.setDate(closureEndDate.getDate() + 1);
                            
                            // Now when checking if a date is within range
                            // This will include the entire last day
                            if (currentDate >= closureStartDate && currentDate < closureEndDate) {
                                isClinicClosed = true;
                                closureReason = "{{ $activeAnnouncement->title }}";
                                
                                // Override the default styles for closed days
                                bgColor = "bg-red-100";
                                borderColor = "border-red-500";
                                textColor = "text-red-700";
                                tooltipText = `Clinic Closed: ${closureReason}`;
                                isClickable = false;
                                cursorStyle = "cursor-not-allowed";
                                pointerEvents = "pointer-events-none";
                            }
                        @endif
        
                        const listItem = document.createElement("li");
                        
                        if (isClinicClosed) {
                            listItem.className = "flex justify-between items-center bg-red-100 shadow-md border-l-4 border-red-500 rounded-lg p-3 cursor-not-allowed relative";
                        } else {
                            listItem.className = "flex justify-between items-center bg-white shadow-md border-l-4 border-teal-500 rounded-lg p-3 cursor-pointer hover:bg-teal-100 transition-all";
                        }
        
                        const dayNumber = document.createElement("span");
                        dayNumber.className = isClinicClosed ? "text-lg font-bold text-red-700" : "text-lg font-bold text-teal-700";
                        dayNumber.innerText = day;
        
                        // Formatted date + day name
                        const formattedDate = currentDate.toLocaleDateString("en-US", {
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                        });
        
                        const dateText = document.createElement("span");
                        dateText.className = isClinicClosed ? "text-sm text-red-600" : "text-sm text-gray-600";
                        dateText.innerText = `${dayName}, ${formattedDate}`;
        
                        listItem.appendChild(dayNumber);
                        listItem.appendChild(dateText);
        
                        if (isClinicClosed) {
                            const closedOverlay = document.createElement('div');
                            closedOverlay.className = 'absolute right-2 top-1/2 transform -translate-y-1/2';
                            closedOverlay.innerHTML = `
                                <div class="bg-red-500 text-white font-bold py-1 px-3 rounded-lg transform -rotate-12 text-sm">
                                    CLOSED
                                </div>
                            `;
                            listItem.appendChild(closedOverlay);
                            listItem.title = `Clinic Closed: ${closureReason}`;
                        } else {
                            listItem.addEventListener("click", () => {
                                fetchAppointments(dateString);
                            });
                        }
        
                        listContainer.appendChild(listItem);
                    }
        
                    calendar.appendChild(listContainer);
                } else { // FOR DESKTOP VIEW
                    calendar.innerHTML = `
                        <div class="hidden sm:block mb-4 text-center font-bold text-lg text-white uppercase tracking-wide bg-teal-500 p-2 rounded-md">Sun</div>
                        <div class="hidden sm:block mb-4 text-center font-bold text-lg text-white uppercase tracking-wide bg-teal-500 p-2 rounded-md">Mon</div>
                        <div class="hidden sm:block mb-4 text-center font-bold text-lg text-white uppercase tracking-wide bg-teal-500 p-2 rounded-md">Tue</div>
                        <div class="hidden sm:block mb-4 text-center font-bold text-lg text-white uppercase tracking-wide bg-teal-500 p-2 rounded-md">Wed</div>
                        <div class="hidden sm:block mb-4 text-center font-bold text-lg text-white uppercase tracking-wide bg-teal-500 p-2 rounded-md">Thu</div>
                        <div class="hidden sm:block mb-4 text-center font-bold text-lg text-white uppercase tracking-wide bg-teal-500 p-2 rounded-md">Fri</div>
                        <div class="hidden sm:block mb-4 text-center font-bold text-lg text-white uppercase tracking-wide bg-teal-500 p-2 rounded-md">Sat</div>
                    `;
        
                    const scrollWrapper = document.createElement("div");
                    scrollWrapper.className = "sm:grid sm:grid-cols-7 gap-2 overflow-x-auto flex flex-row sm:flex-wrap w-full";
        
                    const daysInPrevMonth = new Date(year, month, 0).getDate();
        
                    for (let i = 0; i < firstDayOfMonth; i++) {
                        const prevDate = daysInPrevMonth - (firstDayOfMonth - 1) + i; // Calculate previous month's last dates
                        const emptySlot = document.createElement('div');
                        emptySlot.className = "hidden sm:flex flex-col items-center justify-center bg-teal-700 opacity-60 shadow-lg border-l-4 border-teal-500 rounded-lg text-2xl font-semibold text-white transition-all duration-300 hover:bg-teal-300 hover:text-gray-700 cursor-pointer shadow-md w-full h-16 sm:h-20 md:h-18 lg:h-28 xl:h-24 2xl:h-28"; // Style previous dates
                        emptySlot.innerText = prevDate;
                        calendar.appendChild(emptySlot);
                    }
        
                    for (let day = 1; day <= daysInMonth; day++) {
                        const daySlot = document.createElement('div');
                        const currentDate = new Date(Date.UTC(year, month, day));
                        const dateString = currentDate.toISOString().split("T")[0];
                        const isHoliday = holidayDates.includes(dateString);
                        const isSunday = currentDate.getDay() === 0; // Check if it's Sunday
                        let holidayName = "";
        
                        const totalSlots = remainingSlotsByDate[dateString] || 0;
                        const appointment = appointments.find(app => app.date === dateString);
        
                        var bgColor = "bg-white";
                        var borderColor = "border-teal-500";
                        var textColor = "text-teal-700";
                        var tooltipText = "No appointment";
                        var isClickable = true;
                        var cursorStyle = "cursor-pointer";
                        var pointerEvents = "pointer-events-auto";
        
                        // Check if the date is within a clinic closure period
                        let isClinicClosed = false;
                        let closureReason = "";
                        
                       
                        @if($activeAnnouncement && $activeAnnouncement->closure_start_date && $activeAnnouncement->closure_end_date)
                            const closureStartDate = new Date('{{ $activeAnnouncement->closure_start_date }}');
                            const closureEndDate = new Date('{{ $activeAnnouncement->closure_end_date }}');
                            
                            if (currentDate >= closureStartDate && currentDate <= closureEndDate) {
                                isClinicClosed = true;
                                closureReason = "{{ $activeAnnouncement->title }}";
                                
                                // Override the default styles for closed days
                                bgColor = "bg-red-100";
                                borderColor = "border-red-500";
                                textColor = "text-red-700";
                                tooltipText = `Clinic Closed: ${closureReason}`;
                                isClickable = false;
                                cursorStyle = "cursor-not-allowed";
                                pointerEvents = "pointer-events-none";
                            }
                        @endif
                        
                
                        
                         if (isSunday) {
                            bgColor = "bg-red-100";
                            borderColor = "border-red-600 border-2";
                            textColor = "text-red-600";
                            tooltipText = "Sunday - No appointment";
                            isClickable = false;
                            const sundayLabel = document.createElement('span');
                            sundayLabel.className = "text-xs text-red-500 text-center mt-1 px-2";
                            sundayLabel.innerText = `🍂 Sunday`;
                            daySlot.appendChild(sundayLabel);
                        }
                        if (isHoliday) {
                            bgColor = "bg-red-100";
                            borderColor = "border-red-600 border-2";
                            textColor = "text-red-600";
                            tooltipText = `Holiday - ${holidayName}`;
                            isClickable = false;
                            holidayName = holidays.find(h => h.date === dateString).name;
                            const holidayLabel = document.createElement('span');
                            holidayLabel.className = "bg-red-500 text-white text-xs rounded-lg text-center py-1 px-2";
                            holidayLabel.innerText = `📅 ${holidayName}`;
                            daySlot.appendChild(holidayLabel);
                        }
        
                        if (appointment) {
                            switch (appointment.status) {
                                case "Attended":
                                    bgColor = "bg-blue-300";
                                    borderColor = "border-blue-700 border-2";
                                    textColor = "text-blue-700";
                                    tooltipText = "Attended";
                                    break;
                                case "Unattended":
                                    bgColor = "bg-gray-300";
                                    borderColor = "border-gray-700 border-2";
                                    textColor = "text-gray-600";
                                    tooltipText = "Unattended";
                                    break;
                                case "Pending":
                                    bgColor = "bg-orange-300 hover:bg-orange-400";
                                    borderColor = "border-orange-700 border-2";
                                    textColor = "text-orange-600 font-semibold";
                                    tooltipText = "Pending - Click to take action";
                                    break;
                                case "Cancelled":
                                    bgColor = "bg-red-300";
                                    borderColor = "border-red-600 border-2";
                                    textColor = "text-red-600";
                                    tooltipText = "Cancelled";
                                    break;
                                case "Approved":
                                    bgColor = "bg-teal-200 hover:bg-teal-300";
                                    borderColor = "border-teal-600 border-2";
                                    textColor = "text-teal-600 font-semibold";
                                    tooltipText = "Approved - Click to view details";
                                    break;
                                default:
                                    bgColor = "bg-gray-200";
                                    borderColor = "border-teal-600";
                                    textColor = "text-teal-700";
                                    tooltipText = "No appointment";
                                    break;
                            }
                           
                        }
        
                        daySlot.className = `hidden sm:flex flex-col items-center justify-center shadow-lg border-l-4 rounded-lg text-xl font-semibold transition-all duration-300 hover:bg-teal-100 hover:text-gray-700 ${cursorStyle} shadow-md w-full h-16 sm:h-20 md:h-18 lg:h-28 xl:h-24 2xl:h-28 ${bgColor} ${borderColor} ${textColor} ${pointerEvents}`;
                        daySlot.setAttribute("data-date", dateString);
                        daySlot.title = tooltipText;
        
                        // DAY NUMBER ELEMENTS
                        const dayNumber = document.createElement('span');
                        dayNumber.className = "text-center xl:text-3xl lg:text-2xl font-bold";
                        dayNumber.innerText = day;
                        
                    
        
                        if (isClickable) {
                            daySlot.addEventListener("click", function() {
                                const tableBody = document.getElementById("appointmentsTableBody");
                                if (tableBody) {
                                    tableBody.innerHTML = "";
                                }
                                console.log(dateString);
                                fetchAppointments(dateString);
                            });
                        }
        
                        const slotsContainer = document.createElement('div');
                        slotsContainer.className = "text-sm text-black font-light flex flex-col items-center";
        
                        if (isClinicClosed) {
                            const closedOverlay = document.createElement('div');
                            closedOverlay.className = 'closed-overlay';
                            
                            const closedBanner = document.createElement('div');
                            closedBanner.className = 'closed-banner';
                            closedBanner.textContent = 'CLOSED';
                            
                            closedOverlay.appendChild(closedBanner);
                            daySlot.appendChild(closedOverlay);
                            
                            // Add a note about the closure
                            const closureNote = document.createElement('div');
                            closureNote.className = "text-xs text-red-600 font-semibold mt-1";
                            closureNote.textContent = "Clinic Closed";
                            slotsContainer.appendChild(closureNote);
                        } else if (totalSlots > 0) {
                            const slotsDropdownContainer = document.createElement('div');
                            slotsDropdownContainer.className = "relative inline-block";
        
                            const toggleButton = document.createElement('button');
                            toggleButton.type = "button";
                            toggleButton.className = "bg-teal-600 text-white shadow-lg mt-2 font-semibold px-4 py-2 rounded-lg focus:outline-none";
        
                            toggleButton.innerHTML = `
                                <span class="hidden lg:inline m-2">Slots Availability</span>
                                <i class='fas fa-chevron-down ml-2'></i>
                            `;
        
                            const slotsInfoContainer = document.createElement('div');
                            slotsInfoContainer.className = "absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-lg p-4 hidden";
        
                            const icon = document.createElement('i');
                            icon.className = "fas fa-circle-check text-lg text-teal-600 mr-2";
        
                            // Create text span
                            const totalSlotsInfo = document.createElement('span');
                            totalSlotsInfo.className = "font-semibold text-lg text-teal-800";
                            totalSlotsInfo.innerText = `Available: ${totalSlots}`;
        
                            slotsInfoContainer.appendChild(icon);
                            slotsInfoContainer.appendChild(totalSlotsInfo);
        
                            slotsDropdownContainer.appendChild(toggleButton);
                            slotsDropdownContainer.appendChild(slotsInfoContainer);
        
                            slotsContainer.appendChild(slotsDropdownContainer);
        
                            toggleButton.addEventListener('click', (event) => {
                                event.stopPropagation();
                                event.preventDefault();
                                const isHidden = slotsInfoContainer.classList.contains('hidden');
                                slotsInfoContainer.classList.toggle('hidden', !isHidden);
                                toggleButton.innerHTML = isHidden ?
                                    `<span class="hidden lg:inline">Hide Slot</span> <i class='fas fa-chevron-up ml-2'></i>` :
                                    `<span class="hidden lg:inline">Slots Availability</span> <i class='fas fa-chevron-down ml-2'></i>`;
                            });
                        } else {
                            const noSlotText = document.createElement('span');
                            noSlotText.className = "font-semibold text-red-700"
                            const icon = document.createElement('i');
                            icon.className = "fas fa-exclamation-circle text-red-400 mx-2";
                            noSlotText.innerHTML = `<span class="hidden lg:inline">No Slots Available</span>`;
                            noSlotText.prepend(icon);
                            slotsContainer.appendChild(noSlotText);
                            bgColor = "bg-gray-100";
                            borderColor = "border-teal-600";
                            textColor = "text-teal-700";
                            tooltipText = "No appointment";
                        }
                        
                       
        
                        if (currentDate < today.setHours(0, 0, 0, 0)) {
                            daySlot.classList.remove("border-teal-500", "text-teal-700");
                            daySlot.classList = "hidden sm:flex flex-col items-center justify-center shadow-lg border-l-4 rounded-lg text-xl font-semibold transition-all duration-300 hover:bg-teal-100 hover:text-gray-700 cursor-pointer shadow-md w-full h-16 sm:h-20 md:h-18 lg:h-28 xl:h-24 2xl:h-28 ${bgColor} ${borderColor} ${textColor}";
                            daySlot.classList.add("border-red-500", "bg-gray-300", "text-red-500", "relative", "cursor-not-allowed", "border-l-4");
                            daySlot.style.position = "relative";
                        }
        
                        daySlot.appendChild(dayNumber);
                        dayNumber.appendChild(slotsContainer);
                        calendar.appendChild(daySlot);
                    }
                }
                
                setTimeout(markClosureDates, 100);
            }
        
            function markClosureDates() {
                @if($activeAnnouncement && $activeAnnouncement->closure_start_date && $activeAnnouncement->closure_end_date)
                    const closureStartDate = new Date('{{ $activeAnnouncement->closure_start_date }}');
                    
                    // Create end date and add one day
                    const closureEndDate = new Date('{{ $activeAnnouncement->closure_end_date }}');
                    closureEndDate.setDate(closureEndDate.getDate() + 1);
                    
                    // Get all day slots in the calendar
                    const daySlots = document.querySelectorAll('[data-date]');
                    
                    daySlots.forEach(slot => {
                        const dateString = slot.getAttribute('data-date');
                        const currentDate = new Date(dateString);
                        
                        // Check if the date is within the closure period
                        // This will include the entire last day
                        if (currentDate >= closureStartDate && currentDate < closureEndDate) {
                            // Mark as closed if not already marked
                            if (!slot.classList.contains('closed-day')) {
                                slot.classList.add('closed-day', 'pointer-events-none', 'cursor-not-allowed');
                                slot.classList.remove('bg-white', 'bg-gray-100', 'bg-teal-200', 'bg-teal-300', 'bg-blue-300', 'bg-gray-300', 'bg-orange-300');
                                slot.classList.add('bg-red-100', 'border-red-500', 'text-red-700');
                                
                                // Add the CLOSED overlay if not already present
                                if (!slot.querySelector('.closed-overlay')) {
                                    const closedOverlay = document.createElement('div');
                                    closedOverlay.className = 'closed-overlay';
                                    
                                    const closedBanner = document.createElement('div');
                                    closedBanner.className = 'closed-banner';
                                    closedBanner.textContent = 'CLOSED';
                                    
                                    closedOverlay.appendChild(closedBanner);
                                    slot.appendChild(closedOverlay);
                                }
                                
                                // Set tooltip
                                slot.title = "Clinic Closed: {{ $activeAnnouncement->title }}";
                                
                                // Remove any click events
                                slot.onclick = null;
                            }
                        }
                    });
                @endif
            }
                    
            function fetchAppointments(selectedDate) {
                console.log("Fetching appointments for:", selectedDate);
                
                // Check if the selected date is within a clinic closure period
                @if($activeAnnouncement && $activeAnnouncement->closure_start_date && $activeAnnouncement->closure_end_date)
                    const closureStartDate = new Date('{{ $activeAnnouncement->closure_start_date }}');
                
                    const closureEndDate = new Date('{{ $activeAnnouncement->closure_end_date }}');
                    closureEndDate.setDate(closureEndDate.getDate() + 1);
                    
                    const selectedDateObj = new Date(selectedDate);
                    
                    // This will include the entire last day
                    if (selectedDateObj >= closureStartDate && selectedDateObj < closureEndDate) {
                        // Show clinic closed message
                        document.getElementById("appointmentsTableBody").innerHTML = `
                            <tr>
                                <td colspan="4" class="p-6 text-center">
                                    <div class="flex flex-col items-center justify-center text-red-600 py-6">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <h3 class="text-xl font-bold mb-2">Clinic Closed on This Date</h3>
                                        <p class="text-gray-700 text-center max-w-md mb-2">
                                            {{ $activeAnnouncement->title }}
                                        </p>
                                        <p class="text-gray-600 text-center max-w-md mb-4">
                                            {{ $activeAnnouncement->message }}
                                        </p>
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg">
                                            <p class="font-semibold">
                                                Closed from {{ \Carbon\Carbon::parse($activeAnnouncement->closure_start_date)->format('F j, Y') }} 
                                                to {{ \Carbon\Carbon::parse($activeAnnouncement->closure_end_date)->format('F j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `;
                        return; // Exit the function early
                    }
                @endif
        
                 $.ajax({
                    url: `/appointments/${selectedDate}`,  // The URL where the appointment data will be fetched
                    method: 'GET',  // HTTP request method
                    dataType: 'json',  // Expected response type
                    success: function(data) {
                        console.log("Fetched Appointments Data:", data); // Debugging output
                        // If there are available slots, update the appointments table
                        updateAppointmentsTable(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching appointments:", error);
            
                        // Display 'No Slots Available' message if there's an error or no slots
                        document.getElementById("appointmentsTableBody").innerHTML = `
                            <tr>
                                <td colspan="100%" class="text-center py-4">
                                    <div class="inline-block bg-red-200 border-2 border-red-500 text-red-500 font-semibold px-3 py-3 rounded-lg shadow">
                                        <i class="fa-solid fa-face-sad-cry text-red-500"></i>
                                         No slots available, Kindly Choose Another Date.
                                    </div>
                                </td>
                            </tr>
                        `;
                    }
                });
                        
            }
        
            function updateAppointmentsTable(appointments) {
                const tableBody = document.getElementById("appointmentsTableBody");
                tableBody.innerHTML = ""; // Clear existing rows
        
                // If no appointments are available, show a message
                if (!appointments || appointments.length === 0) {
                    tableBody.innerHTML =
                    ` <tr>
                        <td colspan="100%" class="text-center py-4">
                            <div class="inline-block bg-red-200 border-2 border-red-500 text-red-500 font-semibold px-3 py-3 rounded-lg shadow">
                                <i class="fa-solid fa-face-sad-cry text-red-500"></i>
                                 No appointments available, Kindly Choose Another Date.
                            </div>
                        </td>
                    </tr>`;
                    return;
                }
        
                console.log(appointments); // Debugging: Log the appointments array
        
                // Loop through each appointment slot
                appointments.forEach(slot => {
                    const appointmentExists = slot.appointment_exists; // Check if an appointment exists
                    const remainingSlots = slot.remaining_slots; // Check remaining slots
        
                    const row = document.createElement("tr");
        
                    row.innerHTML = `
                        <td class="p-4 border-b border-teal-100">
                            <div class="flex items-center justify-center gap-3">
                                <img src="/images/logo.png" alt="Logo"
                                    class="relative shadow-lg inline-block h-9 w-9 rounded-full object-cover object-center" />
                                <div class="flex flex-col">
                                    <p class="block text-md antialiased font-normal leading-normal text-blue-gray-900">
                                        ${new Date(slot.date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-teal-100">
                            <div class="flex flex-col">
                                <p class="block text-md antialiased font-normal leading-normal text-blue-gray-900">
                                    ${slot.time_slot}
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-teal-100">
                            <div class="w-max">
                                <div class="relative grid items-center px-2 py-1 text-md font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                    <span>${slot.remaining_slots} Slots Remaining</span>
                                </div>
                            </div>
                       <td class="p-4 border-b w-full flex justify-center border-teal-100">
                    ${!appointmentExists && remainingSlots > 0 ?
                        `<a href="/patient/bookappointment/${slot.id}" 
                            class="relative flex p-2 bg-teal-500 flex-row space-x-2 items-center justify-center h-12 w-44 select-none rounded-lg text-center align-middle text-xs font-medium uppercase hover:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            <i class="fa-solid fa-pen fa-lg text-white"></i>
                            <span class="mt-1 text-lg font-semibold text-white">CREATE</span>
                        </a>`
                        :
                        appointmentExists ?
                        `<a href="/patient/history">
                            <span class="px-5 py-2 text-white bg-teal-600 rounded-lg flex flex-col items-center text-center hover:bg-teal-700 transition">
                                <span class="text-lg font-semibold">Appointment Already Set</span>
                                <div class="flex flex-row items-center justify-center mt-1">
                                    <p class="text-sm text-gray-200 mx-2">Click to view</p>
                                    <i class="fa-solid fa-arrow-right mt-0.5"></i>
                                </div>
                            </span>
                        </a>`
                        :
                        `<div class="flex items-center justify-center bg-red-400 border border-red-400 text-white px-4 py-3 rounded-lg shadow-md" role="alert">
                            <i class="fa-solid fa-circle-exclamation text-white text-xl mr-3"></i>
                            <span class="font-semibold text-lg">No available slots</span>
                        </div>
                        `
                    }
                </td>
                    `;
        
                    console.log(appointmentExists); // Debugging: Log if an appointment exists
                    tableBody.appendChild(row);
                });
            }
        
            function resetFilter() {
                document.getElementById("dateFilter").value = "";
                filterDate();
            }
        
            function filterAppointments() {
                let input = document.getElementById("searchInput").value.toLowerCase();
                let tableBody = document.getElementById("appointmentsTableBody");
                let rows = tableBody.getElementsByTagName("tr");
                for (let row of rows) {
                    let text = row.textContent.toLowerCase();
                    row.style.display = text.includes(input) ? "" : "none";
                }
            }
        
            function filterDate() {
                let dateValue = document.getElementById("dateFilter").value;
                console.log("Selected Date:", dateValue);
                let tableBody = document.getElementById("appointmentsTableBody");
                let rows = tableBody.getElementsByTagName("tr");
        
                for (let row of rows) {
                    let rowDateText = row.getAttribute("data-date");
                    let rowDate = convertDate(rowDateText);
                    console.log(`Row Date (Converted): ${rowDate} | Original: ${rowDateText}`);
        
                    if (!dateValue || rowDate === dateValue) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
        
            function convertDate(dateString) {
                let dateObj = new Date(dateString);
                if (isNaN(dateObj)) {
                    console.log(`⚠️ Invalid date format: ${dateString}`);
                    return "";
                }
        
                let year = dateObj.getFullYear();
                let month = (dateObj.getMonth() + 1).toString().padStart(2, "0");
                let day = dateObj.getDate().toString().padStart(2, "0");
        
                return `${year}-${month}-${day}`;
            }
        
            function formatTimeTo12Hour(time) {
                const [hour, minute] = time.split(':');
                const formattedTime = new Date();
                formattedTime.setHours(parseInt(hour));
                formattedTime.setMinutes(parseInt(minute));
                const options = {
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true
                };
                return formattedTime.toLocaleString('en-US', options);
            }
        
            // Add event listeners for month/year changes
            monthSelect.addEventListener('change', function() {
                renderCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
                setTimeout(markClosureDates, 100);
            });
        
            yearSelect.addEventListener('change', function() {
                renderCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
                setTimeout(markClosureDates, 100);
            });
        
            // Initialize the calendar
            renderCalendar(currentMonth, currentYear);
            
            // Handle window resize
            window.addEventListener("resize", () => {
                renderCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
                setTimeout(markClosureDates, 100);
            });
        });
    </script>

    <style>
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes borderAnimation {
            0% {
                box-shadow: 0 0 5px rgba(20, 184, 166, 0.5);
                border-color: rgba(20, 184, 166, 0.5);
            }

            50% {
                box-shadow: 0 0 15px rgba(20, 184, 166, 1);
                border-color: rgba(20, 184, 166, 1);
            }

            100% {
                box-shadow: 0 0 5px rgba(20, 184, 166, 0.5);
                border-color: rgba(20, 184, 166, 0.5);
            }
        }

        .highlight {
            transition: background-color s ease-in-out;
        }

        .animate-border {
            animation: borderAnimation 2s infinite ease-in-out;
        }
        .closed-day {
            background-color: #fee2e2 !important; /* Light red background */
            border-color: #ef4444 !important; /* Red border */
            position: relative;
            overflow: hidden;
        }
        
        .closed-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            pointer-events: none;
        }
        
        .closed-banner {
            background-color: rgba(239, 68, 68, 0.8);
            color: white;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 4px;
            transform: rotate(-12deg);
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: pulseClosed 2s infinite ease-in-out;
        }
        
        @keyframes pulseClosed {
            0% { transform: rotate(-12deg) scale(1); }
            50% { transform: rotate(-12deg) scale(1.1); }
            100% { transform: rotate(-12deg) scale(1); }
        }
        
        @media (max-width: 640px) {
            .closed-mobile-indicator {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                background-color: #ef4444;
                color: white;
                font-weight: bold;
                padding: 2px 8px;
                border-radius: 4px;
                font-size: 0.8rem;
            }
        }
    </style>
</x-patientnav-layout>

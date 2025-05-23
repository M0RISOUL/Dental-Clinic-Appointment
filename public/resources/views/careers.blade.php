<x-navbar-layout>
    <div class="py-12">
        @if($jobs->isEmpty())
            <div class="job-container bg-teal-50 shadow-lg text-center p-5 rounded-lg max-w-4xl mx-auto">
                <div class="w-full">
                    <form action="{{ route('jobs.filter') }}" method="POST">
                        @csrf
                        <div
                            class="job-card bg-white group p-4 mt-5 mb-5 rounded-lg border py-8 text-gray-700 shadow transition hover:shadow-lg flex flex-col justify-center items-center">
                            <i class="fas fa-briefcase text-6xl text-teal-600 mb-4"></i>
                            <p class="text-gray-700 text-lg">No jobs found. Please adjust your filters or check back later.
                            </p>
                            <button type="submit"
                                class="w-fit mt-4 bg-teal-600 text-white p-2 rounded hover:bg-teal-700">Reset
                                Filters</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="flex flex-col  lg:flex-row">
                <div class="bg-white  shadow-lg lg:rounded-r-lg max-w-xs  w-full lg:w-1/4 mb-5 mt-5 h-96 lg:block position-sticky">
                    <div class="flex items-center bg-teal-500 p-4 mb-5 lg:rounded-r-lg">
                        <i class="fas fa-briefcase text-white mr-2"></i>
                        <h2 class="text-xl font-bold text-white">Search Jobs</h2>
                    </div>
                    <!-- Job Search Filter -->
                    <div class=" p-4 m-4 bg-white rounded shadow">
                        <form action="{{ route('jobs.filter') }}" method="POST">
                            @csrf
                            <h3 class="text-md font-semibold mb-2">Job Search Filter</h3>
                            <input type="text" placeholder="Search jobs..." name="search"
                                class="w-full p-2 mb-2 border rounded">
                            <select class="w-full p-2 mb-2 border rounded" name="jobtype">
                                <option value="">Select Job Type</option>
                                <option value="Remote">Remote</option>
                                <option value="Onsite">Onsite</option>
                            </select>
                            <div class="mb-4">
                                <label for="salaryRange" class="block text-sm font-medium text-gray-700">Salary
                                    Range</label>
                                <input type="range" id="salary" name="salary" min="20000" max="200000" step="1000"
                                    class="w-full mt-2" oninput="updateSalaryValue(this.value)">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>₱20,000</span>
                                    <span id="salaryValue">₱200,000</span>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-teal-600 text-white p-2 rounded hover:bg-teal-700">Apply
                                Filters</button>
                        </form>
                    </div>
                </div>
                <div class="flex-col">
                    <div
                        class="max-w-8xl mx-auto  lg:px-8 grid lg:gap-4 gap-2 lg:grid-cols-1 md:grid-cols-1 sm:grid-cols-1">
                        <div class="bg-white p-4 mt-4 rounded-lg shadow border-r-4 border-teal-500 grid grid-cols-2 gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-700">Available Jobs</h2>
                                <p class="text-sm text-gray-600">Kindly click jobs to view the description.</p>
                            </div>
                            <div class="flex items-center justify-end">
                                <p class="text-gray-700 font-medium">There are <span
                                        class="font-bold text-teal-500">{{ $jobsCount }}</span> jobs found.</p>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <ul class="list-disc list-inside text-sm text-red-700">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div
                            class="job-container bg-white shadow-lg text-center p-5 rounded-lg grid lg:grid-cols-3 md:grid-cols-1 sm:grid-cols-1">
                            @foreach ($jobs as $job)
                                                @php
                                                    $vacancyCount = $job->vacancy - \App\Models\JobApplication::where('job_id', $job->id)->where('status', 'hired')->count();
                                                @endphp
                                                @if ($vacancyCount > 0)
                                                    <div class="m-2">
                                                        <div class="job-card group mx-2 mt-5 mb-5 grid max-w-screen-md grid-cols-12 space-x-8 overflow-hidden rounded-lg border py-8 text-gray-700 shadow transition hover:shadow-lg sm:mx-auto"
                                                            data-id="{{ $job->id }}">
                                                            <a href="#"
                                                                class="order-2 col-span-1 mt-4 -ml-14 text-left text-gray-600 hover:text-gray-700 sm:-order-1 sm:ml-4">
                                                                <div class="group relative h-16 w-16 overflow-hidden rounded-lg">
                                                                    <img src="/images/logo.png" alt=""
                                                                        class="h-full w-full object-cover text-gray-700" />
                                                                    <i class="fas fa-arrow-right"></i>
                                                                </div>
                                                            </a>
                                                            <div
                                                                class="col-span-11 flex flex-col pr-8 text-left sm:pl-4 min-h-[180px] justify-between">
                                                                <h3 class="text-sm text-gray-600">{{ $job->created_at->format('F j, Y') }}</h3>
                                                                <a href="#" class="mb-3 text-lg font-semibold sm:text-xl">{{ $job->title }}</a>
                                                                <p class="text-sm flex-grow">{{ Str::words($job->description, 50, '...') }}</p>
                                                                <div
                                                                    class="mt-5 flex flex-wrap items-center gap-3 text-sm font-medium text-gray-500">
                                                                    <div class="flex items-center gap-1">
                                                                        <span>Experience:</span>
                                                                        <span
                                                                            class="rounded-full bg-green-100 px-2 py-0.5 text-green-900">{{ $job->workexperience }}
                                                                            Years</span>
                                                                    </div>
                                                                    <div class="flex items-center gap-1">
                                                                        <span>Salary:</span>
                                                                        <span
                                                                            class="rounded-full bg-blue-100 px-4 py-0.5 text-blue-900">{{ number_format($job->salary, 2) }}
                                                                            Php</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="job-modal fixed inset-0 z-50 hidden backdrop-blur-sm items-center justify-center bg-black bg-opacity-50"
                                                        data-id="{{ $job->id }}">
                                                        <div
                                                            class="modal-content bg-white  rounded-lg shadow-lg max-w-lg w-full relative opacity-0 scale-90 transition-all duration-300 max-h-[800px] overflow-y-auto scale-90">
                                                            <div
                                                                class="bg-teal-500 flex items-center text-center gap-2 p-4 rounded-t-lg text-white">
                                                                <i class="fa-solid fa-briefcase text-white"></i>
                                                                <h2 class="text-lg font-semibold">Apply for {{ $job->title }}</h2>
                                                            </div>
                                                            <div class="p-6">
                                                                <p class="mt-2 text-teal-700 text-start font-bold">Job Description:</p>
                                                                <textarea name="description" id="description" rows="4"
                                                                    class="w-full  border rounded-lg mt-2 text-gray-700 p-2 bg-teal-50  focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 resize-none"
                                                                    readonly
                                                                    placeholder="Enter the job description here...">{{ $job->description }}</textarea>
                                                                <div
                                                                    class="mt-4 grid grid-cols-1  gap-4 items-center justify-center lg:grid-cols-2 text-center lg:text-left">
                                                                    <div class="mt-2 ml-2 text-center">
                                                                        <label for="experience" class="font-bold text-teal-700">Experience:</label>
                                                                        <input type="text" id="experience" name="experience"
                                                                            value="{{ $job->workexperience }} Years"
                                                                            class="w-full p-2 border rounded bg-teal-50 mt-2" required>
                                                                    </div>
                                                                    <div class="mt-2 mr-2 text-center">
                                                                        <label for="jobtype" class="font-bold text-teal-700">Job Type:</label>
                                                                        <input type="text" id="jobtype" name="jobtype" value="{{ $job->jobtype }}"
                                                                            class="w-full p-2 border rounded bg-teal-50 mt-2" required>
                                                                    </div>
                                                                    <div class="mt-2 ml-2 text-center">
                                                                        <label for="salary" class="font-bold text-teal-700">Salary:</label>
                                                                        <input type="text" id="salary" name="salary"
                                                                            value="{{ number_format($job->salary, 2) }} Php"
                                                                            class="w-full p-2 border rounded bg-teal-50 mt-2" required>
                                                                    </div>
                                                                    <div class="mt-2 mr-2 text-center">
                                                                        <label for="location" class="font-bold text-teal-700">Location:</label>
                                                                        <input type="text" id="location" name="location"
                                                                            value="{{ $job->location }}"
                                                                            class="w-full p-2 border rounded bg-teal-50 mt-2" required>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="w-full font-semibold text-teal-700 bg-teal-200 p-2 rounded-lg justify-center text-center mt-2">
                                                                    <span class="font-bold text-teal-700">Vacancy:</span>
                                                                    <td
                                                                        class="px-6 py-4 whitespace-nowrap text-sm text-teal-600 border-r border-teal-50">
                                                                        {{ $job->vacancy - \App\Models\JobApplication::where('job_id', $job->id)->where('status', 'hired')->count() }}
                                                                        Vacancy
                                                                    </td>
                                                                </div>


                                                                <!-- Job Application Form -->
                                                                <form action="{{ route('jobs.jobapply', $job->id) }}" method="POST" class="p-4"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mt-4">
                                                                        <label for="name"
                                                                            class="text-start block text-teal-700 font-bold flex items-center">
                                                                            <i class="fas fa-user mr-2"></i> Your Name:
                                                                        </label>
                                                                        <input type="text" id="name" name="fullname"
                                                                            class="w-full p-2 border rounded bg-teal-50 mt-2"
                                                                            placeholder="Enter your name" required>
                                                                    </div>

                                                                    <div class="mt-4">
                                                                        <label for="email"
                                                                            class="text-start block text-teal-700 font-bold flex items-center">
                                                                            <i class="fas fa-envelope mr-2"></i> Your Email:
                                                                        </label>
                                                                        <input type="email" id="email" name="email"
                                                                            class="w-full p-2 border rounded bg-teal-50 mt-2"
                                                                            placeholder="Enter your email" required>
                                                                    </div>

                                                                    <div class="mt-4">
                                                                        <label for="experience"
                                                                            class="text-start block text-teal-700 font-bold flex items-center">
                                                                            <i class="fas fa-phone-alt mr-2"></i> Phone Number:
                                                                        </label>
                                                                        <input type="number" id="experience" name="phone" maxlength="11"
                                                                            class="w-full p-2 border rounded bg-teal-50 mt-2"
                                                                            placeholder="Enter your Experience in years" required>
                                                                    </div>

                                                                    <div class="mt-4">
                                                                        <label for="resume"
                                                                            class="text-start block text-teal-700 font-bold flex items-center">
                                                                            <i class="fas fa-file-alt mr-2"></i> Upload Resume:
                                                                        </label>
                                                                        <input type="file" id="resume" name="resume"
                                                                            class="w-full p-2 border rounded bg-teal-50 mt-2" accept=".pdf"
                                                                            required>
                                                                    </div>

                                                                    <div class="mt-4 flex items-center justify-end gap-2">
                                                                        <button type="submit"
                                                                            class="bg-teal-500 px-4 py-2  text-white rounded-lg">Submit
                                                                            Application</button>
                                                                        <button
                                                                            class="close-modal  text-end px-4 py-2 bg-red-500 text-white rounded-lg">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                            @endforeach
        @endif
                    </div>
                    @if (!$jobs->isEmpty())
                        <div class="mt-4 bg-slate-50 w-full  shadow-lg rounded-lg p-4 flex justify-end">
                            <x-pagination :paginator="$jobs" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const jobContainer = document.querySelector(".job-container");

            jobContainer.addEventListener("click", function (event) {
                const jobCard = event.target.closest(".job-card");
                if (jobCard) {
                    const jobId = jobCard.getAttribute("data-id");
                    const modal = document.querySelector(`.job-modal[data-id="${jobId}"]`);
                    const modalContent = modal.querySelector(".modal-content");

                    if (modal) {
                        modal.classList.remove("hidden");
                        modal.classList.add("flex");
                        setTimeout(() => {
                            modalContent.classList.remove("opacity-0", "scale-90");
                            modalContent.classList.add("opacity-100", "scale-100");
                        }, 100);
                    }
                    return;
                }

                const closeModal = event.target.closest(".close-modal");
                if (closeModal) {
                    const modal = closeModal.closest(".job-modal");
                    const modalContent = modal.querySelector(".modal-content");

                    if (modal) {
                        modalContent.classList.remove("opacity-100", "scale-100");
                        modalContent.classList.add("opacity-0", "scale-90");
                        setTimeout(() => modal.classList.add("hidden"), 300);
                    }
                    return;
                }

                const modal = event.target.closest(".job-modal");
                if (modal && event.target === modal) {
                    modal.classList.add("hidden");
                }
            });
        });

        function updateSalaryValue(value) {
            document.getElementById('salaryValue').textContent = '₱' + parseInt(value).toLocaleString();
        }
    </script>



</x-navbar-layout>
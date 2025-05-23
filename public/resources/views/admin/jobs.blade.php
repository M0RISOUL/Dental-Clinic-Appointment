<x-sidebar-layout>
    <script>
        let jobs = {!! json_encode($jobs) !!};
        console.log(jobs);
    </script>
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4"></div>
        <div class="mb-8 rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-white mb-1">Manage Jobs</h1>
                            <p class="text-teal-100">View and manage job posts</p>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0 cursor-pointer" onclick="openModal()">
                        <span
                            class="inline-flex items-center px-2 py-2 rounded-lg text-sm font-medium bg-white text-teal-700 shadow-sm">
                            <i class="fa-solid fa-plus mx-2"> </i>
                            Add Job
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-teal-50 px-6 py-3 border-t border-teal-200">
                <div class="flex items-center text-sm text-teal-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Add, Edit, and View all Job postings from this dashboard.</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div
                class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-md border border-teal-200 p-5 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                        <i class="fas fa-clipboard-list text-2xl"></i> <!-- Font Awesome Icon -->
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-teal-900">Job Applications</h2>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-teal-800">
                                {{ App\Models\JobApplication::count() }}
                            </p>
                            <span class="ml-2 text-xs text-teal-600">Applications</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-md border border-teal-200 p-5 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                        <i class="fas fa-check-circle text-2xl"></i> <!-- Font Awesome Icon -->
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-teal-900">Approved Job Applications</h2>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-teal-800">
                                {{ App\Models\JobApplication::where('status', 'approved')->count() }}
                            </p>
                            <span class="ml-2 text-xs text-teal-600">Approved</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-md border border-teal-200 p-5 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                        <i class="fas fa-clock text-2xl"></i> <!-- Font Awesome Icon -->
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-teal-900">Pending Job Applications</h2>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-teal-800">
                                {{ App\Models\JobApplication::where('status', 'pending')->count() }}
                            </p>
                            <span class="ml-2 text-xs text-teal-600">Pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-md border border-teal-200 p-5 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                        <i class="fas fa-briefcase text-2xl"></i> <!-- Font Awesome Icon -->
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-teal-900">Total Vacancies</h2>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-teal-800">
                                {{ App\Models\CareerJob::sum('vacancy') }}
                            </p>
                            <span class="ml-2 text-xs text-teal-600">Vacancies</span>
                        </div>
                    </div>
                </div>
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

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-teal-100">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gradient-to-r from-teal-50 to-teal-100 text-left">
                            <th
                                class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider border-r border-teal-200">
                                Title</th>
                            <th
                                class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider border-r border-teal-200">
                                Location</th>
                            <th
                                class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider border-r border-teal-200">
                                Job Type</th>
                            <th
                                class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider border-r border-teal-200">
                                Salary</th>
                            <th
                                class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider border-r border-teal-200">
                                Vacancy</th>
                            <th
                                class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider border-r border-teal-200">
                                Work Experience</th>
                            <th
                                class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider border-r border-teal-200">
                                Created Date</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-teal-700 uppercase tracking-wider">Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-teal-100">
                        @foreach ($jobs as $job)
                            <tr class="hover:bg-teal-50 transition text-center">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-teal-900 font-medium border-r border-teal-50">
                                    {{ $job->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-teal-50">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-teal-100 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-teal-600 font-medium text-sm">{{ Str::limit($job->location, 2, '') }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-teal-900">{{ $job->location }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-600 border-r border-teal-50">
                                    {{ $job->jobtype }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-600 border-r border-teal-50">
                                    {{ '₱' . number_format($job->salary, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-600 border-r border-teal-50">
                                    {{ $job->vacancy - \App\Models\JobApplication::where('job_id', $job->id)->where('status', 'hired')->count() }}
                                    Vacancy
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-600 border-r border-teal-50">
                                    {{$job->workexperience}} Years of Experience
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-600 border-r border-teal-50">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-400 mr-1.5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $job->created_at->format('F j, Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <!-- When Approved, show Attended and Cancel -->
                                    <!-- Buttons -->
                                    <div class="flex gap-2">
                                        <button onclick="openModal(true, {{ $job->id }})"
                                            class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1.5
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    rounded-md text-xs hover:from-blue-600 hover:to-blue-700 transition shadow-sm
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    flex items-center gap-1 border border-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button onclick="openCloseModal({{ $job->id }})"
                                            class="bg-gradient-to-r from-rose-500 to-rose-600 text-white px-3 py-1.5 rounded-md text-xs hover:from-rose-600 hover:to-rose-700 transition shadow-sm flex items-center gap-1 border border-rose-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Cancel
                                        </button>

                                    </div>
                                    <div id="closeModal"
                                        class="fixed inset-0 backdrop-blur-sm bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center hidden">
                                        <div class="bg-white rounded-lg shadow-lg w-full max-w-xl transform transition-all scale-90 opacity-0"
                                            id="closemodal-content">
                                            <!-- Modal Header -->
                                            <div id="closemodalHeader"
                                                class="px-6 py-4 rounded-t-lg bg-red-500 text-white relative">
                                                <div class="absolute top-3 right-3"></div>
                                                <div class="flex items-center gap-3">
                                                    <div id="closemodalIconContainer"
                                                        class="bg-white bg-opacity-20 rounded-full p-2">
                                                        <svg id="modalSvg" xmlns="http://www.w3.org/2000/svg"
                                                            class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </div>
                                                    <h2 id="closemodalTitle" class="text-xl font-bold">Delete Job</h2>
                                                </div>
                                            </div>
                                            <div class="p-6 text-md text-gray-700">
                                                <p>Are you sure you want to delete the job with ID:
                                                    <span id="jobIdText" class="font-semibold text-red-600"></span>?
                                                    <br>This action cannot be undone.
                                                </p>
                                            </div>

                                            <form id="deleteJobForm" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" id="jobId" name="jobId">
                                                <div class="px-6 py-4 flex justify-end gap-3 bg-gray-100 rounded-b-lg">
                                                    <button type="button" onclick="closeModal()"
                                                        class="bg-white text-gray-700 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition shadow-sm font-medium">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" id="deleteButton"
                                                        class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition shadow-sm font-medium">
                                                        Delete
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div id="modal"
                                        class="fixed inset-0 backdrop-blur-sm bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center hidden">
                                        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg transform transition-all scale-90 opacity-0"
                                            id="modal-content">
                                            <div id="modalHeader"
                                                class="px-6 py-4 rounded-t-lg bg-blue-500 text-white relative">
                                                <div class="absolute top-3 right-3"></div>
                                                <div class="flex items-center gap-3">
                                                    <div id="modalIconContainer"
                                                        class="bg-white bg-opacity-20 rounded-full p-2">
                                                        <svg id="modalSvg" xmlns="http://www.w3.org/2000/svg"
                                                            class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </div>
                                                    <h2 id="modalTitle" class="text-xl font-bold">Edit Job Details</h2>
                                                </div>
                                            </div>

                                            <form id="jobForm" method="POST">
                                                @csrf
                                                <input type="hidden" id="methodField" name="_method" value="POST">
                                                <div class="p-6 flex flex-col">
                                                    <p class="text-gray-600 mt-2 mb-2 text-pretty">Job Title</p>
                                                    <input type="text" placeholder="Enter" id="jobTitle" name="jobTitle"
                                                        class="w-full p-3 border border-gray-300 rounded-lg text-sm">

                                                    <p class="text-gray-600 mt-2 mb-2 text-pretty">Location</p>
                                                    <input type="text" placeholder="Enter" id="jobLocation"
                                                        name="jobLocation"
                                                        class="w-full p-3 border border-gray-300 rounded-lg text-sm">

                                                    <p class="text-gray-600 mt-2 mb-2 text-pretty">Job Type</p>
                                                    <select id="jobType" name="jobType"
                                                        class="w-full p-3 border border-gray-300 rounded-lg text-sm">
                                                        <option value="Remote">Remote</option>
                                                        <option value="Onsite">Onsite</option>
                                                    </select>

                                                    <p class="text-gray-600 mt-2 mb-2 text-pretty">Vacancy</p>
                                                    <input type="number" min="1" id="vacancy" name="vacancy"
                                                        class="w-full p-3 border border-gray-300 rounded-lg text-sm">

                                                    <p class="text-gray-600 mt-2 mb-2 text-pretty">Work Experience (Years)
                                                    </p>
                                                    <input type="number" min="0" id="jobExperience" name="jobExperience"
                                                        class="w-full p-3 border border-gray-300 rounded-lg text-sm">

                                                    <p class="text-gray-600 mt-2 mb-2 text-pretty">Job Description</p>
                                                    <textarea id="jobDescription" name="jobDescription" rows="4"
                                                        placeholder="Enter a job description..."
                                                        class="w-full p-3 border border-gray-300 rounded-lg text-sm"></textarea>


                                                    <p class="text-gray-600 mt-2 mb-2 text-pretty">Salary Range (Maximum)
                                                    </p>
                                                    <input type="range" id="salaryRange" min="0" max="250000" step="500"
                                                        name="salaryRange" class="w-full"
                                                        oninput="updateSalaryValue(this.value)">
                                                    <p id="salaryValue" class="text-gray-600 text-center mt-2"></p>
                                                    <hr class="mt-4">


                                                    <div class="flex justify-end gap-3 mt-2 pt-2">
                                                        <button type="button" onclick="closeModal()"
                                                            class="bg-white text-gray-700 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition shadow-sm font-medium">
                                                            Cancel
                                                        </button>
                                                        <button type="submit" id="confirmButton"
                                                            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm font-medium flex items-center gap-2">
                                                            <i id="confirmButtonIcon"></i>
                                                            <span id="confirmButtonText">Edit</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <script>
                                        function updateSalaryValue(value) {
                                            console.log("Salary Value:", value);
                                            document.getElementById('salaryValue').innerText = `₱${parseInt(value).toLocaleString()}`;
                                        }
                                        function openModal(isEdit = false, jobId = null) {
                                            const modal = document.getElementById('modal');
                                            const modalHeader = document.getElementById("modalHeader");
                                            const confirmButton = document.getElementById("confirmButton");
                                            const modalTitle = document.getElementById("modalTitle");
                                            const jobData = jobs.find(job => job.id === jobId);
                                            const content = document.getElementById('modal-content');
                                            const salaryElement = document.getElementById("salaryValue");

                                            // Set modal title and button text/icon
                                            document.getElementById('modalTitle').innerText = isEdit ? "Edit Job" : "Add Job";
                                            document.getElementById('confirmButtonText').innerText = isEdit ? "Save Changes" : "Add Job";
                                            document.getElementById('confirmButtonIcon').className = isEdit ? "fas fa-save" : "fas fa-plus";

                                            modalHeader.classList.remove("bg-blue-500", "bg-green-500");
                                            confirmButton.classList.remove("bg-blue-500", "bg-green-500");

                                            if (modalTitle.innerText === "Edit Job") {
                                                modalHeader.classList.add("bg-blue-500");
                                                confirmButton.classList.add("bg-blue-500");
                                            } else {
                                                modalHeader.classList.add("bg-green-500");
                                                confirmButton.classList.add("bg-green-500");
                                            }
                                            document.getElementById('jobTitle').value = isEdit ? jobData.title || "" : "";
                                            document.getElementById('jobLocation').value = isEdit ? jobData.location || "" : "";
                                            document.getElementById('jobType').value = isEdit ? jobData.jobtype || "" : "";
                                            document.getElementById('vacancy').value = isEdit ? jobData.vacancy || 0 : 0;
                                            document.getElementById('jobExperience').value = isEdit ? jobData.workexperience || 0 : 0;
                                            document.getElementById('jobDescription').value = isEdit ? jobData.description || "" : "";
                                            document.getElementById('salaryRange').value = isEdit ? jobData.salary || 0 : 0;
                                            salaryElement.innerText = `PHP ${isEdit ? jobData.salary : 0}`;
                                            const form = document.getElementById('jobForm');
                                            if (isEdit) {
                                                form.action = `/admin/job/update/${jobId}`;
                                                document.getElementById('methodField').value = 'PUT';
                                            } else {
                                                form.action = '/admin/job/store'; // Add route
                                                document.getElementById('methodField').value = 'POST';
                                            }
                                            modal.classList.remove('hidden');
                                            setTimeout(() => {
                                                content.classList.remove('scale-90', 'opacity-0');
                                                content.classList.add('scale-100', 'opacity-100');
                                            }, 100);
                                        }
                                        function openCloseModal(jobId) {
                                            const modal = document.getElementById('closeModal');
                                            const content = modal.querySelector('#closemodal-content');
                                            document.getElementById('jobIdText').innerText = jobId;
                                            document.getElementById('jobId').value = jobId;
                                            const formAction = document.getElementById('deleteJobForm');
                                            formAction.action = '/admin/job/' + jobId + '/delete';
                                            modal.classList.remove('hidden');

                                            setTimeout(() => {
                                                content.classList.remove('scale-90', 'opacity-0');
                                                content.classList.add('scale-100', 'opacity-100');
                                            }, 100);
                                        }

                                        function closeModal() {
                                            const content = document.getElementById('modal-content');
                                            const closemodalcontent = document.getElementById('closemodal-content');
                                            content.classList.remove('scale-100', 'opacity-100');
                                            content.classList.add('scale-90', 'opacity-0');
                                            closemodalcontent.classList.remove('scale-100', 'opacity-100');
                                            closemodalcontent.classList.add('scale-90', 'opacity-0');
                                            setTimeout(() => {
                                                document.getElementById('modal').classList.add('hidden');
                                                document.getElementById('closeModal').classList.add('hidden');
                                            }, 200);
                                        }
                                    </script>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>


    <div class="mb-8 rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r bg-white p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-teal-600 mb-1">Manage Job Applications</h1>
                        <p class="text-teal-600">View and manage job applications.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($applications as $application)
                <div
                    class="bg-teal-50 border-l-4 border-teal-600 rounded-lg shadow-lg p-6 hover:shadow-lg transition-shadow transform hover:-translate-y-1 duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-500/20 text-teal-600">
                            <i class="fas fa-briefcase text-2xl"></i> <!-- Font Awesome Icon -->
                        </div>
                        <div class="ml-4">
                            <h2 class="text-xl font-semibold text-teal-600">{{ $application->careerJob->title }}</h2>
                            <h4 class="text-lg text-teal-900 mt-1">{{ $application->fullname }}</h4>
                            <p class="text-sm text-teal-600 mt-1">{{ $application->email }}</p>
                            <div class="flex gap-2">
                                <p
                                    class="text-sm p-2 rounded-lg w-fit mt-4 
                                                                                                                                                                    @if($application->status === 'pending') 
                                                                                                                                                                        bg-orange-200 text-orange-700 
                                                                                                                                                                    @elseif($application->status === 'approved') 
                                                                                                                                                                        bg-green-200 text-green-700 
                                                                                                                                                                    @else 
                                                                                                                                                                        bg-teal-200 text-teal-700 
                                                                                                                                                                    @endif
                                                                                                                                                                ">
                                    Status:
                                    <span class="font-semibold">
                                        {{ ucwords($application->status) }}
                                    </span>
                                </p>

                                <button
                                    class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition duration-300"
                                    data-modal-toggle="applicationModal{{ $application->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div id="applicationModal{{ $application->id }}"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden"
                    data-modal="applicationModal{{ $application->id }}">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg transform transition-all scale-90"
                        id="modal-content">
                        <div id="modalHeader" class="px-6 py-4 rounded-t-lg bg-teal-600 text-white relative">
                            <div class="absolute top-3 right-3">
                                <button data-modal-toggle="applicationModal{{ $application->id }}" class="text-white">
                                    <i class="fas fa-times text-2xl"></i>
                                </button>
                            </div>
                            <div class="flex items-center gap-3">
                                <div id="modalIconContainer" class="bg-teal-50 bg-opacity-20 rounded-full p-2">
                                    <i class="fas fa-briefcase text-2xl text--600"></i> <!-- Font Awesome Icon -->
                                </div>
                                <h2 id="modalTitle" class="text-xl font-bold">Application Details</h2>
                            </div>
                        </div>

                        <form id="jobForm" action="{{ route('admin.hire', ['id' => $application->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="p-6 flex flex-col">
                                <label for="jobTitle" class="text-teal-600 mt-2 mb-2 text-start"><strong>Job
                                        Title:</strong></label>
                                <input type="text" id="jobTitle" name="jobTitle"
                                    value="{{ $application->careerJob->title }}"
                                    class="w-full p-3 border border-gray-300 rounded-lg text-sm" readonly>

                                <label for="applicantName" class="text-teal-600 mt-2 mb-2 text-start"><strong>Applicant
                                        Name:</strong></label>
                                <input type="text" id="applicantName" name="applicantName"
                                    value="{{ $application->fullname }}"
                                    class="w-full p-3 border border-gray-300 rounded-lg text-sm" readonly>

                                <label for="email"
                                    class="text-teal-600 mt-2 mb-2 text-start"><strong>Email:</strong></label>
                                <input type="email" id="email" name="email" value="{{ $application->email }}"
                                    class="w-full p-3 border border-gray-300 rounded-lg text-sm" readonly>

                                <label for="status"
                                    class="text-teal-600 mt-2 mb-2 text-start"><strong>Status:</strong></label>
                                <input type="text" id="status" name="status" value="{{ ucwords($application->status) }}"
                                    class="w-full p-3 border border-gray-300 rounded-lg text-sm" readonly>

                                <label for="appliedOn" class="text-teal-600 mt-2 mb-2 text-start"><strong>Applied
                                        On:</strong></label>
                                <input type="text" id="appliedOn" name="appliedOn"
                                    value="{{ $application->created_at->format('M d, Y') }}"
                                    class="w-full p-3 border border-gray-300 rounded-lg text-sm" readonly>

                                <label for="jobDescription" class="text-teal-600 mt-2 mb-2 text-start"><strong>Job
                                        Description:</strong></label>
                                <textarea id="jobDescription" name="jobDescription" rows="4"
                                    class="w-full p-3 border border-gray-300 rounded-lg text-sm"
                                    readonly>{{ $application->careerJob->description }}</textarea>

                                @if ($application->resume)
                                    <div class="mt-4">
                                        <strong>Resumes:</strong>
                                        <a href="{{ Storage::url($application->resume) }}" class="text-teal-600 hover:underline"
                                            target="_blank">
                                            <i class="fas fa-file-pdf mr-2"></i> View Resume
                                        </a>
                                    </div>
                                @endif


                                <div class="flex justify-end gap-3 mt-4 pt-2">
                                    <button type="submit"
                                        class="bg-teal-600 hover:bg-teal-700  text-white px-4 py-2 rounded-lg transition shadow-sm font-medium">
                                        {{ $application->status === 'For Interview' ? 'Email Sent' : 'Email Applicant' }}
                                    </button>
                                    <button type="button" data-modal-hide="applicationModal{{ $application->id }}"
                                        class="bg-red-500 hover:bg-red-600  text-white px-4 py-2 rounded-lg transition shadow-sm font-medium">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>


    </div>

</x-sidebar-layout>
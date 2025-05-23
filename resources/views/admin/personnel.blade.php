<x-sidebar-layout>

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
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-1">Manage Personnel</h1>
                        <p class="text-teal-100">View and manage personnel</p>
                    </div>
                </div>
                <a href="#addTeamModal"
                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-gradient-to-r from-teal-400 to-teal-600 text-white shadow-md hover:from-teal-600 hover:to-teal-400 cursor-pointer transition duration-300"
                    data-modal-toggle="addTeamModal" data-modal-target="addTeamModal">
                    <i class="fa-solid fa-plus mx-2"></i> Add Personnel
                </a>

                <x-personnel-modal />

            </div>

        </div>
        <div class="bg-teal-50 px-6 py-3 border-t border-teal-200">
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

            <div class="flex items-center text-sm text-teal-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Add, Edit, and View all personnel for updates in the Contact Page.</span>
            </div>
        </div>
    </div>


    <form action="{{ route('admin.updatepersonnel', ['id' => $doctor->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="w-full bg-teal-50 p-6 m-2 rounded-lg mb-6 flex justify-between items-center cursor-pointer"
            onclick="toggleDropdown()">
            <div class="text-xl font-semibold text-teal-500 flex items-center space-x-3">
                <i class="fas fa-user-edit"></i>
                <span>Edit Doctor Details</span>
            </div>
            <i id="arrow-icon" class="fas fa-arrow-down fa-xl text-teal-500 ml-2"></i>
        </div>

        <div id="dropdown-content"
            class="w-full p-4 mb-4 shadow-lg bg-teal-50 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mt-6 gap-6 overflow-hidden max-h-0 opacity-0 transition-all ease-in-out duration-300 hidden">
            <!-- Name Field -->
            <div class="max-w-full mb-4 mx-2">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Name</label>
                <input type="text" id="name" name="name"
                    class="w-full px-4 py-2 border border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                    placeholder="Enter Name" value="{{ old('name', $doctor->name ?? '') }}">
            </div>

            <div class="max-w-full mb-4 mx-2">
                <label for="position" class="block text-gray-700 text-sm font-semibold mb-2">Position</label>
                <input type="text" id="position" name="position"
                    class="w-full px-4 py-2 border border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                    placeholder="Enter Position" value="{{ old('position', default: $doctor->position ?? '') }}">
            </div>

            <div class="max-w-full mb-4 mx-2">
                <label for="job-description-1" class="block text-gray-700 text-sm font-semibold mb-2">
                    Job Description (Separate using comma "," — Max 3 bullets only)
                </label>
                <textarea id="job-description-1" name="description" rows="3"
                    class="w-full px-4 py-2 border border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 overflow-auto max-h-36"
                    placeholder="Describe Job Responsibility 1">{{ old('description', $doctor->description ?? '') }}</textarea>

                <p class="text-sm text-red-500 mt-1 hidden" id="description-error">Maximum of 3 commas allowed.</p>
            </div>



            <div class="max-w-full mb-4 mx-2">
                <label for="profile-image-upload" class="block text-gray-700 text-sm font-semibold mb-2">Profile
                    Image</label>
                <input type="file" id="profile-image-upload" name="image"
                    class="w-full px-4 py-2 border border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 file:bg-teal-50 file:border-teal-300 file:px-3 file:py-2 file:rounded-lg"
                    accept="image/*" onchange="previewImageUpload(event)">
            </div>

            <div id="image-drpreview-container" class="mt-4 flex justify-center items-center">
             <div class="text-center">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Image Preview</label>
                <img id="image-drpreview" class="border-2 border-teal-500 rounded-lg" src="{{ $doctor->image ? asset('storage/' . $doctor->image) : '' }}"
                    alt="Image Preview" style="width: 250px; height: 300px; max-width: 100%;" class="rounded-lg shadow-md mx-auto">
            </div>



            </div>

            <!-- Apply Button -->
            <div class="w-full sm:col-span-2 lg:col-span-3 flex justify-end mt-4">
                <button type="submit"
                    class="px-6 mb-2 py-2 bg-teal-500 text-white font-semibold rounded-lg shadow-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-300">
                    Apply
                </button>
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 justify-center items-center gap-6">
        @foreach ($personnel as $person)
            <div class="w-full max-w-md bg-white border-2 border-teal-300 rounded-lg shadow-lg mx-auto">
                <div class="flex flex-col p-2 items-center pb-10 relative">
                    <div
                        class="absolute top-0 left-0 right-0 h-32  bg-gradient-to-r from-teal-400 to-teal-700 rounded-t-lg shadow-md z-0">
                    </div>
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg z-10 bg-teal-300"
                        src="{{ $person->image && Storage::disk('public')->exists($person->image) ? asset('storage/' . $person->image) : asset('images/default-avatar.png') }}"
                        alt="{{ $person->name }} image" />

                    <h5 class="mb-1 mt-6 text-xl font-medium text-gray-900  z-10">{{ $person->name }}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400 z-10">{{ $person->position }}</span>

                    <div class="flex mt-4 gap-2 md:mt-6 z-10">
                        <a href="#" class="bg-blue-500 p-2 px-4 text-white rounded-lg btn-warning" id="EditButton"
                            data-modal-toggle="editTeamModal{{ $person->id }}"
                            data-modal-target="editTeamModal{{ $person->id }}">
                            Edit
                        </a>
                        <a href="#" class="bg-red-500 p-2 px-4 text-white rounded-lg btn-warning" id="CloseButton"
                            data-modal-toggle="closeModal{{ $person->id }}" data-modal-target="closeModal{{ $person->id }}">
                            Close
                        </a>
                    </div>
                </div>
            </div>
            <x-personnel-modal :id="$person->id" :person="$person" />
        @endforeach
    </div>


    <script>
        function previewImageUpload(event) {
            const drfile = event.target.files[0];
            const drpreviewContainer = document.getElementById('image-drpreview-container');
            const drimagePreview = document.getElementById('image-drpreview');

            if (drfile) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    drimagePreview.src = e.target.result;
                    drpreviewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(drfile);
            } else {
                drpreviewContainer.classList.add('hidden');
            }
        }

        function toggleDropdown() {
            const dropdownContent = document.getElementById("dropdown-content");
            const arrowIcon = document.getElementById("arrow-icon");

            // Toggle dropdown visibility
            dropdownContent.classList.toggle("hidden");
            dropdownContent.classList.toggle("max-h-[1000px]");
            dropdownContent.classList.toggle("opacity-100");

            if (dropdownContent.classList.contains("hidden")) {
                arrowIcon.classList.remove("fa-arrow-up");
                arrowIcon.classList.add("fa-arrow-down");
            } else {
                arrowIcon.classList.remove("fa-arrow-down");
                arrowIcon.classList.add("fa-arrow-up");
            }
        }

        const textarea = document.getElementById('job-description-1');
        const errorText = document.getElementById('description-error');

        textarea.addEventListener('input', function () {
            const value = this.value;
            const commaCount = (value.match(/,/g) || []).length;
            if (commaCount >= 3) {
                errorText.classList.remove('hidden');
                this.value = value.slice(0, value.lastIndexOf(','));
            } else {
                errorText.classList.add('hidden');
            }
        });
    </script>
</x-sidebar-layout>
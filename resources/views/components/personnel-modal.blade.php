@props(['id' => null, 'person' => null])

<!-- Modal Structure -->
<div id="{{ $id ? 'editTeamModal' . $person->id : 'addTeamModal' }}"
    class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center z-50 backdrop-blur-sm modal-transform scale-70o ">
    <div class="bg-gradient-to-r from-teal-400 to-teal-500 w-full max-w-2xl rounded-lg shadow-lg ">
        <div class="flex justify-between p-2 px-4 items-center mb-4">
            <div class="flex gap-4 items-center mt-2">
                <i class="fa-solid fa-user text-white fa-2x"></i>
                <h5 class="text-2xl text-white font-semibold">
                    {{ $id ? 'Edit ' . $person->name : 'Add Personnel' }}
                </h5>
            </div>
            <button type="button" data-modal-hide="{{ $id ? 'editTeamModal' . $person->id : 'addTeamModal' }}"
                class="px-4 py-2 font-bold rounded-lg hover:bg-teal-600 transition-all duration-300 bg-red-500 text-white rounded">
                X
            </button>
        </div>

        <!-- Form -->
        <form action="{{ $id ? route('admin.updatepersonnel', ['id' => $person->id]) : route('admin.storepersonnel') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if ($id)
                @method('PUT')
            @endif
            <div class="grid bg-white p-6 grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-md">Name</label>
                    <input type="text" name="name" value="{{ $id ? $person->name : '' }}"
                        class="w-full border bg-teal-50 p-2 rounded">
                </div>
                <div>
                    <label class="block text-md">Position</label>
                    <input type="text" name="position" value="{{ $id ? $person->position : '' }}"
                        class="w-full border bg-teal-50 p-2 rounded">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-md">Description</label>
                    <textarea name="description" class="w-full border bg-teal-50 p-2 rounded"
                        rows="3">{{ $id ? $person->description : '' }}</textarea>
                </div>
                <div>
                    <label class="block text-md">Facebook</label>
                    <input type="text" name="facebook" value="{{ $id ? $person->facebook : '' }}"
                        class="w-full border p-2  bg-teal-50 rounded">
                </div>
                <div>
                    <label class="block text-md">Twitter</label>
                    <input type="text" name="twitter" value="{{ $id ? $person->twitter : '' }}"
                        class="w-full border bg-teal-50 p-2 rounded">
                </div>
                <div>
                    <label class="block text-md">Instagram</label>
                    <input type="text" name="instagram" value="{{ $id ? $person->instagram : '' }}"
                        class="w-full border p-2 bg-teal-50 rounded">
                </div>
                <div class="flex justify-center flex-col md:col-span-2">
                    <label class="block text-md">Profile Image</label>
                    <input type="file" name="image" class="w-full border bg-teal-50 p-2 rounded" id="drimageInput">

                    <div class="flex justify-center mt-4">
                        <img id="drpreviewImage"
                            src="{{ $id && !empty($person->image) && Storage::disk('public')->exists($person->image) ? asset('storage/' . $person->image) : asset('images/default-avatar.png') }}"
                            class="mt-4 justify-center bg-teal-200 border-teal-500 border-2 p-2 rounded h-28">
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const drimageInput = document.getElementById('drimageInput');
                            const drpreviewImage = document.getElementById('drpreviewImage');
                            if (drimageInput && drpreviewImage) {
                                drimageInput.addEventListener('change', function (e) {
                                    const drfile = e.target.files[0]; 
                                    if (drfile) {
                                        const reader = new FileReader();
                                        reader.onload = function (e) {
                                            drpreviewImage.src = e.target.result;
                                        };
                                        reader.readAsDataURL(drfile);
                                    }
                                });
                            }
                        });
                    </script>

                </div>
            </div>

            <div class="flex justify-end p-2 bg-slate-100">
                <button type="button" data-modal-hide="{{ $id ? 'editTeamModal' . $person->id : 'addTeamModal' }}"
                    class="px-4 py-2 bg-gray-300 hover:bg-red-500 hover:text-white duration-300 text-gray-700 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-teal-600 duration-300 text-white rounded">
                    {{ $id ? 'Save Changes' : 'Add Personnel' }}
                </button>
            </div>
        </form>
    </div>
</div>


@if ($person)
    <div id="{{'closeModal' . $person->id}}"
        class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center z-50 backdrop-blur-sm modal-transform">
        <form action="{{ route('admin.deletepersonnel', ['id' => $person->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="bg-gradient-to-r from-red-400 to-red-500 w-full max-w-md rounded-lg shadow-lg">
                <div class="flex justify-between p-2 px-4 items-center mb-4">
                    <div class="flex gap-4 items-center mt-2">
                        <i class="fa-solid fa-times-circle text-white fa-2x"></i>
                        <h5 class="text-2xl text-white font-semibold">
                            Close Modal
                        </h5>
                    </div>
                    <button type="button" data-modal-hide="{{ $id ? 'closeModal' . $person->id : 'closeModal' }}"
                        class="px-4 py-2 font-bold rounded-lg hover:bg-red-600 transition-all duration-300 bg-red-500 text-white rounded">
                        X
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6 bg-white">
                    <p class="text-black text-md">Are you sure you want to delete this record?</p>
                </div>

                <div class="flex justify-end p-2 bg-white rounded-b-lg">
                    <button type="button" data-modal-hide="{{ $id ? 'closeModal' . $person->id : 'closeModal' }}"
                        class="px-4 py-2 bg-gray-300 hover:bg-red-500 hover:text-white duration-300 text-gray-700 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" data-modal-hide="{{ $id ? 'closeModal' . $person->id : 'closeModal' }}"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 duration-300 text-white rounded">
                        Delete Record
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif
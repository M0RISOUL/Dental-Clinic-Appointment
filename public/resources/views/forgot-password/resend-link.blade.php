<x-alert-layout>
    <div class="w-full max-w-md mx-auto px-8 py-6 border-2 border-blue-500 rounded-lg shadow-lg bg-white flex flex-col items-center text-center space-y-6">
        <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain mb-2" alt="Notice">

        <h2 class="text-2xl text-blue-500 font-bold">Password Reset Link has already been sent</h2>
        <p class="text-sm text-gray-700">Do you want to resend it? Click the send button.</p>

        <div class="flex flex-row gap-4">
            <a href="{{ route('login') }}"
               class="px-6 py-2 text-white bg-gray-500 rounded-lg shadow hover:bg-gray-600 transition duration-300 text-center">
                Cancel
            </a>

            <form action="{{ route('resend-password-reset-link') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type="submit"
                        class="px-6 py-2 text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                    Send
                </button>
            </form>
        </div>
    </div>
</x-alert-layout>

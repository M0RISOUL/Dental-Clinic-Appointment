<x-alert-layout>
    <div class="max-w-xl mx-auto w-full p-8 rounded-lg shadow-lg bg-white flex flex-col overflow-hidden">
        <div class="flex flex-col items-center mb-6">
            <h2 class="text-2xl text-gray-700 font-bold self-start mb-6">Hello {{ $user->firstname }}!</h2>
            <p class="text-gray-500 self-start">
                Your appointment has been successfully booked at Ana Fatima Barroso Dental Clinic.
            </p>
        </div>

        <div class="text-gray-700 mb-6">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</p>
            <p><strong>Reason:</strong> {{ $appointment->appointments }}</p>
        </div>

        <p class="text-gray-500 self-start mb-6">
            Please arrive at least 15 minutes before your scheduled time. If you need to cancel or reschedule, contact us in advance.
        </p>

        <p class="text-gray-500 self-start">Regards,</p>
        <p class="text-gray-500 self-start">Ana Fatima Barroso Dental Clinic</p>
    </div>
</x-alert-layout>

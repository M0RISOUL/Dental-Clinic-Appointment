<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminPatientRecordsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageAppointmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReceiptController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\PatientRecordsExportController;
use App\Http\Middleware\PreventUpdateOnSentMessages;
use App\Mail\ForgotPassword;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;


// Test route
Route::get('/test', function () {
});

// AUDIT TRAIL FOR ADMIN
Route::get('/admin/log-history', [AuditTrailController::class, 'index'])->name('admin.log-history');

// VIEW CUSTOMER GCASH PAYMENTS
Route::get('/admin/view-payments', [PaymentController::class, 'viewPayments']);

// PATIENT GCASH PAYMENT
Route::get('/patient/gcash-payment', [PaymentController::class, 'index']);
Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');

// RECEIPT VIEWER FOR PATIENT (ADD DOWNLOAD PDF)
Route::get('/receipts/{id}', [ReceiptController::class, 'show'])->name('receipt.show');


Route::middleware(['guest', 'preventBackHistory'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/doctor', [HomeController::class, 'doctor'])->name('doctor');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    // Route::get('/service', [HomeController::class, 'service'])->name('service');
    Route::get('/services', [HomeController::class, 'services'])->name('services');
    Route::get('/careers', [HomeController::class, 'careers'])->name('careers');

    Route::post('/jobs/filter', [HomeController::class, 'filter'])->name('jobs.filter');
    Route::get('/jobs/filter', [HomeController::class, 'filter'])->name('jobs.filterget');
    
    Route::post('/jobs/apply/{Id}', [HomeController::class, 'applyjob'])->name('jobs.jobapply');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::post('/jobs/filter', [HomeController::class, 'filter'])->name(name: 'jobs.filter');
});



Route::middleware(['auth', 'verified', 'preventBackHistory'])->group(function () {
    // FOR PATIENT USERS
    Route::middleware(['patientMiddleware'])->group(function () {
        Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');
        Route::get('/patient/calendar', [PatientController::class, 'calendar'])->name('calendar');
        Route::get('/patient/notifications', [PatientController::class, 'notifications'])->name('notifications');
        Route::get('/patient/history', [PatientController::class, 'history'])->name('history');
        Route::get('/view-history/{appointmentId}', [PatientController::class, 'viewHistory'])->name('viewhistory');

        Route::put('/patient/appointments/update/{id}', [PatientController::class, 'updateAppointment'])->name('appointments.update');
        Route::put('/patient/appointments/cancel/{id}', [PatientController::class, 'cancelAppointment'])->name('appointments.cancel');
        Route::get('/patient/profile', [LoginController::class, 'profile'])->name('profile');
        Route::put('/patient/users/{id}', [LoginController::class, 'update'])->name('profile.update');

        Route::get('/patient/pricing', [PatientController::class, 'pricing'])->name('pricing');



        // REDIRECT TO BOOK APPOINTMENT
        Route::get('/patient/bookappointment/{id}', [PatientController::class, 'bookappointment'])
            ->name('patient.bookappointment');



        Route::get('/api/upcoming-appointment', [PatientController::class, 'getUpcomingAppointment']);



        // FOR FETCHING APPOINTMENTS
        Route::get('/appointments/{date}', action: [PatientController::class, 'fetchAppointments']);


        Route::post('/close-audit-modal', function (Request $request) {
            session()->forget('audit_modal_open');
            return response()->json(['message' => 'Audit modal session closed']);
        })->name('close.audit.modal');

        Route::post('/appointments/{id}/review', [PatientController::class, 'storeReview'])->name('appointments.review');

        Route::post('/hide-modal', function () {
            session(['hide_modal' => true]); // Store session to hide modal
            return redirect()->back();
        })->name('hide.modal');

    });


    // Route::get('/patient/messaging', [PatientController::class, 'messages'])->name('messages');

    //FOR GETTING MESSAGES
    Route::get('/user/messaging', [MessageController::class, 'getMessages'])->name('messages');

    //FOR GETTING REPLIES
    Route::get('/user/messages/{messageId}/replies', [MessageController::class, 'getReplies'])->name('messages.replies');

    //FOR POSTING A MESSAGE
    Route::post('/user/messages/messages', [MessageController::class, 'postMessage'])->name('messages.create.post');

    //FOR POSTING A REPLY
    Route::post('/user/messages/{messageId}/replies', [MessageController::class, 'postReply'])->name('messages.replies.post');

    // FOR UPDATING THE READ_AT
    Route::post('/update-seen-status/{id}', [MessageController::class, 'updateSeenStatus']);


    // FOR APPOINTMENT
    Route::get('/patient/appointment', function () {
        return view('patient.appointment');
    })->name('appointment');

    // FOR NOTIFICATIONS
    Route::get('/appointment/update/{id}', [AppointmentController::class, 'markAsRead'])
        ->name('appointment.markAsRead');

    // FOR STORING APPOINTMENTS
    Route::post('/patient/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');

    // FOR ADMIN USERS
    Route::middleware(['adminMiddleware'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
        Route::get('/admin/graph', [AppointmentController::class, 'graph'])->name('admin.graph');
        Route::get('/admin/approved_appointments', [AdminController::class, 'approvedAppointments'])->name('admin.approved_appointments');
        
        //Manage Jobs Routes
        Route::get('/admin/manage_jobs', [AdminController::class, 'jobs'])->name('admin.manage_jobs');
        Route::get('/admin/personnel', [AdminController::class, 'personnel'])->name('admin.personnel');
        
        Route::put('/admin/personnel/update/{id}', [AdminController::class, 'updatepersonnel'])->name('admin.updatepersonnel');
        Route::post('/admin/personnel/store', [AdminController::class, 'storepersonnel'])->name('admin.storepersonnel');
        Route::post('/admin/personnel/{id}/delete', [AdminController::class, 'deletepersonnel'])->name('admin.deletepersonnel');

        //Career Jobs
        // Route for editing a job (PUT request)
        Route::put('/admin/job/update/{id}', [AdminController::class, 'updatejob'])->name('admin.updatejob');
        // Route for adding a new job (POST request)
        Route::post('/admin/job/store', [AdminController::class, 'storejob'])->name('admin.storejob');
        // Route for deleting a job (POST request)
        Route::post('/admin/job/{id}/delete', [AdminController::class, 'deletejob'])->name('admin.deletejob');

        //HIRE APPLICANT 
        Route::put('/admin/job/hire/{id}', [AdminController::class, 'hire'])->name('admin.hire');

        
        // Clinic Announcement Routes
        Route::get('/announcements/active', [App\Http\Controllers\ClinicAnnouncementController::class, 'getActive']);
        Route::get('/announcements', [App\Http\Controllers\ClinicAnnouncementController::class, 'index']);
        Route::post('/announcements', [App\Http\Controllers\ClinicAnnouncementController::class, 'store']);
        Route::get('/announcements/{announcement}', [App\Http\Controllers\ClinicAnnouncementController::class, 'show']);
        Route::put('/announcements/{announcement}', [App\Http\Controllers\ClinicAnnouncementController::class, 'update']);
        Route::delete('/announcements/{announcement}', [App\Http\Controllers\ClinicAnnouncementController::class, 'destroy']);

        // User Management Routes
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store'); // IMPORTANT: Change to UserController
        Route::get('/admin/users/{user}', [UserController::class, 'getUser'])->name('admin.users.get'); // IMPORTANT: Change to UserController
        Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update'); // IMPORTANT: Change to UserController
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy'); // IMPORTANT: Change to UserController

        // Legacy route - keep for backward compatibility
        Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/admin/manage_appointments', [ManageAppointmentController::class, 'index'])->name('appointments.index');
        Route::post('/admin/appointments/action', [ManageAppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');

        // Enhanced calendar routes
        Route::get('/admin/calendar', [AdminAppointmentController::class, 'calendar'])->name('admin.calendar');
        Route::get('/admin/calendar/appointments', [AdminAppointmentController::class, 'getCalendarAppointments'])->name('admin.calendar.appointments');

        // Appointment Slots Management Routes - specific routes first, then parameterized routes
        Route::get('/admin/appointments/create', [AdminAppointmentController::class, 'create'])->name('admin.appointments.create');
        Route::get('/admin/appointments/slots', [AdminAppointmentController::class, 'getAvailableSlots'])->name('admin.appointments.slots');
        Route::post('/admin/appointments', [AdminAppointmentController::class, 'store'])->name('admin.appointments.store');
        Route::delete('/admin/appointments/{id}', [AdminAppointmentController::class, 'delete'])->name('admin.appointments.delete');

        // appointment routes
        Route::get('/admin/appointments/{id}/edit', [AdminAppointmentController::class, 'edit'])->name('admin.appointments.edit');
        Route::put('/admin/appointments/{id}', [AdminAppointmentController::class, 'update'])->name('admin.appointments.update');
        Route::get('/admin/appointments/available-slots', [AdminAppointmentController::class, 'getAvailableSlots'])->name('admin.appointments.available-slots');

        // General appointments route
        Route::get('/admin/appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
        
        Route::get('/admin/settings/contact', [App\Http\Controllers\Admin\SettingsController::class, 'contactSettings'])->name('admin.settings.contact');
        Route::post('/admin/settings/contact', [App\Http\Controllers\Admin\SettingsController::class, 'updateContactSettings'])->name('admin.settings.update-contact');
        Route::get('/admin/settings/services', [App\Http\Controllers\Admin\SettingsController::class, 'servicesSettings'])->name('admin.settings.services');
        Route::post('/admin/settings/services', [App\Http\Controllers\Admin\SettingsController::class, 'updateServicesSettings'])->name('admin.settings.update-services');
        // Pricing settings
        Route::get('/settings/pricing', [App\Http\Controllers\Admin\SettingsController::class, 'pricingSettings'])->name('admin.settings.pricing');
        Route::post('/settings/pricing', [App\Http\Controllers\Admin\SettingsController::class, 'updatePricingSettings'])->name('admin.settings.pricing.update');    // About page settings
        // About page settings
        Route::get('/admin/settings/about', [App\Http\Controllers\Admin\SettingsController::class, 'aboutSettings'])
            ->name('admin.settings.about');
        Route::post('/admin/settings/about', [App\Http\Controllers\Admin\SettingsController::class, 'updateAboutSettings'])
            ->name('admin.settings.about.update');
        // Inventory Management Routes
        Route::get('/admin/inventory', [InventoryController::class, 'index'])->name('admin.inventory');
        Route::get('/admin/inventory/create', [InventoryController::class, 'create'])->name('admin.inventory.create');
        Route::post('/admin/inventory', [InventoryController::class, 'store'])->name('admin.inventory.store');
        Route::get('/admin/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('admin.inventory.edit');
        Route::put('/admin/inventory/{id}', [InventoryController::class, 'update'])->name('admin.inventory.update');
        Route::delete('/admin/inventory/{id}', [InventoryController::class, 'destroy'])->name('admin.inventory.destroy');
        Route::post('/admin/inventory/{id}/adjust', [InventoryController::class, 'adjustQuantity'])->name('admin.inventory.adjust');
        Route::post('/admin/inventory/order-critical', [InventoryController::class, 'orderCriticalItem'])->name('admin.inventory.order-critical');
        Route::put('/admin/inventory/categories/{category}', [InventoryController::class, 'updateCategory'])->name('admin.inventory.categories.update');

        // Jez
        Route::post('/admin/inventory/record-usage', [InventoryController::class, 'recordUsage'])->name('admin.inventory.record-usage');

        // Category Management Routes - UPDATED
        Route::post('/admin/inventory/categories', [InventoryController::class, 'storeCategory'])->name('admin.inventory.categories.store');
        Route::delete('/admin/inventory/categories/{category}', [InventoryController::class, 'destroyCategory'])->name('admin.inventory.categories.destroy');
        Route::put('/admin/inventory/categories/{category}', [InventoryController::class, 'updateCategory'])->name('admin.inventory.categories.update');

        // JEZ
        Route::get('/admin/graphs/inventory', [\App\Http\Controllers\Admin\GraphController::class, 'inventoryGraphs'])->name('admin.graphs.inventory');
        Route::get('/admin/graphs/inventory/pdf', [\App\Http\Controllers\Admin\GraphController::class, 'generatePDF'])->name('admin.graphs.inventory.pdf');
        Route::get('/admin/graphs/inventory/quantity/pdf', [\App\Http\Controllers\Admin\GraphController::class, 'generateQuantityPDF'])->name('admin.graphs.inventory.quantity.pdf');
        Route::get('/admin/graphs/inventory/category/pdf', [\App\Http\Controllers\Admin\GraphController::class, 'generateCategoryPDF'])->name('admin.graphs.inventory.category.pdf');

        // User Registration Analytics
        Route::get('/admin/graphs/users', [\App\Http\Controllers\Admin\GraphController::class, 'userGraphs'])->name('admin.graphs.users');
        Route::get('/admin/graphs/users/pdf', [\App\Http\Controllers\Admin\GraphController::class, 'userGraphsPdf'])->name('admin.graphs.users.pdf');

        //Sentiment
        Route::get('/admin/sentiment', [\App\Http\Controllers\SentimentController::class, 'index'])->name('admin.sentiment');
        Route::put('/admin/sentiment/{id}/reanalyze', [\App\Http\Controllers\SentimentController::class, 'reanalyze'])->name('admin.sentiment.reanalyze');

        // Appointment Analytics
        Route::get('/admin/graphs/appointments', [\App\Http\Controllers\Admin\GraphController::class, 'appointmentGraphs'])->name('admin.graphs.appointments');
        Route::get('/admin/graphs/appointments/pdf', [\App\Http\Controllers\Admin\GraphController::class, 'appointmentGraphsPdf'])->name('admin.graphs.appointments.pdf');

        // Appointment Reports
        Route::prefix('admin/reports')->name('admin.reports.')->middleware(['auth'])->group(function () {
            Route::get('/status-during-period', [App\Http\Controllers\Admin\AppointmentReportController::class, 'statusDuringPeriod'])->name('status_during_period');
            Route::get('/status-during-period/pdf', [App\Http\Controllers\Admin\AppointmentReportController::class, 'exportPdf'])->name('status_during_period.pdf');
        });

        //FOR RESCHEDULING APPOINTMENTD
        Route::get('/admin/appointments/slots', [ManageAppointmentController::class, 'getAvailableSlots'])
            ->name('admin.appointments.slots');

        Route::get('/get-available-slots', [ManageAppointmentController::class, 'getAvailableSlots']);

        //PATIENT RECORDS
        Route::get('/admin/patient-records', [AdminPatientRecordsController::class, 'index'])->name('admin.patient-records');
        Route::get('/admin/patient-records/{id}', [AdminPatientRecordsController::class, 'show'])->name('admin.patient-records.show');
    });
});


// FOR REGISTER
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// FOR LOGOUT
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// FORGOT PASSWORD
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password-post', [ForgotPasswordController::class, 'forgotPasswordPost'])->name('forgot-password-post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset-password-post');
Route::post('/resend-password-reset-link', [ForgotPasswordController::class, 'resendPasswordResetLink'])->name('resend-password-reset-link');

// EMAIL VERIFICATION
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    switch ($request->user()->user_type) {
        case 'admin':
        case 'staff':
            return redirect()->route('admin.dashboard')->with('success', 'Your email has been successfully verified.');
        case 'patient':
            return redirect()->route('patient.dashboard')->with('success', 'Your email has been successfully verified.');
        default:
            return redirect()->route('patient.dashboard')->with('success', 'Your email has been successfully verified.');
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    Auth::user()->sendEmailVerificationNotification();
    return redirect('/email/verify')->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// APPOINTMENTS
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/admin/appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');


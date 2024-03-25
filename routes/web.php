<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;

// ADMIN
use App\Http\Controllers\Admin\Patient\ManagePatient;
use App\Http\Controllers\Admin\Patient\ViewProfile;
use App\Http\Controllers\Admin\Patient\UpdatePatient;
use App\Http\Controllers\Admin\Patient\SessionProgress;
use App\Http\Controllers\Admin\Appointments\AppointmentCalendar;
use App\Http\Controllers\Admin\Appointments\AddAppointment;
use App\Http\Controllers\Admin\Appointments\ManageAppointments;
use App\Http\Controllers\Admin\Appointments\ViewAppointments;
use App\Http\Controllers\Admin\Billing\Billing;
use App\Http\Controllers\Admin\Transactions\Transactions;
use App\Http\Controllers\Admin\Inventory\ManageInventory;
use App\Http\Controllers\Admin\Settings\Products\ManageProducts;
use App\Http\Controllers\Admin\Settings\Products\ManageCategory;
use App\Http\Controllers\Admin\Settings\Products\ManageProductTable;
use App\Http\Controllers\Admin\Settings\Services\ManageServices;
use App\Http\Controllers\Admin\Settings\Services\ManageCategoryServices;
use App\Http\Controllers\Admin\Settings\Services\ManageServicesTable;
use App\Http\Controllers\Admin\Settings\ConfigurePage\Contents;
use App\Http\Controllers\Admin\Settings\ConfigurePage\FeatureProducts;
use App\Http\Controllers\Admin\Settings\ConfigurePage\HighlighContent;
use App\Http\Controllers\Admin\Settings\ConfigurePage\Dermatologist;
use App\Http\Controllers\Admin\Settings\ConfigurePage\AboutUs;
use App\Http\Controllers\Admin\Settings\ConfigurePage\Testimonials;
use App\Http\Controllers\Admin\Settings\ConfigurePage\ClinicDetails;
use App\Http\Controllers\Admin\Settings\ConfigurePage\Banner;
use App\Http\Controllers\Admin\Settings\Accounts\UserAccounts;
use App\Http\Controllers\Admin\Settings\Accounts\Patient;
use App\Http\Controllers\Admin\Settings\Accounts\Staff;
use App\Http\Controllers\Admin\Settings\Accounts\Doctors;
use App\Http\Controllers\Admin\Settings\Accounts\Admin;
use App\Http\Controllers\Admin\Settings\Promotions\ManagePromotions;
use App\Http\Controllers\Admin\Patient\MedicalRecord;
use App\Http\Controllers\Admin\Patient\ViewMedicalRecord;
use App\Http\Controllers\Admin\AuditTrail\AuditTrail;
use App\Http\Controllers\Admin\Settings\Accounts\ViewAccount as ViewAccounts;
use App\Http\Controllers\Admin\Settings\Accounts\ViewDoctor;
use App\Http\Controllers\Admin\Settings\Schedule\ManageSchedule;
use App\Http\Controllers\Admin\Reports\Sales;
use App\Http\Controllers\Admin\Reports\Products;
use App\Http\Controllers\Admin\Reports\Services;
use App\Http\Controllers\Admin\Reports\Inventory;
use App\Http\Controllers\Admin\LandingPage\Services as ServicesOffered;

// PATIENT
use App\Http\Controllers\Patient\MyAppointments\Appointments;
use App\Http\Controllers\Patient\MyAppointments\AddAppointments;
use App\Http\Controllers\Patient\Services\ServiceList;
use App\Http\Controllers\Patient\Settings\Menu;
use App\Http\Controllers\Patient\Settings\AccountSettings;
use App\Http\Controllers\Patient\Settings\ViewAccount;

//STAFF
use App\Http\Controllers\Staff\Patient\ManagePatient as StaffManagePatient;
use App\Http\Controllers\Staff\Patient\AddPatient as StaffAddPatient;
use App\Http\Controllers\Staff\Patient\ViewPatient as StaffViewPatient;
use App\Http\Controllers\Staff\Patient\ViewMedicalRecords as StaffViewMedicalRecords;
use App\Http\Controllers\Staff\Patient\AddMedicalRecord as StaffAddMedicalRecord;
use App\Http\Controllers\Staff\Patient\UpdatePatient as StaffUpdatePatient;
use App\Http\Controllers\Staff\Patient\SessionProgress as StaffSessionProgress;
use App\Http\Controllers\Staff\Appointments\ManageAppointments as StaffManageAppointments;
use App\Http\Controllers\Staff\Appointments\AppointmentCalendar as StaffAppointmentCalendar;
use App\Http\Controllers\Staff\Appointments\ViewAppointments as StaffViewAppointments;
use App\Http\Controllers\Staff\Appointments\AddAppointments as StaffAddAppointments;
use App\Http\Controllers\Staff\Settings\Accounts\UserAccounts as StaffUserAccounts;
use App\Http\Controllers\Staff\Settings\Accounts\Patient as StaffPatient;
use App\Http\Controllers\Staff\Settings\Accounts\Staff as StaffStaff;
use App\Http\Controllers\Staff\Inventory\Inventory as StaffInventory;
use App\Http\Controllers\Staff\Transactions\Transactions as StaffTransactions;
use App\Http\Controllers\Staff\Billing\Billing as StaffBilling;
use App\Http\Controllers\Staff\Dashboard\UpcomingAppointments;
use App\Livewire\Admin\Appointments\ViewAppointments as AppointmentsViewAppointments;

// DOCTOR
use App\Http\Controllers\Doctor\Patient\ManagePatients as DoctorManagePatient;
use App\Http\Controllers\Doctor\Patient\AddPatient as DoctorAddPatient;
use App\Http\Controllers\Doctor\Patient\UpdatePatient as DoctorUpdatePatient;
use App\Http\Controllers\Doctor\Patient\ViewPatient as DoctorViewPatient;
use App\Http\Controllers\Doctor\Patient\SessionProgress as DoctorSessionProgress;
use App\Http\Controllers\Doctor\Patient\AddMedicalRecord as DoctorAddMedicalRecord;
use App\Http\Controllers\Doctor\Patient\ViewMedicalRecord as DoctorViewMedicalRecord;
use App\Http\Controllers\Doctor\Appointments\AppointmentCalendar as DoctorAppointmentCalendar;
use App\Http\Controllers\Doctor\Appointments\ManageAppointments as DoctorManageAppointments;
use App\Http\Controllers\Doctor\Appointments\ViewAppointments as DoctorViewAppointments;
use App\Http\Controllers\Doctor\Appointments\AddAppointments as DoctorAddAppointments;
use App\Http\Controllers\Doctor\Prescription\GeneratePrescription as DoctorGeneratePrescription;
use App\Http\Controllers\Doctor\Billing\Billing as DoctorBilling;
use App\Http\Controllers\Doctor\Transactions\Transactions as DoctorTransactions;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Landing Pge
Route::get('services-offered', [ServicesOffered::class, 'index'])->name('services-offered');

// ROUTES FOR AUTHENTICATED USERS ONLY
Route::middleware(['auth', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/home', [AuthController::class, 'index'])->name('dashboard');
    // Route::get('/home', [AuthController::class, 'upcomingAppointments'])->name('dashboard');
    Route::get('/admin/dashboard', [AuthController::class, 'AdminDashboard'])->name('admin-dashboard')->middleware('role:1');
    Route::get('/patient/dashboard', [AuthController::class, 'PatientDashboard'])->name('patient-dashboard')->middleware('role:0');

        // ADMIN ROUTES
        Route::group(['middleware' => 'role:1', 'prefix' => 'admin'], function() {
            
            Route::get('manage-patient', [ManagePatient::class, 'index'])->name('manage-patients');
            Route::get('view-profile', [ViewProfile::class, 'index'])->name('view-profile');
            Route::get('update-profile', [UpdatePatient::class, 'index'])->name('update-profile');
            Route::get('add-patient', [ManagePatient::class, 'addPatient'])->name('add-patient');
            Route::get('session-progress', [SessionProgress::class, 'index'])->name('session-progress');
            Route::get('manage-inventory', [ManageInventory::class, 'index'])->name('manage-inventory');
            Route::get('manage-products', [ManageProducts::class, 'index'])->name('manage-products');
            Route::get('manage-category', [ManageCategory::class, 'index'])->name('manage-category');
            Route::get('manage-services', [ManageServices::class, 'index'])->name('manage-services');
            Route::get('manage-service-categories', [ManageCategoryServices::class, 'index'])->name('manage-service-categories');
            Route::get('manage-service-table', [ManageServicesTable::class, 'index'])->name('manage-service-table');
            Route::get('manage-product-table', [ManageProductTable::class, 'index'])->name('manage-product-table');
            Route::get('appointment-calendar', [AppointmentCalendar::class, 'index'])->name('appointment-calendar');
            Route::get('manage-appointments', [ManageAppointments::class, 'index'])->name('manage-appointments');
            Route::get('view-appointments', [ViewAppointments::class, 'index'])->name('view-appointments');
            Route::get('add-appointments', [AddAppointment::class, 'index'])->name('add-appointment');
            Route::get('contents', [Contents::class, 'index'])->name('contents');
            Route::get('featured-products', [FeatureProducts::class, 'index'])->name('featured-products');
            Route::get('highlight-content', [HighlighContent::class, 'index'])->name('highlight-content');
            Route::get('dermatologist', [Dermatologist::class, 'index'])->name('dermatologist');
            Route::get('about-us', [AboutUs::class, 'index'])->name('about-us');
            Route::get('testimonials', [Testimonials::class, 'index'])->name('testimonials');
            Route::get('clinic-details', [ClinicDetails::class, 'index'])->name('clinic-details');
            Route::get('banner', [Banner::class, 'index'])->name('banner');
            Route::get('user-accounts', [UserAccounts::class, 'index'])->name('user-accounts');
            Route::get('patient-accounts', [Patient::class, 'index'])->name('patient-accounts');
            Route::get('staff-accounts', [Staff::class, 'index'])->name('staff-accounts');
            Route::get('doctor-accounts', [Doctors::class, 'index'])->name('doctor-accounts');
            Route::get('admin-accounts', [Admin::class, 'index'])->name('admin-accounts');
            Route::get('view-staff', [ViewAccounts::class, 'index'])->name('view-staff');
            Route::get('view-doctor', [ViewDoctor::class, 'index'])->name('view-doctor');
            Route::get('manage-schedule', [ManageSchedule::class, 'index'])->name('manage-schedule');
            Route::get('billing', [Billing::class, 'index'])->name('billing');
            Route::get('transactions', [Transactions::class, 'index'])->name('transactions');
            Route::get('medical-record', [MedicalRecord::class, 'index'])->name('medical-record');
            Route::get('view-medical-record', [ViewMedicalRecord::class, 'index'])->name('view-medical-record');
            Route::get('manage-promotions', [ManagePromotions::class, 'index'])->name('manage-promotions');
            Route::get('audit-trail', [AuditTrail::class, 'index'])->name('audit-trail');
            Route::get('sales-report', [Sales::class, 'index'])->name('sales-report');
            Route::get('products-report', [Products::class, 'index'])->name('products-report');
            Route::get('services-report', [Services::class, 'index'])->name('services-report');
            Route::get('inventory-report', [Inventory::class, 'index'])->name('inventory-report');

        })->name('admin-routes');

        // PATIENT ROUTES
        Route::group(['middleware' => 'role:0', 'prefix' => 'patient'], function() {
            
            Route::get('appointmetns', [Appointments::class, 'index'])->name('appointments');
            Route::get('add-appointments', [AddAppointments::class, 'index'])->name('patient-add-appointment');
            Route::get('services', [ServiceList::class, 'index'])->name('services');
            Route::get('settings', [Menu::class, 'index'])->name('settings');
            Route::get('account-settings', [AccountSettings::class, 'index'])->name('account-settings');
            Route::get('view-account', [ViewAccount::class, 'index'])->name('view-account');

        })->name('patient-routes'); 

        // STAFF ROUTES
        Route::group(['middleware' => 'role:2', 'prefix' => 'staff'], function() {

            Route::get('manage-patients', [StaffManagePatient::class, 'index'])->name('staff-manage-patients');
            Route::get('add-patient', [StaffAddPatient::class, 'index'])->name('staff-add-patient');
            Route::get('view-patient', [StaffViewPatient::class, 'index'])->name('staff-view-profile');
            Route::get('update-patient', [StaffUpdatePatient::class, 'index'])->name('staff-update-profile');
            Route::get('session-progress', [StaffSessionProgress::class, 'index'])->name('staff-session-progress');
            Route::get('manage-appointments', [StaffAppointmentCalendar::class, 'index'])->name('staff-manage-appointments');
            Route::get('appointments-calendar', [StaffManageAppointments::class, 'index'])->name('staff-appointment-calendar');
            Route::get('view-appointments', [StaffViewAppointments::class, 'index'])->name('staff-view-appointments');
            Route::get('add-appointments', [StaffAddAppointments::class, 'index'])->name('staff-add-appointment');
            Route::get('user-accounts', [StaffUserAccounts::class, 'index'])->name('staff-user-accounts');
            Route::get('patient-accounts', [StaffPatient::class, 'index'])->name('staff-patient-accounts');
            Route::get('staff-accounts', [StaffStaff::class, 'index'])->name('staff-staff-accounts');
            Route::get('inventory', [StaffInventory::class, 'index'])->name('staff-inventory');
            Route::get('transactions', [StaffTransactions::class, 'index'])->name('staff-transactions');
            Route::get('billing', [StaffBilling::class, 'index'])->name('staff-billing');
            Route::get('view-medical-records', [StaffViewMedicalRecords::class, 'index'])->name('staff-view-medical-records');
            Route::get('add-medical-records', [StaffAddMedicalRecord::class, 'index'])->name('staff-add-medical-record');

        })->name('staff-routes'); 

        // DOCTOR ROUTES
        Route::group(['middleware' => 'role:3', 'prefix' => 'doctor'], function() {
            
            Route::get('manage-patients', [DoctorManagePatient::class, 'index'])->name('doctor-manage-patients');
            Route::get('add-patients', [DoctorAddPatient::class, 'index'])->name('doctor-add-patients');
            Route::get('update-profile', [DoctorUpdatePatient::class, 'index'])->name('doctor-update-profile');
            Route::get('view-patient', [DoctorViewPatient::class, 'index'])->name('doctor-view-profile');
            Route::get('session-progress', [DoctorSessionProgress::class, 'index'])->name('doctor-session-progress');
            Route::get('add-medical-record', [DoctorAddMedicalRecord::class, 'index'])->name('doctor-add-medical-record');
            Route::get('view-medical-record', [DoctorViewMedicalRecord::class, 'index'])->name('doctor-view-medical-record');
            Route::get('appointments-calendar', [DoctorAppointmentCalendar::class, 'index'])->name('doctor-appointment-calendar');
            Route::get('manage-appointments', [DoctorManageAppointments::class, 'index'])->name('doctor-manage-appointments');
            Route::get('view-appointments', [DoctorViewAppointments::class, 'index'])->name('doctor-view-appointment');
            Route::get('add-appointments', [DoctorAddAppointments::class, 'index'])->name('doctor-add-appointment');
            Route::get('generate-prescription', [DoctorGeneratePrescription::class, 'index'])->name('doctor-generate-prescription');
            Route::get('billing', [DoctorBilling::class, 'index'])->name('doctor-billing');
            Route::get('transactions', [DoctorTransactions::class, 'index'])->name('doctor-transactions');

        })->name('doctor-routes'); 


});

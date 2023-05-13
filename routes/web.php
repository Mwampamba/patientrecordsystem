<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\StaffController;
use App\Http\Controllers\Auth\PatientController;
use App\Http\Controllers\Auth\PrescriptionController;
use App\Http\Controllers\Patient\ProfileController;

Route::group(['middleware' => ['staff_auth']], function () {
    # Dashboard
    Route::get('authentication/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    # Logout
    Route::get('authentication/logout', [DashboardController::class, 'logout'])->name('staffLogout');
    # Permissions
    Route::get('authentication/permissions', [PermissionController::class, 'index'])->name('permissions')->middleware('role:admin');
    Route::get('authentication/permissions/new', [PermissionController::class, 'createNewPermission'])->name('createNewPermission')->middleware('role:admin');
    Route::post('authentication/permissions/new', [PermissionController::class, 'saveNewPermission'])->name('saveNewPermission')->middleware('role:admin');
    Route::get('authentication/permissions/details/{permission_id}', [PermissionController::class, 'permissionDetails'])->name('permissionDetails')->middleware('role:admin');
    # Roles
    Route::get('authentication/roles', [RoleController::class, 'index'])->name('roles')->middleware('role:admin');
    Route::get('authentication/roles/new', [RoleController::class, 'createNewRole'])->name('createNewRole')->middleware('role:admin');
    Route::post('authentication/roles/new', [RoleController::class, 'saveNewRole'])->name('saveNewRole')->middleware('role:admin');
    Route::get('authentication/roles/details/{role_id}', [RoleController::class, 'roleDetails'])->name('roleDetails')->middleware('role:admin');
    Route::post('authentication/roles/details/{role_id}', [RoleController::class, 'attachPermissionsToRole'])->name('attachPermissionsToRole')->middleware('role:admin');
    Route::get('authentication/roles/{role_id}/{permission_id}', [RoleController::class, 'removePermissionsToRole'])->name('removePermissionsToRole')->middleware('role:admin');
    # Staffs
    Route::get('authentication/staffs', [StaffController::class, 'index'])->name('staffs')->middleware('role:admin');
    Route::get('authentication/staffs/new', [StaffController::class, 'addNewStaff'])->name('addNewStaff')->middleware('role:admin');
    Route::post('authentication/staffs/new', [StaffController::class, 'saveNewStaff'])->name('saveNewStaff')->middleware('role:admin');
    Route::get('authentication/staffs/edit/{staff_id}', [StaffController::class, 'editStaff'])->name('editStaff')->middleware('role:admin');
    Route::put('authentication/staffs/edit/{staff_id}', [StaffController::class, 'updateStaff'])->name('updateStaff')->middleware('role:admin');
    Route::get('authentication/staffs/delete/{staff_id}', [StaffController::class, 'deleteStaff'])->name('deleteStaff')->middleware('role:admin');
    Route::get('authentication/role-and-permissions/{staff_id}', [StaffController::class, 'roleAndPermissions'])->name('roleAndPermissions')->middleware('role:admin'); 
    Route::post('authentication/{staff_id}/roles', [StaffController::class, 'attachRole'])->name('attachRole')->middleware('role:admin'); 
    Route::get('authentication/{staff_id}/staffs/roles/{role_id}', [StaffController::class, 'removeRole'])->name('removeRole')->middleware('role:admin'); 
    Route::post('authentication/{staff_id}/permissions', [StaffController::class, 'givePermission'])->name('givePermission')->middleware('role:admin'); 
    Route::get('authentication/{staff_id}/staffs/permissions/{permission_id}', [StaffController::class, 'removePermisssion'])->name('removePermisssion')->middleware('role:admin'); 
    # Patients
    Route::get('authentication/patients', [PatientController::class, 'index'])->name('patients');
    Route::get('authentication/patients/new', [PatientController::class, 'addNewPatient'])->name('addNewPatient')->middleware('role:receptionist');
    Route::post('authentication/patients/new', [PatientController::class, 'saveNewPatient'])->name('saveNewPatient')->middleware('role:receptionist');
    Route::get('authentication/patients/edit/{patient_id}', [PatientController::class, 'editPatient'])->name('editPatient')->middleware('role:receptionist');
    Route::put('authentication/patients/edit/{patient_id}', [PatientController::class, 'updatePatient'])->name('updatePatient')->middleware('role:receptionist');
    Route::get('authentication/patients/delete/{patient_id}', [PatientController::class, 'deletePatient'])->name('deletePatient')->middleware('role:receptionist');
    Route::get('authentication/patients/records/{patient_id}', [PatientController::class, 'patientRecords'])->name('patientRecords');
   
    # Prescription
    Route::get('authentication/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions');
    Route::get('authentication/prescriptions/new', [PrescriptionController::class, 'addNewPrescription'])->name('addNewPrescription')->middleware('role:doctor');
    Route::post('authentication/prescriptions/new', [PrescriptionController::class, 'saveNewPrescription'])->name('saveNewPrescription')->middleware('role:doctor');
    Route::get('authentication/prescriptions/edit/{prescription_id}', [PrescriptionController::class, 'editPrescription'])->name('editPrescription');
    Route::put('authentication/prescriptions/edit/{prescription_id}', [PrescriptionController::class, 'updatePrescription'])->name('updatePrescription');
    Route::get('authentication/prescriptions/delete/{prescription_id}', [PrescriptionController::class, 'deletePrescription'])->name('deletePrescription')->middleware('role:admin');
});

Route::group(['middleware' => ['patient_auth']], function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('patient/dashboard', 'patientProfile')->name('patientProfile');
        Route::get('patient/profile/{patient_id}', 'patient_profile');
        Route::put('patient/profile/{patient_id}', 'profile_update');
        Route::get('patients/records', 'patientRecords')->name('getPatientRecords');
        Route::get('patient/logout', 'patientLogout')->name('patientLogout');
    });
});
# Staff Authentication
Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/', 'get_login')->name('getLogin');
    Route::post('/', 'post_login')->name('postLogin');
    Route::get('/forgot-password', 'get_forgot_password')->name('getForgotPassword');
    Route::post('/forgot-password', 'post_forgot_password')->name('postForgotPassword');
    Route::get('/reset-password/{token}', 'reset_password')->name('resetPassword');
    Route::put('/update-password', 'update_password')->name('updatePassword');
});
# Patient Authentication
Route::controller(PatientAuthController::class)->group(function () {
    Route::get('/patient', 'get_login')->name('patientGetLogin');
    Route::post('/patient', 'post_login')->name('patientPostLogin');
    Route::get('/patient/forgot-password', 'get_forgot_password')->name('patientGetForgotPassword');
    Route::post('/patient/forgot-password', 'post_forgot_password')->name('patientPostForgotPassword');
    Route::get('/patient/reset-password/{token}', 'reset_password')->name('patientResetPassword');
    Route::put('/patient/update-password', 'update_password')->name('patientUpdatePassword'); 
});

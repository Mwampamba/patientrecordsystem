<?php

namespace App\Http\Controllers\Patient;

use App\Models\Patient;
use App\Models\PatientPrescription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function patientProfile(){
        $title = [
            'title' => 'Profile'
        ]; 
        return view('patient-dashboard', $title);
    } 

    public function patientRecords()
    {
        $title = [
            'title' => 'My records'
        ];
        $patient = Patient::findOrFail(auth()->guard('patient')->id()); 
        $prescriptions = PatientPrescription::where('patient_id', $patient->id)
                        ->orderBy('id', 'DESC')->get(); 
        
        return view('patient-records', $title, compact('patient', 'prescriptions'));
    }

    // public function student_profile($student_id)
    // {
    //     $title = [
    //         'title' => 'SIS | Profile'
    //     ];

    //     $student = Student::find(auth()->guard('student')->id());

    //     return view('admin.student-profile', $title, compact('student'));
    // }


    // public function profile_update(Request $request)
    // {
    //     $rules = [
    //         'old_password' => 'required',
    //         'new_password' => 'required|min:8',
    //         'confirm_password' => 'required|min:8',
    //     ];

    //     $messages = [
    //         'old_password.required' => 'Old password is required',
    //         'new_password.required' => 'New password is required',
    //         'confirm_password.required' => 'Confirm password is required',
    //     ];

    //     $this->validate($request, $rules, $messages);

    //     if (Hash::check($request->old_password, Auth::guard('student')->user()->password)) {
    //         if ($request->new_password === $request->confirm_password) {
    //             if (strlen($request->new_password) > 7) {
    //                 $student = Student::findorFail(Auth::guard('student')->user()->id);
    //                 if ($student) {
    //                     $student->password = Hash::make($request->new_password);
    //                     $student->update();
    //                     return redirect()->route('studentDashboard')->with('success', 'Your password successfully updated');
    //                 }
    //             } else {
    //                 return redirect()->back()->with('error', 'New password should contains at least 8 characters');
    //             }
    //         } else {
    //             return redirect()->back()->with('error', 'New password does not match');
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Current password is not correct');
    //     }

    //     return redirect()->route('studentDashboard');
    // }

    public function patientLogout()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('getLogin');
    }

}

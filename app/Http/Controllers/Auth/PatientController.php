<?php

namespace App\Http\Controllers\Auth;

use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller; 
use Illuminate\Database\QueryException;
use App\Http\Requests\Auth\PatientRequest;
use App\Models\PatientPrescription;

class PatientController extends Controller
{
    public function index()
    {
        $title = [
            'title' => 'Patients'
        ];
        $patients = Patient::all();
        return view('patients.index', $title, compact('patients'));
    }

    public function addNewPatient()
    {
        $title = [
            'title' => 'New patient'
        ];
        return view('patients.create', $title);
    }

    public function saveNewPatient(PatientRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $patient = new Patient();
            $patient->name = $validatedData['name'];
            $patient->email = strtolower($validatedData['email']);
            $patient->sex = $validatedData['sex'];
            $password = Str::random(8);
            $hashed_password = Hash::make($password);
            $patient->password = $hashed_password;

            $patient->save();

            $body = "Use this password as your default password. Don't forget to change it";

            Mail::send(
                'authentication.default-password',
                ['password' => $password, 'body' => $body],
                function ($message) use ($request) {
                    $message->from('info@hms.com', 'Hospital Information System');
                    $message->to($request->email, $request->name)
                        ->subject('Default Password');
                }
            );
            return redirect()->route('patients')->with('success', 'Patient has been registered successfully!');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->with('error', 'Sorry, the email has used already.');
            }
        }
    }

    public function editPatient($patient_id)
    {
        $title = [
            'title' => 'Update patient'
        ];

        $patient = Patient::findOrFail($patient_id); 
        return view('patients.update', $title, compact('patient'));
    }

    public function updatePatient(PatientRequest $request, $patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
   
        $validatedData = $request->validated();
        $patient->name = $validatedData['name']; 
        $patient->email = $validatedData['email'];  
        $patient->sex = $validatedData['sex'];
        $patient->update();
        return redirect()->route('patients')->with('success', 'Patient has been updated successfully!');
    }

    public function deleteStaff($staff_id)
    {
        $staff = Patient::findOrFail($staff_id);
        $staff->delete();
        return redirect()->route('Patients')->with('error', 'Staff has been deleted successfully!');
    }

    public function patientRecords($patient_id)
    {
        $title = [
            'title' => 'Patient records'
        ];
        $patient = Patient::findOrFail($patient_id); 
        $prescriptions = PatientPrescription::where('patient_id', $patient->id)
                        ->orderBy('id', 'DESC')->get(); 
        
        return view('patients.records', $title, compact('patient', 'prescriptions'));
    }
}

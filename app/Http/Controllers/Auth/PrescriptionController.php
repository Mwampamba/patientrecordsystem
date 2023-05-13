<?php

namespace App\Http\Controllers\Auth;

use App\Models\Patient;
use App\Models\PatientPrescription;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PrescriptionRequest;

class PrescriptionController extends Controller
{
    public function index(){
        $title = [
            'title' => 'Prescriptions'
        ]; 
        $prescriptions = PatientPrescription::orderBy('id', 'DESC')->get();
        return view('prescriptions.index', $title, compact('prescriptions'));
    }
    
    public function addNewPrescription()
    {
        $title = [
            'title' => 'New prescription'
        ];
        $patients = Patient::all();
       return view('prescriptions.create', $title, compact('patients'));
    }

    public function saveNewPrescription(PrescriptionRequest $request)
    {
        $validatedData = $request->validated();

        $prescription = new PatientPrescription();
        $prescription->patient_id = $validatedData['name'];
        $prescription->staff_id = auth()->user()->id;
        $prescription->doctor_comment = $validatedData['description'];

        $prescription->save();
        return redirect()->route('prescriptions')->with('success', 'Prescription has been submitted successfully!');
    }

    public function editPrescription($prescription_id){
        $title = [
            'title' => 'Update prescription'
        ]; 
        $patients = Patient::all();
        $prescription = PatientPrescription::findOrFail($prescription_id);
        return view('prescriptions.update', $title, compact('patients', 'prescription'));
    }

    public function updatePrescription(PrescriptionRequest $request, $prescription_id)
    {
        $validatedData = $request->validated();

        $prescription = PatientPrescription::findOrFail($prescription_id); 
        $prescription->pharmacist_comment = $validatedData['description'];
        $prescription->doctor_comment = $validatedData['prescription'];
        $prescription->update();
        return redirect()->route('prescriptions')->with('success', 'Prescription has been submitted successfully!');
    }

    public function patientPrescription($prescription_id){
        $title = [
            'title' => 'Update prescription'
        ]; 
        $patients = Patient::all();
        $prescription = PatientPrescription::findOrFail($prescription_id);
        return view('patients.update', $title, compact('patients', 'prescription'));
    }
}

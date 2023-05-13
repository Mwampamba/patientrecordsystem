<?php

namespace App\Models;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientPrescription extends Model
{
    use HasFactory;
    protected $table = 'prescriptions';
    protected $fillabe = [
        'patient_id',
        'staff_id',
        'doctor_comment',
        'pharmacist_comment'
    ];

    public function patientName()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function doctorName()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }
}

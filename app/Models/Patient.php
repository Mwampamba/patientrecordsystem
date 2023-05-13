<?php

namespace App\Models;

use App\Models\PatientPrescription; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory;

    protected $table = 'patients';
    protected $fillable = [
        'name',
        'email',
        'sex',
        'password'
    ];

    public function patientPrescriptions()
    {
        return $this->hasMany(PatientPrescription::class);
    }
}

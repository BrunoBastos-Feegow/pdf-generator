<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'pacientes';

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'PacienteID', 'id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'PacienteID', 'id');
    }

    public function medicalCertificates()
    {
        return $this->hasMany(MedicalCertificate::class, 'PacienteID', 'id');
    }

    public function examRequests()
    {
        return $this->hasMany(ExamRequest::class, 'PacienteID', 'id');
    }
}

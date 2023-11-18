<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCertificate extends Model
{
    protected $table = 'pacientesatestados';

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PacienteID', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    protected $table = 'atendimentos';

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'PacienteID', 'id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'id', 'ProfissionalID');
    }

    public function examRequest(): BelongsTo
    {
        return $this->belongsTo(ExamRequest::class, 'id', 'AtendimentoID');
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'id', 'AtendimentoID');
    }

    public function medicalCertificate(): BelongsTo
    {
        return $this->belongsTo(MedicalCertificate::class, 'id', 'AtendimentoID');
    }
}

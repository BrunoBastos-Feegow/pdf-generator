<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        return $this->belongsTo(Doctor::class, 'ProfissionalID', 'id');
    }

    public function unity(): BelongsTo
    {
        return $this->belongsTo(Unity::class, 'UnidadeID', 'id');
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

    protected function letterhead(): Attribute
    {
        return Attribute::make(
            get: function() {
                return Letterhead::first();
                // Tenta encontrar o LetterHead associado à unidade
                $unitLetterHead = Letterhead::whereRaw("FIND_IN_SET('{$this->UnidadeID}', REPLACE(UnidadeID, '|', ''))")
                    ->orWhere('UnidadeID', 'LIKE', '|ALL|')
                    ->first();

                if($unitLetterHead) {
                    return $unitLetterHead;
                }

                // Se não houver LetterHead para a unidade, tenta encontrar um associado ao Doctor
                return Letterhead::whereRaw("FIND_IN_SET('{$this->ProfissionalID}', REPLACE(Profissionais, '|', ''))")
                    ->orWhere('Profissionais', 'LIKE', '|ALL|')
                    ->first();
            },
        );

    }


}

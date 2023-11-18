<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'pacientesprescricoes';

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PacienteID', 'id');
    }

    protected function impressos(): Attribute
    {
        $printable = Printable::first();
        return Attribute::make(
            get: function() use ($printable) {
                return $printable->Prescricoes ?? null;
            },
        );
    }
}

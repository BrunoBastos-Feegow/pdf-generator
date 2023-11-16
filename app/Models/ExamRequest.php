<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRequest extends Model
{
    protected $table = 'pacientespedidos';

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PacienteID', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\Scopes\SysActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'profissionais';

    protected static function boot(): void
    {
        static::addGlobalScope(new SysActiveScope);
    }
}

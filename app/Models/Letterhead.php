<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letterhead extends Model
{
    protected $table = 'papeltimbrado';
    protected $fillable = [
        'NomeModelo',
        'Cabecalho',
        'Rodape',
        'Profissionais',
        'sysActive',
        'sysUser',
        'MarcaDagua',
        'mLeft',
        'mRight',
        'mTop',
        'mBottom',
        'font-family',
        'font-size',
        'color',
        'line-height',
        'UnidadeID',
        'line-height-type',
        'headerHeight',
        'footerHeight',
        'customHeight',
        'customWidth',
        'orientation',
        'paperSize',
        'useFooter',
        'useHeader'
    ];

    public $timestamps = false;

}

<?php

namespace App\Models;

use App\Models\Scopes\SysActiveScope;
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

    protected static function boot()
    {
        static::addGlobalScope(new SysActiveScope);
    }

    public function doctors()
    {
        if(strstr(mb_strtolower($this->Profissionais), '|all|') || !$this->Profissionais)
            return Doctor::all();

        $doctors = explode('|', $this->Profissionais);
        $doctors = array_filter($doctors, function($doctor) {
            return is_numeric($doctor);
        });
        return Doctor::whereIn('id', $doctors)->get();
    }

    public function unities()
    {
        if(strstr(mb_strtolower($this->UnidadeID), '|all|') || !$this->UnidadeID)
            return Unity::all();

        $unities = explode('|', $this->UnidadeID);
        $unities = array_filter($unities, function($unity) {
            return is_numeric($unity);
        });
        return Unity::whereIn('id', $unities)->get();
    }

}

<?php

namespace App\Services;

use App\Models\Letterhead;

class LetterheadService
{
    public function __construct(
        protected $defaults = [
            'NomeModelo'       => '',
            'Cabecalho'        => '',
            'Rodape'           => '',
            'Profissionais'    => '',
            'sysActive'        => 1,
            'sysUser'          => '',
            'MarcaDagua'       => '',
            'mLeft'            => 20,
            'mRight'           => 20,
            'mTop'             => 20,
            'mBottom'          => 20,
            'font-family'      => 'Arial, Helvetica, sans-serif',
            'font-size'        => 12,
            'color'            => '#000',
            'line-height'      => 12,
            'UnidadeID'        => 0,
            'line-height-type' => '',
            'useHeader'        => true,
            'useFooter'        => true,
            'paperSize'        => 'A4',
            'orientation'      => 'portrait',
            'headerHeight'     => 50,
            'footerHeight'     => 50,
            'customWidth'      => 210,
            'customHeight'     => 297
        ]
    ) {}

    public function getLetterhead(int $id = null): Letterhead
    {
        $letterhead = $id
            ? Letterhead::find($id)
            : new Letterhead();

        foreach($this->defaults as $key => $value) {
            $letterhead[$key] = $letterhead[$key] ?? $value;
        }

        return $letterhead;
    }

    public function saveLetterhead(array $data): Letterhead
    {
        return Letterhead::updateOrCreate(['id' => $data['id']], $data);
    }


}

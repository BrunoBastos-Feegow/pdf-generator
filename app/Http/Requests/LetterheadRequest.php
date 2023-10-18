<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LetterheadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'NomeModelo'       => 'required',
            'Cabecalho'        => 'nullable|string',
            'Rodape'           => 'nullable|string',
            'Profissionais'    => 'nullable|string',
            'sysActive'        => 'nullable|boolean',
            'sysUser'          => 'nullable|numeric',
            'MarcaDagua'       => 'nullable|string',
            'mLeft'            => 'nullable|numeric',
            'mRight'           => 'nullable|numeric',
            'mTop'             => 'nullable|numeric',
            'mBottom'          => 'nullable|numeric',
            'font-family'      => 'nullable|string',
            'font-size'        => 'nullable|numeric',
            'color'            => 'nullable|string',
            'line-height'      => 'nullable|numeric',
            'UnidadeID'        => 'nullable|string',
            'line-height-type' => 'nullable|string',
            'headerHeight'     => 'nullable|numeric',
            'footerHeight'     => 'nullable|numeric',
            'customHeight'     => 'nullable|numeric',
            'customWidth'      => 'nullable|numeric',
            'orientation'      => 'nullable|string',
            'paperSize'        => 'nullable|string',
            'useFooter'        => 'nullable|boolean',
            'useHeader'        => 'nullable|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'NomeModelo.required' => 'O nome do modelo é obrigatório',
        ];
    }
}

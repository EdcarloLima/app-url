<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url'         => 'required|url|unique:web_address|max:200',
            'status_code' => 'integer|nullable',
            'visible'     => 'boolean',
            'contents'    => 'file|nullable'
        ];
    }

    /**
     * Show the validation message
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'url.required'        => 'Informe a url',
            'url.url'             => 'Informe uma url válida',
            'url.unique'          => 'URL já cadastrada',
            'url.max'             => 'Limite máximo de 200 caracteres',
            'status_code.integer' => 'Status no formato inteiro',
            'visible.boolean'     => 'Visibilidade no formato booleano',
            'contents.file'       => 'Conteúdo do tipo blob binário'
        ];
    }
}

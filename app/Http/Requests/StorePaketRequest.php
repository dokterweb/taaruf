<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['owner']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_paket'    => ['required', 'string', 'max:255'],
            'gambar'        => ['sometimes','image','mimes:png,jpg,jpeg'],
            'biaya'         => ['required','integer'],
            'durasi'        => ['required','integer'],
            'keterangan'    => ['nullable', 'string', 'max:65535'],
        ];
    }
}

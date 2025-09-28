<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
        $member = $this->route('member'); // Ambil member dari route parameter
        return [
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'kelamin' => 'nullable|string|in:pria,wanita', // Sesuaikan dengan enum di database
            'no_hp' => 'nullable|string|max:15',
            'is_active' => 'required|boolean',
            'email'             => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users')->ignore($member->user->id), // Abaikan email member yang sedang diupdate
            ],
            'password'          => ['nullable', 'string', 'min:6'],
        ];
    }
}

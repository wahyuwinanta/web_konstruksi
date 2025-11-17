<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

/**
 * @method bool hasFile(string $key)
 * @method \Illuminate\Http\UploadedFile file(string $key)
 */

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('users')->ignore($this->user),
        ],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'string', 'exists:roles,name'], // <-- tambahkan ini
    ];
}

}


<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

/**
 * @method bool hasFile(string $key)
 * @method \Illuminate\Http\UploadedFile file(string $key)
 */

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Ambil user dari route model binding
        /** @var User $user */

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . ($user?->id ?? 'null')],
            'role' => ['required', 'in:owner,pekerja'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ];
    }
}



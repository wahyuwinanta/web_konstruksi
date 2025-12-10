<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

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
        /** @var User $user */

        $user = $this->route('user'); // ambil user dari route model binding

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => ['required', 'in:owner,pekerja'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ];
    }
}



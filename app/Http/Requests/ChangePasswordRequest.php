<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'min:2', 'max:30'],
            'new_password' => ['required', 'string', 'min:4', 'max:30', 'confirmed'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainPurchaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain' => ['required', 'string', 'min:2', 'max:255'],
            'firstname' => ['required', 'string', 'min:2', 'max:255'],
            'surname' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['required', 'string', 'min:2', 'max:255'],
            'state' => ['required', 'string', 'min:2', 'max:50'],
            'postal_code' => ['required', 'string', 'min:4', 'max:10', 'regex:/^\d{4,10}$/'],
            'country' => ['required', 'string', 'size:2'],
            'phone' => ['required', 'string', 'max:15', 'regex:/^[0-9\-\+\(\) ]*$/'],
            'email' => ['required','email','max:255'],
            'city' => ['required','string','max:255'],
        ];
    }
}

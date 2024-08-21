<?php

declare(strict_types=1);

namespace App\Http\Requests\Nameserver;

use Illuminate\Foundation\Http\FormRequest;

class CreateNameserverRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain' => ['required', 'string'],
            'nameserver' => ['required', 'string', 'min:2', 'max:255', 'regex:/^ns\d+\.\S+\.\S+$/'],
            'ip_address' => ['required', 'ip'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests\Nameserver;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNameserverRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:nameservers,id'],
            'ip_address' => ['required', 'ip'],
        ];
    }
}

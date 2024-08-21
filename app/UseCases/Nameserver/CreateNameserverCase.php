<?php

declare(strict_types=1);

namespace App\UseCases\Nameserver;

use App\Models\Nameserver;

class CreateNameserverCase
{
    public function handle(int $id, array $data): void
    {
        Nameserver::create([
            'user_id' => $id,
            'domain_name' => $data['domain'],
            'nameserver' => $data['nameserver'],
            'ip' => $data['ip_address'],
        ]);
    }
}

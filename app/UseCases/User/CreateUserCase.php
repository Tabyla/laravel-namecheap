<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Models\NamecheapProfile;
use App\Models\User;
use App\Services\NamecheapService;
use Illuminate\Contracts\Hashing\Hasher;
use Random\RandomException;

class CreateUserCase
{
    public function __construct(
        private readonly Hasher $hasher,
    ) {
    }

    /**
     * @throws RandomException
     */
    public function handle(array $data): void
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $this->hasher->make($data['password']),
        ]);
        $user->assignRole($data['role']);

        NamecheapProfile::create([
            'user_id' => $user->id,
            'surname' => $data['surname'],
            'firstname' => $data['firstname'],
            'api_key' => $data['api_key'],
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Models\NamecheapProfile;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class RegistrationUserCase
{
    public function __construct(
        private readonly Hasher $hasher,
    )
    {
    }

    public function handle(array $data): void
    {
        $data['password'] = $this->hasher->make($data['password']);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $user->assignRole('user');

        NamecheapProfile::create([
            'user_id' => $user->id,
            'surname' => $data['surname'],
            'firstname' => $data['firstname'],
            'api_key' => $data['api_key'],
        ]);
    }
}

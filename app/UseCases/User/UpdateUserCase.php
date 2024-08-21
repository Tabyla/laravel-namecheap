<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Models\NamecheapProfile;
use App\Models\User;
use App\Services\NamecheapService;
use Illuminate\Contracts\Hashing\Hasher;

class UpdateUserCase
{
    public function __construct(
        private readonly Hasher           $hasher,
        private readonly NamecheapService $namecheapApiService,

    ) {
    }

    public function handle(int $id, array $data): void
    {
        $user = User::findOrFail($id);
        if ($data['password']) {
            $data['password'] = $this->hasher->make($data['password']);
        }
        else{
            $data['password'] = $user->password;
        }
        $user->syncRoles([]);
        $user->assignRole($data['role']);
        $user->update($data);

        $profile = NamecheapProfile::where('user_id', $id)->first();

        if ($profile) {
            if (isset($data['firstname'])) {
                $profile->firstname = $data['firstname'];
            }
            if (isset($data['surname'])) {
                $profile->surname = $data['surname'];
            }
            if (isset($data['api_key'])) {
                $profile->api_key = $data['api_key'];
            }

            $profile->save();
        }
    }
}

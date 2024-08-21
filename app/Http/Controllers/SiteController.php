<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Services\NamecheapService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    protected $namecheapService;

    public function __construct(NamecheapService $namecheapService)
    {
        $this->namecheapService = $namecheapService;
        $this->middleware('auth');
    }

    public function index(): View
    {
        $user = Auth::user();
        $profile = $user->profile;
        $userName = $user->name;
        $apiKey = $user->profile->api_key;
        $domains = $this->namecheapService->getDomainList($userName, $apiKey);

        return view(
            'dashboard',
            [
                'user' => $user,
                'profile' => $profile,
                'domains' => $domains,
            ]
        );
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $request->validated();
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Вы ввели неверный пароль'])->withInput();
        }

        if ($user && $user->profile) {
            $userName = $user->name;
            $apiKey = $user->profile->api_key;
            $result = $this->namecheapService->changePassword($userName, $apiKey, $request->current_password, $request->new_password);
            if ($result['error']) {
                return back()->withErrors($result['message']);
            }
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Пароль успешно изменен');
    }

}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\UseCases\RegistrationUserCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(): View
    {
        return view('reg');
    }

    public function register(RegistrationRequest $request, RegistrationUserCase $case): RedirectResponse
    {
        $data = $request->validated();
        $case->handle($data);

        return redirect()->route('login');
    }
}

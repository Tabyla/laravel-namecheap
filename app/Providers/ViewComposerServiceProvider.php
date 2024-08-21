<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\NamecheapService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('partials.header', function ($view) {
            $user = Auth::user();

            if ($user && $user->profile) {
                $userName = $user->name;
                $apiKey = $user->profile->api_key;
                $namecheapService = new NamecheapService();
                $balance = $namecheapService->getBalance($userName, $apiKey);

                $view->with('userName', $userName)
                    ->with('userBalance', $balance);
                if (!$balance) {
                    $view->with('userBalance', 'N/A');
                }
            } else {
                $view->with('userName', '')
                    ->with('userBalance', '');
            }
        });
    }
}

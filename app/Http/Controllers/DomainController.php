<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\DomainPriceRequest;
use App\Http\Requests\DomainPurchaseRequest;
use App\Services\NamecheapService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomainController extends Controller
{
    protected NamecheapService $namecheapService;
    public function __construct(NamecheapService $namecheapService)
    {
        $this->namecheapService = $namecheapService;
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('domain.index');
    }

    public function checkDomainInfo(DomainPriceRequest $request): View|RedirectResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        if ($user && $user->profile) {
            $userName = $user->name;
            $apiKey = $user->profile->api_key;
            $domainInfo = $this->namecheapService->getDomainInfo($userName, $apiKey, $data['domain_name']);
            $domainPrice = $this->namecheapService->getDomainPrice($userName, $apiKey, $data['domain_name']);
        }

        if ($domainPrice['error']) {
            return back()->withErrors($domainPrice['message']);
        }

        return view('domain.index', [
            'domainInfo' => $domainInfo,
            'domainPrice' => $domainPrice,
        ]);
    }

    public function purchaseForm(Request $request): View
    {
        $user = Auth::user();
        $domainName = $request->query('domain');

        return view('domain.purchase', [
            'user' => $user,
            'domainName' => $domainName[0],
        ]);
    }

    public function purchaseDomain(DomainPurchaseRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        if ($user && $user->profile) {
            $userName = $user->name;
            $apiKey = $user->profile->api_key;
            $result = $this->namecheapService->purchaseDomain($userName, $apiKey, $data);
        }

        if (isset($result['ApiResponse']['Errors']['Error'])) {
            return back()->withErrors($result['ApiResponse']['Errors']['Error']);
        }

        return redirect()->route('domain')->with('success', 'Домен успешно куплен!');
    }
}

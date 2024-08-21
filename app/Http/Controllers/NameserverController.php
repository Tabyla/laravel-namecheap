<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Nameserver\CreateNameserverRequest;
use App\Http\Requests\Nameserver\UpdateNameserverRequest;
use App\Models\Nameserver;
use App\Services\NamecheapService;
use App\UseCases\Nameserver\CreateNameserverCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NameserverController extends Controller
{
    protected NamecheapService $namecheapService;

    public function __construct(NamecheapService $namecheapService)
    {
        $this->namecheapService = $namecheapService;
        $this->middleware('auth');
    }

    public function index(Request $request): View|RedirectResponse
    {
        $domain = $request->query('domain');
        if (!$domain) {
            return redirect()->back()->with('error', 'Ошибка при добавлении NS записи.');
        }
        $user = Auth::user();

        if ($user && $user->profile) {
            $nameservers = Nameserver::where('domain_name', $domain)->get();
        }

        return view('nameserver.index', [
            'domain' => $domain,
            'nameservers' => $nameservers,
        ]);
    }

    public function create(Request $request): View
    {
        $domain = $request->query('domain');

        return view('nameserver.create', [
            'domain' => $domain,
        ]);
    }

    public function store(CreateNameserverRequest $request, CreateNameserverCase $case): RedirectResponse
    {
        $data = $request->validated();
        $user = Auth::user();
        $userName = $user->name;
        $apiKey = $user->profile->api_key;
        $result = $this->namecheapService->createNameserver($userName, $apiKey, $data);

        if ($result) {
            $case->handle($user->id, $data);
            return redirect()->route('nameserver.index', ['domain' => $data['domain']]);
        } else {
            return redirect()->back()->with('error', 'Ошибка при добавлении NS записи.');
        }
    }

    public function edit(int $id): View
    {
        $nameserver = Nameserver::findOrFail($id);

        return view('nameserver.edit', [
            'nameserver' => $nameserver,
        ]);
    }

    public function update(UpdateNameserverRequest $request, CreateNameserverCase $case): RedirectResponse
    {
        $data = $request->validated();
        $nameserver = Nameserver::findOrFail($data['id']);
        $user = Auth::user();
        $userName = $user->name;
        $apiKey = $user->profile->api_key;
        $result = $this->namecheapService->updateNameserver($userName, $apiKey, $nameserver, $data['ip_address']);

        if ($result) {
            $nameserver['ip'] = $data['ip_address'];
            $nameserver->save();
            return redirect()->route('nameserver.index', ['domain' => $nameserver['domain_name']]);
        } else {
            return redirect()->back()->with('error', 'Ошибка при добавлении NS записи.');
        }
    }

    public function destroy(string $domain, string $nameserver): RedirectResponse
    {
        $user = Auth::user();
        $userName = $user->name;
        $apiKey = $user->profile->api_key;

        $result = $this->namecheapService->deleteDNSRecord($userName, $apiKey, $domain, $nameserver);

        if ($result) {
            Nameserver::where('nameserver', $nameserver)->delete();
            return redirect()->back()->with('success', 'NS-запись успешно удалена.');
        } else {
            return redirect()->back()->with('error', 'Ошибка при удалении NS-записи.');
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Domain\Customers\Actions\CreateClient;
use App\Domain\Customers\Actions\DeleteClient;
use App\Domain\Customers\Actions\RestoreClient;
use App\Domain\Customers\Actions\UpdateClient;
use App\Domain\Customers\Models\Client;
use App\Domain\Institutions\Models\Governorate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CreateClientRequest;
use App\Http\Requests\Customers\UpdateClientRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class ClientController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Client::class);
        $clients = Client::query()->with('governorate')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $term = '%'.trim((string) $request->input('q')).'%';
                $query->where(fn ($nested) => $nested->where('name', 'like', $term)->orWhere('code', 'like', $term)->orWhere('national_id', 'like', $term));
            })->orderBy('name')->paginate(25)->withQueryString();
        return view('clients.index', compact('clients'));
    }

    public function create(): View
    {
        $this->authorize('create', Client::class);
        return view('clients.create', ['governorates' => Governorate::query()->orderBy('name')->get()]);
    }

    public function store(CreateClientRequest $request, CreateClient $action): RedirectResponse|Client
    {
        $client = $action->execute($request->validated());
        return $request->expectsJson() ? $client : redirect()->route('clients.show', $client)->with('status', 'تم إنشاء العميل بنجاح.');
    }

    public function show(Client $client): View
    {
        $this->authorize('view', $client);
        $client->load(['governorate', 'phones', 'debtCases']);
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        $this->authorize('update', $client);
        return view('clients.edit', ['client' => $client, 'governorates' => Governorate::query()->orderBy('name')->get()]);
    }

    public function update(UpdateClientRequest $request, Client $client, UpdateClient $action): RedirectResponse|Client
    {
        $updated = $action->execute($client, $request->validated());
        return $request->expectsJson() ? $updated : redirect()->route('clients.show', $updated)->with('status', 'تم تحديث بيانات العميل.');
    }

    public function destroy(Request $request, Client $client, DeleteClient $action): RedirectResponse|null
    {
        $this->authorize('delete', $client);
        $action->execute($client);
        return $request->expectsJson() ? null : redirect()->route('clients.index')->with('status', 'تم حذف العميل.');
    }

    public function restore(Request $request, int $client, RestoreClient $action): RedirectResponse|Client
    {
        $this->authorize('restore', Client::withTrashed()->findOrFail($client));
        $restored = $action->execute(Client::withTrashed()->findOrFail($client));
        return $request->expectsJson() ? $restored : redirect()->route('clients.show', $restored)->with('status', 'تم استعادة العميل.');
    }
}

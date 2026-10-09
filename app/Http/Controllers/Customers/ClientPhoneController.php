<?php

declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Domain\Customers\Actions\AddClientPhone;
use App\Domain\Customers\Actions\RemoveClientPhone;
use App\Domain\Customers\Actions\UpdateClientPhone;
use App\Domain\Customers\Models\Client;
use App\Domain\Customers\Models\ClientPhone;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\AddClientPhoneRequest;
use App\Http\Requests\Customers\UpdateClientPhoneRequest;

final class ClientPhoneController extends Controller
{
    public function store(
        AddClientPhoneRequest $request,
        Client $client,
        AddClientPhone $action
    ): ClientPhone {
        return $action->execute($client, $request->validated());
    }

    public function update(
        UpdateClientPhoneRequest $request,
        ClientPhone $phone,
        UpdateClientPhone $action
    ): ClientPhone {
        return $action->execute($phone, $request->validated());
    }

    public function destroy(
        ClientPhone $phone,
        RemoveClientPhone $action
    ): void {
        $action->execute($phone);
    }
}
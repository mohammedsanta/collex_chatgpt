<?php

declare(strict_types=1);

namespace App\Support\Constants;

final class PermissionNames
{
    public const CLIENTS_VIEW = 'clients.view';
    public const CLIENTS_CREATE = 'clients.create';
    public const CLIENTS_UPDATE = 'clients.update';
    public const PAYMENTS_VIEW = 'payments.view';
    public const PAYMENTS_CREATE = 'payments.create';
    public const PAYMENTS_CONFIRM = 'payments.confirm';
    public const PAYMENTS_REJECT = 'payments.reject';
    public const SETTINGS_MANAGE = 'settings.manage';
    private function __construct() {}
}

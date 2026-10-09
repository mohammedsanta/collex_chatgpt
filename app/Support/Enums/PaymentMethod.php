<?php

declare(strict_types=1);

namespace App\Support\Enums;

enum PaymentMethod: string
{
    case CASH = 'cash';
    case E_WALLET = 'e_wallet';
    case BANK_TRANSFER = 'bank_transfer';
    case CARD = 'card';
    case CHEQUE = 'cheque';
}
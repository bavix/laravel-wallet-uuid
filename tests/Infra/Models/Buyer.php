<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Infra\Models;

use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\WalletUuid\Test\Infra\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @internal
 */
final class Buyer extends Model implements Customer
{
    use Uuids;
    use CanPay;
    use HasWallets;

    public function getTable(): string
    {
        return 'users';
    }
}

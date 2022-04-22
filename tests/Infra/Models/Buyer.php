<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Infra\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;

/**
 * @internal
 */
final class Buyer extends \Bavix\Wallet\Test\Infra\Models\Buyer
{
    use GeneratesUuid;

    public $incrementing = false;

    protected $casts = [
        'id' => EfficientUuid::class,
    ];

    public function uuidColumn(): string
    {
        return 'id';
    }
}

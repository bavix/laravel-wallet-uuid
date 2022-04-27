<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Infra\Models;

use Bavix\WalletUuid\Test\Infra\Uuids;

/**
 * @internal
 */
final class Buyer extends \Bavix\Wallet\Test\Infra\Models\Buyer
{
    use Uuids;
    public $incrementing = false;
}

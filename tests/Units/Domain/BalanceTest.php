<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Units\Domain;

use Bavix\WalletUuid\Test\Infra\Factories\BuyerFactory;
use Bavix\WalletUuid\Test\Infra\Models\Buyer;
use Bavix\WalletUuid\Test\Infra\TestCase;

/**
 * @internal
 */
final class BalanceTest extends TestCase
{
    public function testDepositWalletExists(): void
    {
        /** @var Buyer $buyer */
        $buyer = BuyerFactory::new()->create();
        self::assertFalse($buyer->relationLoaded('wallet'));
        $transaction = $buyer->deposit(1);

        self::assertTrue($buyer->relationLoaded('wallet'));
        self::assertSame(1, $buyer->balanceInt);
        self::assertTrue($buyer->wallet->exists);

        $transaction->refresh();

        self::assertSame(1, $transaction->amountInt);
        self::assertSame($transaction->payable_type, $buyer->getMorphClass());
        self::assertSame($transaction->payable_id, $buyer->getKey());
    }
}

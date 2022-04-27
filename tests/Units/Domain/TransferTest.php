<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Units\Domain;

use Bavix\Wallet\External\Dto\Extra;
use Bavix\Wallet\External\Dto\Option;
use Bavix\WalletUuid\Test\Infra\Factories\BuyerFactory;
use Bavix\WalletUuid\Test\Infra\Models\Buyer;
use Bavix\WalletUuid\Test\Infra\TestCase;

/**
 * @internal
 */
final class TransferTest extends TestCase
{
    public function testMoneyTransfer(): void
    {
        /** @var Buyer $buyer1 */
        /** @var Buyer $buyer2 */
        [$buyer1, $buyer2] = BuyerFactory::times(2)->create();
        self::assertNotSame($buyer1->getKey(), $buyer2->getKey());

        $transaction = $buyer1->deposit(1);
        $transaction->refresh();

        self::assertSame(1, $transaction->amountInt);
        self::assertSame($transaction->payable_type, $buyer1->getMorphClass());
        self::assertSame($transaction->payable_id, $buyer1->getKey());

        $transfer = $buyer1->transfer($buyer2, 1, new Extra(
            [
                'message' => 'deposit',
            ],
            new Option([
                'message' => 'withdraw',
            ], false),
        ));

        self::assertTrue($transfer->relationLoaded('withdraw'));
        self::assertTrue($transfer->relationLoaded('deposit'));

        self::assertSame([
            'message' => 'deposit',
        ], $transfer->deposit->meta);
        self::assertSame([
            'message' => 'withdraw',
        ], $transfer->withdraw->meta);

        self::assertTrue($transfer->deposit->confirmed);
        self::assertFalse($transfer->withdraw->confirmed);

        self::assertSame(1, $buyer1->balanceInt);
        self::assertSame(1, $buyer2->balanceInt);
    }
}

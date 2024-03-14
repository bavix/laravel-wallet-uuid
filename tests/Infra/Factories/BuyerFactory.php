<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Infra\Factories;

use Bavix\WalletUuid\Test\Infra\Models\Buyer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Bavix\WalletUuid\Test\Infra\Models\Buyer>
 */
final class BuyerFactory extends Factory
{
    protected $model = Buyer::class;

    public function definition(): array
    {
        return [
            'name' => fake()
                ->name(),
            'email' => fake()
                ->unique()
                ->safeEmail,
        ];
    }
}

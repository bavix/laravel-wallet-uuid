<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Infra\Factories;

use Bavix\WalletUuid\Test\Infra\Models\Buyer;
use Illuminate\Database\Eloquent\Factories\Factory;

final class BuyerFactory extends Factory
{
    protected $model = Buyer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()
                ->safeEmail,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Infra;

use Illuminate\Support\ServiceProvider;

final class TestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom([dirname(__DIR__) . '/migrations']);
    }
}

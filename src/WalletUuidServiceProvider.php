<?php

declare(strict_types=1);

namespace Bavix\WalletUuid;

use Bavix\Wallet\WalletConfigure;
use Illuminate\Support\ServiceProvider;

final class WalletUuidServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->shouldMigrate()) {
            $this->loadMigrationsFrom([dirname(__DIR__).'/database']);
        }

        $this->publishes([
            dirname(__DIR__).'/database/' => database_path('migrations'),
        ], 'laravel-wallet-uuid-migrations');
    }

    private function shouldMigrate(): bool
    {
        return WalletConfigure::isRunsMigrations();
    }
}

<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Infra;

use Bavix\Wallet\WalletServiceProvider;
use Bavix\WalletUuid\WalletUuidServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * @internal
 */
abstract class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DB::transactionLevel() && DB::rollBack();
    }

    /**
     * @param Application $app
     */
    protected function getPackageProviders($app): array
    {
        return [WalletServiceProvider::class, WalletUuidServiceProvider::class, TestServiceProvider::class];
    }

    /**
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        /** @var Repository $config */
        $config = $app['config'];

        // database
        $config->set('database.connections.testing.prefix', 'tests');
        $config->set('database.connections.pgsql.prefix', 'tests');
        $config->set('database.connections.mysql.prefix', 'tests');
        $config->set('database.connections.mariadb.prefix', 'tests');

        $config->set('database.connections.mariadb.port', 3307);

        // new table name's
        $config->set('wallet.transaction.table', 'transaction');
        $config->set('wallet.transfer.table', 'transfer');
        $config->set('wallet.wallet.table', 'wallet');

        $config->set('wallet.cache.driver', $config->get('cache.driver'));
        $config->set('wallet.lock.driver', $config->get('cache.driver'));
    }
}

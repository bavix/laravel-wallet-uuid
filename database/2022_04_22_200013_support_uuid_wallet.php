<?php

declare(strict_types=1);

use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Database\MariaDbConnection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        $connection = Schema::getConnection();

        if ($connection instanceof PostgresConnection) {
            Schema::table($this->transactionTable(), static function (Blueprint $table) {
                $table->string('payable_id')
                    ->change();
            });

            Schema::table($this->walletTable(), static function (Blueprint $table) {
                $table->string('holder_id')
                    ->change();
            });

            $connection->statement(
                'ALTER TABLE '.$connection->getTablePrefix().$this->transactionTable().' ALTER payable_id TYPE UUID USING payable_id::uuid;'
            );
            $connection->statement(
                'ALTER TABLE '.$connection->getTablePrefix().$this->walletTable().' ALTER holder_id TYPE UUID USING holder_id::uuid;'
            );

            return;
        }

        if ($connection instanceof MariaDbConnection) {
            Schema::table($this->transactionTable(), static function (Blueprint $table) {
                $table->dropIndex('payable_type_payable_id_ind');
                $table->dropIndex('payable_type_ind');
                $table->dropIndex('payable_confirmed_ind');
                $table->dropIndex('payable_type_confirmed_ind');

                $table->dropColumn('payable_id');
            });

            Schema::table($this->transactionTable(), static function (Blueprint $table) {
                $table->uuid('payable_id')
                    ->after('payable_type')
                ;

                $table->index(['payable_type', 'payable_id'], 'payable_type_payable_id_ind');
                $table->index(['payable_type', 'payable_id', 'type'], 'payable_type_ind');
                $table->index(['payable_type', 'payable_id', 'confirmed'], 'payable_confirmed_ind');
                $table->index(['payable_type', 'payable_id', 'type', 'confirmed'], 'payable_type_confirmed_ind');
            });

            Schema::table($this->walletTable(), static function (Blueprint $table) {
                $table->dropUnique(['holder_type', 'holder_id', 'slug']);

                $table->dropColumn('holder_id');
            });

            Schema::table($this->walletTable(), static function (Blueprint $table) {
                $table->uuid('holder_id');

                $table->unique(['holder_type', 'holder_id', 'slug']);
            });

            return;
        }

        Schema::table($this->transactionTable(), static function (Blueprint $table) {
            $table->uuid('payable_id')
                ->change();
        });

        Schema::table($this->walletTable(), static function (Blueprint $table) {
            $table->uuid('holder_id')
                ->change();
        });
    }

    private function transactionTable(): string
    {
        return (new Transaction())->getTable();
    }

    private function walletTable(): string
    {
        return (new Wallet())->getTable();
    }
};

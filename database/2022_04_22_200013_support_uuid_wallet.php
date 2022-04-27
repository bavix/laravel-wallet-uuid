<?php

declare(strict_types=1);

use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        $connection = Schema::getConnection();

        if ($connection instanceof PostgresConnection) {
            $connection->statement('ALTER TABLE '.$this->transactionTable().' ALTER payable_id::uuid TYPE UUID');
            $connection->statement('ALTER TABLE '.$this->walletTable().' ALTER holder_id::uuid TYPE UUID');

            return;
        }

        Schema::table($this->transactionTable(), static function (Blueprint $table) {
            $table->uuid('payable_id')
                ->change()
            ;
        });

        Schema::table($this->walletTable(), static function (Blueprint $table) {
            $table->uuid('holder_id')
                ->change()
            ;
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

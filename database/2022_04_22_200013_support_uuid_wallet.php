<?php

declare(strict_types=1);

use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table($this->transactionTable(), static function (Blueprint $table): void {
            $table->uuid('payable_id')
                ->change()
            ;
        });

        Schema::table($this->walletTable(), function (Blueprint $table): void {
            $table->uuid('holder_id')
                ->change()
            ;
        });
    }

    public function down(): void
    {
        Schema::table($this->transactionTable(), static function (Blueprint $table): void {
            $table->unsignedBigInteger('payable_id')
                ->change()
            ;
        });

        Schema::table($this->walletTable(), static function (Blueprint $table): void {
            $table->unsignedBigInteger('holder_id')
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

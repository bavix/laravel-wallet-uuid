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
                ->after('payable_type')
            ;

            $table->index(['payable_type', 'payable_id'], 'payable_type_payable_id_ind');
            $table->index(['payable_type', 'payable_id', 'type'], 'payable_type_ind');
            $table->index(['payable_type', 'payable_id', 'confirmed'], 'payable_confirmed_ind');
            $table->index(['payable_type', 'payable_id', 'type', 'confirmed'], 'payable_type_confirmed_ind');
        });

        Schema::table($this->walletTable(), static function (Blueprint $table): void {
            $table->uuid('holder_id')
                ->after('holder_type')
            ;

            $table->unique(['holder_type', 'holder_id', 'slug']);
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

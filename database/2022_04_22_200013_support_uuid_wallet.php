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
            $table->dropIndex('payable_type_payable_id_ind');
            $table->dropIndex('payable_type_ind');
            $table->dropIndex('payable_confirmed_ind');
            $table->dropIndex('payable_type_confirmed_ind');
            $table->dropColumn('payable_id');
        });

        Schema::table($this->walletTable(), static function (Blueprint $table): void {
            $table->dropUnique(['holder_type', 'holder_id', 'slug']);
            $table->dropColumn('holder_id');
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

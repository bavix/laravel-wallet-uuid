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
        Schema::whenTableHasColumn($this->transactionTable(), 'payable_id', static function (Blueprint $table) {
            $table->dropColumn('payable_id');
        });

        Schema::whenTableHasColumn($this->walletTable(), 'holder_id', static function (Blueprint $table) {
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

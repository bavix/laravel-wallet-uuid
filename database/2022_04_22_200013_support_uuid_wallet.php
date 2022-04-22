<?php

declare(strict_types=1);

use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::dropColumns($this->transactionTable(), ['payable_id']);
        Schema::dropColumns($this->walletTable(), ['holder_id']);
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

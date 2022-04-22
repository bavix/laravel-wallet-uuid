<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\PostgresConnection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        if (Schema::getConnection() instanceof PostgresConnection) {
            DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        }
    }
};

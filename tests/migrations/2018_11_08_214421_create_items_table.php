<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('items', static function (Blueprint $table) {
            $table->efficientUuid('id')
                ->primary()
            ;
            $table->string('name');
            $table->integer('price');
            $table->unsignedSmallInteger('quantity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

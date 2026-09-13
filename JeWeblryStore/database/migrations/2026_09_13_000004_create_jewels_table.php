<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jewels', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->string('status');
            $table->unsignedInteger('stock');
            $table->string('material');
            $table->string('image');
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jewels');
    }
};

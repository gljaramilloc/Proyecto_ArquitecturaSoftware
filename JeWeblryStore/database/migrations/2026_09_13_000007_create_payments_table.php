<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2);
            $table->string('method');

            // Reemplazo del string por la llave foránea conectada a statuses
            $table->foreignId('status_id')->constrained('statuses')->restrictOnDelete();

            $table->date('date');
            $table->foreignId('order_id')->unique()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

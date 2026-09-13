<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Reemplazo del string por la llave foránea conectada a statuses
            // Asumimos que el ID 1 podría ser un estado inicial como 'Pendiente'
            $table->foreignId('status_id')->default(1)->constrained('statuses')->restrictOnDelete();
            
            $table->decimal('total', 10, 2);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
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

            // Replacing the string with the foreign key linked to statuses
            // We assume that ID 1 could be an initial state, such as 'Pending'.
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

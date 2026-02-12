<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('engineer_id')->constrained('engineer_profiles')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('client_profiles')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->json('items');
            $table->string('status')->default('impaye');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client_profiles')->onDelete('cascade');
            $table->string('type');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('status')->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};

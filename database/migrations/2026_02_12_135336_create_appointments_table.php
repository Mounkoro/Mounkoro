<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_request_id')->constrained('service_requests')->onDelete('cascade');
            $table->foreignId('engineer_id')->constrained('engineer_profiles')->onDelete('cascade');
            $table->dateTime('appointment_date');
            $table->string('status')->default('planifie');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('engineer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('skills')->nullable();
            $table->string('availability')->default('disponible');
            $table->string('intervention_zone')->nullable();
            $table->text('bio')->nullable();
            $table->float('rating')->default(5.0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engineer_profiles');
    }
};

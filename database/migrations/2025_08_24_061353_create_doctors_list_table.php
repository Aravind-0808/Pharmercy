<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors_list', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->string('logo')->unique();
            $table->string('address')->unique();
            $table->string('country')->required();
            $table->string('state')->required();
            $table->string('city')->required();
            $table->string('zip_code')->required();
            $table->string('specialization')->required();
            $table->string('phone')->required();
            $table->string('whatsapp')->required();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors_list');
    }
};

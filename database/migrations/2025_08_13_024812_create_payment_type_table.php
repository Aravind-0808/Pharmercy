<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert default payment types
        DB::table('payment_type')->insert([
            ['id' => 1, 'name' => 'razorpay', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'wallet',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'cod',      'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_type');
    }
};

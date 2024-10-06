<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emergencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->json('first_name')->nullable();
            $table->json('middle_name')->nullable();
            $table->json('last_name')->nullable();
            $table->tinyInteger('relationship')->nullable()->comment('0 = father , 1 = mother , 2 = sister , 3 = brother , 4 = other');
            $table->string('phone_one')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('phone_three')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergencies');
    }
};

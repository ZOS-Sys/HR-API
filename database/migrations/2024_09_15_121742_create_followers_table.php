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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->json('first_name')->nullable();
            $table->json('middle_name')->nullable();
            $table->json('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('relationship')->nullable()->comment('0 = son , 1 = daughter , 2 = husband , 3 = wife');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};

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
        Schema::create('user_identities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->tinyInteger('identity_type')->nullable()->comment('0 = national , 1 = residence');
            $table->string('identity_num')->nullable();
            $table->date('identity_start')->nullable();
            $table->date('identity_end')->nullable();
            $table->string('passport_num')->nullable();
            $table->date('passport_start')->nullable();
            $table->string('passport_end')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_identities');
    }
};

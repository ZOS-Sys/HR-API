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
        Schema::table('user_jobs', function (Blueprint $table) {
            $table->dropColumn(['job_title', 'job_rank', 'job_level']);
            $table->foreignId('job_title_id')->nullable()->after('job_num')->constrained('job_titles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_jobs', function (Blueprint $table) {
            $table->string('job_title')->nullable()->after('job_num');
            $table->tinyInteger('job_rank')->nullable()->after('cost_center');
            $table->tinyInteger('job_level')->nullable()->after('job_rank');
            $table->dropForeign(['job_title_id']);
            $table->dropColumn('job_title_id');
        });
    }
};

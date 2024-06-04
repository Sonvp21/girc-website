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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->longText('content_en')->nullable();
        });
        Schema::table('announcements', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->longText('content_en')->nullable();
        });
        Schema::table('science_informations', function (Blueprint $table) {
            $table->longText('content_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('title_en');
            $table->dropColumn('content_en');
        });
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('title_en');
            $table->dropColumn('content_en');
        });
        Schema::table('science_informations', function (Blueprint $table) {
            $table->dropColumn('content_en');
        });
    }
};

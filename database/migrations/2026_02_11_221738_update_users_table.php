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
        Schema::table('users', function (Blueprint $table){
            $table->string('username')->unique()->after('name');
            $table->string('phone')->unique()->after('email');
            $table->integer('streak')->unsigned();
            $table->integer('max_streak')->unsigned();
            $table->integer('weekly_day_goals')->unsigned();
            $table->integer('daily_minutes_goal')->unsigned();
            $table->string('secondary_activity', 20)->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->boolean('is_private');
            $table->string('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('streak');
            $table->dropColumn('max_streak');
            $table->dropColumn('weekly_day_goals');
            $table->dropColumn('daily_minutes_goal');
            $table->dropColumn('secondary_activity');
            $table->dropColumn('profile_picture_path');
            $table->dropColumn('is_private');
            $table->dropColumn('role');
        });
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_img_second')->nullable()->after('profile_image');
            $table->string('profile_img_third')->nullable()->after('profile_img_second');
            $table->string('brand_name')->nullable()->after('profile_img_third');
            $table->string('bio')->nullable()->after('brand_name');
            $table->string('instagram_username')->nullable()->after('bio');
            $table->date('dob')->nullable()->after('instagram_username');
            $table->enum('gender',['male','female','other'])->nullable()->after('dob');
            $table->integer('vertical_id')->nullable()->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_img_second');
            $table->dropColumn('profile_img_third');
            $table->dropColumn('brand_name');
            $table->dropColumn('bio');
            $table->dropColumn('instagram_username');
            $table->dropColumn('dob');
            $table->dropColumn('gender');
            $table->dropColumn('vertical_id');
        });
    }
};

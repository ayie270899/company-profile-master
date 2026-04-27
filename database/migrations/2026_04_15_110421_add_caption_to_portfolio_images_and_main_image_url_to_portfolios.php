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
        // Menambah caption di portfolio_images
        Schema::table('portfolio_images', function (Blueprint $table) {
            $table->string('caption')->nullable()->after('image_path');
        });

        // Menambah main_image_url di portfolios
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('main_image_url')->nullable()->after('detail_content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_images', function (Blueprint $table) {
            $table->dropColumn('caption');
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('main_image_url');
        });
    }
};

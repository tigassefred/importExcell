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
        Schema::table('container', function (Blueprint $table) {
            $table->foreignId('container_size_id')->constrained('container_sizes');
            $table->foreignId('shipping_lines_id')->constrained('shipping_lines');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('container', function (Blueprint $table) {
            $table->dropForeign('containers_container_size_id_foreign');
            $table->dropForeign('containers_shipping_lines_id_foreign');
        });
    }
};

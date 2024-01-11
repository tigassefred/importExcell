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
        Schema::create('container', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->enum("category" ,["groupage", "personel"]);
            $table->string('consigne');
            $table->string("agent_price");
            $table->string("agent_name");
            $table->string("custom_number")->nullable();
            $table->string("cost_price")->nullable();
            $table->string("container_number");
            $table->string("delivery_slip");
            $table->boolean("deleted")->default(false);
            $table->boolean("isArrived")->default(false);
            $table->boolean('istelex')->default(false);
            $table->date('loading_time')->default(now());
            $table->date('arrival_time')->nullable()->default(null);
            $table->date('unloading_time')->nullable();
            $table->decimal('cbm', 5,2)->nullable();
            $table->decimal('petit_balle', 5,2)->nullable();
            $table->decimal('hand_balle', 5,2)->nullable();
            $table->decimal('grd_balle', 5,2)->nullable();
            $table->text('Remarque')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};

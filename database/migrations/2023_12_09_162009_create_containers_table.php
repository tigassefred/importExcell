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
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('CONSIGNEE')->nullable();
            $table->string('ISPAYE')->nullable();
            $table->string('PAYEMENT')->nullable();
            $table->string('COST_NUMBER')->nullable();
            $table->string('CONTAINER_NUMBER')->nullable();
            $table->string('BL')->nullable();
            $table->string('DESTINATION')->nullable();
            $table->string('TELEX_DOC');
            $table->date('LOADING_TIME')->nullable();
            $table->date('ARRIVAL_TIME')->nullable();
            $table->integer('AGENT_PRICE')->nullable();
            $table->integer('COST_PRICE')->nullable();
            $table->string('TYPE')->nullable();
            $table->string('SHIPPING_LINE')->nullable();
            $table->string('SHIPPING_AGENT')->nullable();
            $table->text('REMARK')->nullable();
            $table->integer('GRD_BALLES')->nullable();
            $table->integer('HAND_BALLES')->nullable();
            $table->integer('PTES_BALLES')->nullable();
            $table->double('CBM')->nullable();
            $table->timestamps();
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

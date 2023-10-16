<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monitoring_point_id');
            $table->foreignId('users_id');
            $table->foreignId('sampling_time_id');
            $table->float('wqi')->nullable();
            $table->float('wpi')->nullable();
            $table->string('status')->nullable();
            $table->float('temperature')->nullable();
            $table->float('ph')->nullable();
            $table->float('dhl')->nullable();
            $table->float('tds')->nullable();
            $table->float('tss')->nullable();
            $table->float('do')->nullable();
            $table->float('bod')->nullable();
            $table->float('cod')->nullable();
            $table->float('no_2')->nullable();
            $table->float('no_3')->nullable();
            $table->float('nh_2')->nullable();
            $table->float('clorin')->nullable();
            $table->float('total_fosfat')->nullable();
            $table->float('fenol')->nullable();
            $table->float('oil')->nullable();
            $table->float('detergent')->nullable();
            $table->float('fecal_coliform')->nullable();
            $table->float('total_coliform')->nullable();
            $table->float('cyanide')->nullable();
            $table->float('h2s')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qualities');
    }
};

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
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('current_latitude', $precision = 11, $scale = 8);
            $table->decimal('current_longitude', $precision = 11, $scale = 8);
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('additional_data')->nullable();
            $table->string('zip_code');
            $table->string('country');
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
        Schema::dropIfExists('location');
    }
};

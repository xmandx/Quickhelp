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
        Schema::create('adress', function (Blueprint $table) {
            $table->id('id_address');
            $table->unsignedBigInteger('id_user');
            $table->string('state_address', 85);
            $table->string('city_address', 85);
            $table->string('neighborhood_address', 85);
            $table->string('street_address', 85);
            $table->string('number_address', 20);
            $table->string('complement_address', 255)->nullable();
            
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adress');
    }
};

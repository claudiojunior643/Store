<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 50);
            $table->string('model', 100);
            $table->string('plate',9);
            $table->string('year_manufacture', 4);
            $table->string('year_model', 4);
            $table->string('chassi', 50)->unique();
            $table->string('color', 10);
            $table->boolean('key')->default(true);
            $table->boolean('manual')->default(true);
            $table->string('sound');
            $table->string('optional');
            $table->string('ipva', 11);
            $table->float('km');

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
        Schema::dropIfExists('vehicles');
    }
}

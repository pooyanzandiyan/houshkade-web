<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('isEnabled')->default(false);
            $table->string('name')->nullable();
            $table->string('serial');
            $table->boolean('isReadLocation')->default(false);
            $table->multiPoint('locations')->nullable();
            $table->string('wifi_name');
            $table->string('wifi_password');
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
        Schema::dropIfExists('devices');
    }
}

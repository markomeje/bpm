<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify', function (Blueprint $table) {
            $table->id();
            $table->dateTime('otpexpiry')->nullable();
            $table->dateTime('tokenexpiry')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('otp')->nullable();
            $table->string('token')->nullable();
            $table->boolean('emailactive')->default(false);
            $table->string('reference')->nullable();
            $table->boolean('phoneactive')->default(false);
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
        Schema::dropIfExists('verify');
    }
}

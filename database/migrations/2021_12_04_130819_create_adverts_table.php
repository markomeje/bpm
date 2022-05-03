<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('description')->nullable();
            $table->dateTime('started')->nullable();
            $table->text('link')->nullable();
            $table->bigInteger('clicks')->nullable();
            $table->foreignId('credit_id');
            $table->string('size')->nullable();
            $table->dateTime('expiry')->nullable();
            $table->string('status')->default('initialized');
            $table->string('reference');
            $table->dateTime('paused_at')->nullable();
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
        Schema::dropIfExists('adverts');
    }
}

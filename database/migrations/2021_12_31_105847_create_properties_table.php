<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->string('action');
            $table->bigInteger('bedrooms')->nullable();
            $table->string('category');
            $table->bigInteger('price');
            $table->bigInteger('toilets')->nullable();
            $table->foreignId('user_id');
            $table->string('state');
            $table->string('condition')->nullable();
            $table->string('address');
            $table->string('listed')->default('no');
            $table->bigInteger('bathrooms')->nullable();
            $table->string('measurement');
            $table->bigInteger('likes')->nullable();
            $table->string('city');
            $table->string('group')->nullable();
            $table->text('additional')->nullable();
            $table->string('status')->default('inactive');
            $table->text('reference')->nullable();
            $table->bigInteger('views')->default(0);
            $table->foreignId('currency_id');
            $table->boolean('promoted')->default(false);
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
        Schema::dropIfExists('properties');
    }
}

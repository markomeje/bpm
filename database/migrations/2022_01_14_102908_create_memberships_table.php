<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('price');
            $table->foreignId('currency_id')->nullable();
            $table->string('name');
            $table->bigInteger('paidlisting')->nullable();
            $table->bigInteger('freelisting')->nullable();
            $table->text('details')->nullable();
            $table->bigInteger('freeboost')->nullable();
            $table->text('duration');
            $table->string('status')->default('active');
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
        Schema::dropIfExists('memberships');
    }
}

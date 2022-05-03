<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('designation');
            $table->string('state');
            $table->string('companyname')->nullable();
            $table->string('companylogo')->nullable();
            $table->string('type')->default('normal');
            $table->string('role');
            $table->string('document')->nullable();
            $table->string('website')->nullable();
            $table->text('description');
            $table->string('city');
            $table->string('address');
            $table->foreignId('country_id');
            $table->string('idnumber')->nullable();
            $table->string('status')->default('inactive');
            $table->string('rcnumber')->nullable();
            $table->string('code')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('certified')->default(false);
            $table->string('reference');
            $table->boolean('promoted')->default(false);
            $table->boolean('partner')->default(false);
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
        Schema::dropIfExists('profiles');
    }
}

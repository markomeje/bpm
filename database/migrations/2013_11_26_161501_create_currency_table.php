<?php

use Illuminate\Database\Migrations\Migration;

class CreateCurrencyTable extends Migration
{
    /**
     * Currencies table name
     *
     * @var string
     */
    protected $table;

    /**
     * Create a new migration instance.
     */
    public function __construct()
    {
        $this->table = config('currency.drivers.database.table');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('code', 10)->index();
            $table->string('symbol', 25);
            $table->string('format', 50)->nullable();
            $table->string('exchange_rate')->default(0);
            $table->boolean('active')->default(false);
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
        Schema::drop($this->table);
    }
}

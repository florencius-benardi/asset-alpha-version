<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSeriesLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_series_line', function (Blueprint $table) {
            $table->integer('id_transaction_series');
            $table->string('starting_no', 21);
            $table->string('ending_no', 21);
            $table->date('starting_date');
            $table->date('ending_date');
            $table->string('last_no_used', 50)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
            $table->string('module', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_series_line');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetHandoverHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handover_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_series_document')->unsigned()->nullable();
            $table->string('document_no', 30)->nullable();
            $table->date('transaction_date');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->string('notes', 100)->nullable();
            $table->smallInteger('status')->default(0);
            $table->smallInteger('count_printed')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('handover_headers');
    }
}

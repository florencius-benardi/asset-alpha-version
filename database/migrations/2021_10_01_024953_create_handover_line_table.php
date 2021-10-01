<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetHandoverLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handover_lines', function (Blueprint $table) {
            $table->smallInteger('line_no');
            $table->integer('document_handover_id');
            $table->integer('material_group_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->decimal('quantity', 8, 2);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('handover_lines');
    }
}

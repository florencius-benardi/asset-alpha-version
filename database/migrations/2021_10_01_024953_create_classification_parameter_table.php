<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classification_parameter', function (Blueprint $table) {
            $table->id();
            $table->integer('classification_id')->nullable();
            $table->string('name', 30);
            $table->integer('type')->nullable();
            $table->integer('length')->nullable();
            $table->integer('decimal')->nullable();
            $table->string('value')->nullable();
            $table->integer('reading')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('classification_parameter');
    }
}

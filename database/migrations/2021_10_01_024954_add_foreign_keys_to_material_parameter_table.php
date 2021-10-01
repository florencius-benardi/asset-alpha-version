<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMaterialParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_parameter', function (Blueprint $table) {
            $table->foreign(['updated_by'])->references(['id'])->on('users');
            $table->foreign(['created_by'])->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_parameter', function (Blueprint $table) {
            $table->dropForeign('material_parameter_updated_by_foreign');
            $table->dropForeign('material_parameter_created_by_foreign');
        });
    }
}

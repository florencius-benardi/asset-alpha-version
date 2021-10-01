<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMaterialImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_image', function (Blueprint $table) {
            $table->foreign(['updated_by'])->references(['id'])->on('users');
            $table->foreign(['created_by'])->references(['id'])->on('users');
            $table->foreign(['material_id'])->references(['id'])->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_image', function (Blueprint $table) {
            $table->dropForeign('material_image_updated_by_foreign');
            $table->dropForeign('material_image_created_by_foreign');
            $table->dropForeign('material_image_id_material_foreign');
        });
    }
}

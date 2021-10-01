<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->foreign(['classification_id'])->references(['id'])->on('classification');
            $table->foreign(['material_group_id'])->references(['id'])->on('material_group');
            $table->foreign(['created_by'])->references(['id'])->on('users');
            $table->foreign(['updated_by'])->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign('materials_id_classification_foreign');
            $table->dropForeign('materials_id_material_group_foreign');
            $table->dropForeign('materials_created_by_foreign');
            $table->dropForeign('materials_updated_by_foreign');
        });
    }
}

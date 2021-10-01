<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDepreciationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depreciation', function (Blueprint $table) {
            $table->foreign(['updated_by'])->references(['id'])->on('users');
            $table->foreign(['created_by'])->references(['id'])->on('users');
            $table->foreign(['depreciation_id_type'])->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depreciation', function (Blueprint $table) {
            $table->dropForeign('depreciation_updated_by_foreign');
            $table->dropForeign('depreciation_created_by_foreign');
            $table->dropForeign('depreciation_depreciation_id_type_foreign');
        });
    }
}

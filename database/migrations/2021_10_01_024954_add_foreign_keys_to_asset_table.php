<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset', function (Blueprint $table) {
            $table->foreign(['depreciation_id'])->references(['id'])->on('depreciation');
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
        Schema::table('asset', function (Blueprint $table) {
            $table->dropForeign('asset_depreciation_id_foreign');
            $table->dropForeign('asset_updated_by_foreign');
            $table->dropForeign('asset_created_by_foreign');
        });
    }
}

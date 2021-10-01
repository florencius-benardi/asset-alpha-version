<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetDepreciationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_depreciation_history', function (Blueprint $table) {
            $table->foreign(['updated_by'])->references(['id'])->on('users');
            $table->foreign(['created_by'])->references(['id'])->on('users');
            $table->foreign(['asset_id'])->references(['asset_id'])->on('asset');
            $table->foreign(['depreciation_id'])->references(['id'])->on('depreciation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_depreciation_history', function (Blueprint $table) {
            $table->dropForeign('asset_depreciation_history_updated_by_foreign');
            $table->dropForeign('asset_depreciation_history_created_by_foreign');
            $table->dropForeign('asset_depreciation_history_asset_id_foreign');
            $table->dropForeign('asset_depreciation_history_depreciation_id_foreign');
        });
    }
}

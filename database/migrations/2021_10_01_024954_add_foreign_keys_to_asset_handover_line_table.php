<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetHandoverLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_handover_line', function (Blueprint $table) {
            $table->foreign(['document_handover_id'])->references(['id'])->on('handover_headers');
            $table->foreign(['asset_id'])->references(['asset_id'])->on('asset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_handover_line', function (Blueprint $table) {
            $table->dropForeign('asset_handover_line_document_handover_id_foreign');
            $table->dropForeign('asset_handover_line_asset_id_foreign');
        });
    }
}

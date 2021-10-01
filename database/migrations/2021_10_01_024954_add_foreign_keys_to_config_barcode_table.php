<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToConfigBarcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config_barcode', function (Blueprint $table) {
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
        Schema::table('config_barcode', function (Blueprint $table) {
            $table->dropForeign('config_barcode_created_by_foreign');
            $table->dropForeign('config_barcode_updated_by_foreign');
        });
    }
}

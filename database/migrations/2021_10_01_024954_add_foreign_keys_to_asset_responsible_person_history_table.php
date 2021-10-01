<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetResponsiblePersonHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_responsible_person_history', function (Blueprint $table) {
            $table->foreign(['created_by'])->references(['id'])->on('users');
            $table->foreign(['updated_by'])->references(['id'])->on('users');
            $table->foreign(['employee_id'])->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_responsible_person_history', function (Blueprint $table) {
            $table->dropForeign('asset_responsible_person_history_created_by_foreign');
            $table->dropForeign('asset_responsible_person_history_updated_by_foreign');
            $table->dropForeign('asset_responsible_person_history_employee_id_foreign');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToModulesObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modules_object', function (Blueprint $table) {
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
        Schema::table('modules_object', function (Blueprint $table) {
            $table->dropForeign('modules_object_updated_by_foreign');
            $table->dropForeign('modules_object_created_by_foreign');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLocationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_type', function (Blueprint $table) {
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
        Schema::table('location_type', function (Blueprint $table) {
            $table->dropForeign('location_type_created_by_foreign');
            $table->dropForeign('location_type_updated_by_foreign');
        });
    }
}

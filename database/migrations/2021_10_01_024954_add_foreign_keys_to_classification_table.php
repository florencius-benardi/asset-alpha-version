<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClassificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classification', function (Blueprint $table) {
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
        Schema::table('classification', function (Blueprint $table) {
            $table->dropForeign('classification_created_by_foreign');
            $table->dropForeign('classification_updated_by_foreign');
        });
    }
}

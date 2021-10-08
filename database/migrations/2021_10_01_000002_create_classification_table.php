<?php

use App\Domain\Master\Classifications\Entities\Classification;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Classification::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Classification::ATTR_INT_ID);
            $table->string(Classification::ATTR_CHAR_NAME, 30);
            $table->integer(Classification::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Classification::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Classification::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Classification::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Classification::ATTR_TABLE);
    }
}

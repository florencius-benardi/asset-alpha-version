<?php

use App\Domain\Orange\Position\Entities\Position;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Position::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Position::ATTR_INT_ID);
            $table->string(Position::ATTR_CHAR_CODE, 15)->unique();
            $table->string(Position::ATTR_CHAR_DESCRIPTION, 50);
            $table->integer(Position::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Position::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Position::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Position::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Position::ATTR_TABLE);
    }
}

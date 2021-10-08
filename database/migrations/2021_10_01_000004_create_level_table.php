<?php

use App\Domain\Orange\Level\Entities\Level;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Level::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Level::ATTR_INT_ID);
            $table->string(Level::ATTR_CHAR_CODE, 15)->unique();
            $table->string(Level::ATTR_CHAR_DESCRIPTION, 50);
            $table->integer(Level::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Level::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Level::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Level::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Level::ATTR_TABLE);
    }
}

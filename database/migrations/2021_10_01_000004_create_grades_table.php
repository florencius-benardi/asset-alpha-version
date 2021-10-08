<?php

use App\Domain\Orange\Grade\Entities\Grade;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Grade::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Grade::ATTR_INT_ID);
            $table->string(Grade::ATTR_CHAR_CODE, 15)->unique();
            $table->string(Grade::ATTR_CHAR_DESCRIPTION, 50);
            $table->integer(Grade::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Grade::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Grade::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Grade::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Grade::ATTR_TABLE);
    }
}

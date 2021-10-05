<?php

use App\Domain\Master\Materials\Entities\MaterialGroup;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MaterialGroup::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(MaterialGroup::ATTR_INT_ID);
            $table->string(MaterialGroup::ATTR_CHAR_CODE, 9);
            $table->string(MaterialGroup::ATTR_CHAR_DESCRIPTION, 50);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(MaterialGroup::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(MaterialGroup::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(MaterialGroup::ATTR_TABLE);
    }
}

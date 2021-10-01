<?php

use App\Domain\System\UserGroups\Entities\UserGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(UserGroup::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(UserGroup::ATTR_CHAR_CODE, 4)->unique();
            $table->string(UserGroup::ATTR_CHAR_DESCRIPTION, 30);
            $table->integer(UserGroup::ATTR_INT_CREATED_BY)->unsigned();
            $table->integer(UserGroup::ATTR_INT_UPDATED_BY)->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(UserGroup::ATTR_TABLE);
    }
}

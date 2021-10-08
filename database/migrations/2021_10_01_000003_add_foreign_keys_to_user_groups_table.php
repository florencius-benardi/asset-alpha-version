<?php

use App\Domain\System\UserGroups\Entities\UserGroup;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(UserGroup::ATTR_TABLE, function (Blueprint $table) {
            $table->foreign(User::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(User::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(UserGroup::ATTR_TABLE, function (Blueprint $table) {
            $table->dropForeign('user_groups_created_by_foreign');
            $table->dropForeign('user_groups_updated_by_foreign');
        });
    }
}

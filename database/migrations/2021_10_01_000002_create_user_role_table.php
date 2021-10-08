<?php

use App\Domain\System\Roles\Entities\Role;
use App\Domain\System\UserRoles\Entities\UserRole;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(UserRole::ATTR_TABLE, function (Blueprint $table) {
            $table->integer(UserRole::ATTR_INT_USER);
            $table->integer(UserRole::ATTR_INT_ROLE);
            $table->integer(UserRole::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(UserRole::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->foreign(UserRole::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(UserRole::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(UserRole::ATTR_INT_ROLE)->constrained(Role::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(UserRole::ATTR_INT_USER)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(UserRole::ATTR_TABLE);
    }
}

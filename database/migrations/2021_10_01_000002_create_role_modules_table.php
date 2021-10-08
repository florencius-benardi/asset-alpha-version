<?php

use App\Domain\System\Modules\Entities\Module;
use App\Domain\System\RoleModules\Entities\RoleModule;
use App\Domain\System\Roles\Entities\Role;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RoleModule::ATTR_TABLE, function (Blueprint $table) {
            $table->integer(RoleModule::ATTR_INT_ROLE);
            $table->integer(RoleModule::ATTR_INT_MODULE);
            $table->integer(RoleModule::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(RoleModule::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->foreign(RoleModule::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(RoleModule::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(RoleModule::ATTR_INT_ROLE)->on(Role::ATTR_INT_ID)->references(Role::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(RoleModule::ATTR_INT_MODULE)->on(Module::ATTR_INT_ID)->references(Module::ATTR_TABLE)->onDelete('SET NULL');
            $table->unique([RoleModule::ATTR_INT_ROLE, RoleModule::ATTR_INT_MODULE]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(RoleModule::ATTR_TABLE);
    }
}

<?php

use App\Domain\System\Modules\Entities\Module;
use App\Domain\System\RoleModuless\Entities\RoleModule;
use App\Domain\System\Roles\Entities\Role;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleModuleObjectTable extends Migration
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
            $table->bigInteger(RoleModule::ATTR_INT_CREATED_BY);
            $table->bigInteger(RoleModule::ATTR_INT_UPDATED_BY);
            $table->timestamps();
            $table->foreignId(RoleModule::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(RoleModule::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(RoleModule::ATTR_INT_ROLE)->constrained(Role::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(RoleModule::ATTR_INT_MODULE)->constrained(Module::ATTR_TABLE)->onDelete('SET NULL');
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

<?php

use App\Domain\System\Roles\Entities\Role;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Role::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Role::ATTR_INT_ID);
            $table->string(Role::ATTR_CHAR_DESCRIPTION, 50)->unique();
            $table->integer(Role::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Role::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(Role::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(Role::TTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Role::ATTR_TABLE);
    }
}

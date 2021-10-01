<?php

use App\Domain\System\Modules\Entities\Module;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Module::ATTR_TABLE, function (Blueprint $table) {
            $table->foreignId(Module::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(Module::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Module::ATTR_TABLE, function (Blueprint $table) {
            $table->dropForeign('modules_created_by_foreign');
            $table->dropForeign('modules_updated_by_foreign');
        });
    }
}

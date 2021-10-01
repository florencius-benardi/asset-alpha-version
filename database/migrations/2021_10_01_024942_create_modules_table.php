<?php

use App\Domain\System\Modules\Entities\Module;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Module::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Module::ATTR_INT_ID);
            $table->string(Module::ATTR_CHAR_DESCRIPTION, 50);
            $table->bigIncrements(Module::ATTR_INT_CREATED_BY);
            $table->bigIncrements(Module::ATTR_INT_UPDATED_BY);
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
        Schema::dropIfExists(Module::ATTR_TABLE);
    }
}

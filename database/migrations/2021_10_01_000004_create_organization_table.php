<?php

use App\Domain\Orange\Organization\Entities\Organization;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Organization::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Organization::ATTR_INT_ID);
            $table->string(Organization::ATTR_CHAR_CODE, 15)->unique();
            $table->string(Organization::ATTR_CHAR_DESCRIPTION, 50);
            $table->integer(Organization::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Organization::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Organization::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Organization::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Organization::ATTR_TABLE);
    }
}

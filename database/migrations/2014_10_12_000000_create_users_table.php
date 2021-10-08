<?php

use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(User::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(User::ATTR_INT_ID);
            $table->string(User::ATTR_CHAR_NAME);
            $table->string(User::ATTR_CHAR_EMAIL)->unique();
            $table->string(User::ATTR_CHAR_PASSWORD);
            $table->rememberToken();
            $table->smallInteger(User::ATTR_INT_STATUS)->default(0);
            $table->string(User::ATTR_CHAR_IMAGE)->nullable();
            $table->timestamp(User::ATTR_DATETIME_VERIFIED)->nullable();
            $table->integer(User::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(User::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
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
        Schema::dropIfExists(User::ATTR_TABLE);
    }
}

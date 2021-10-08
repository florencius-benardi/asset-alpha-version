<?php

use App\Domain\Master\RetiredReasons\Entities\RetiredReason;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetiredReasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RetiredReason::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(RetiredReason::ATTR_INT_ID);
            $table->string(RetiredReason::ATTR_CHAR_CODE, 15)->unique();
            $table->string(RetiredReason::ATTR_CHAR_DESCRIPTION, 100);
            $table->integer(RetiredReason::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(RetiredReason::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(RetiredReason::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(RetiredReason::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(RetiredReason::ATTR_TABLE);
    }
}

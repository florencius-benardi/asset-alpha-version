<?php

use App\Domain\Master\ReasonCodes\Entities\ReasonCode;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReasonCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ReasonCode::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(ReasonCode::ATTR_INT_ID);
            $table->string(ReasonCode::ATTR_CHAR_CODE, 15)->unique();
            $table->string(ReasonCode::ATTR_CHAR_DESCRIPTION, 100);
            $table->integer(ReasonCode::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(ReasonCode::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(ReasonCode::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(ReasonCode::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ReasonCode::ATTR_TABLE);
    }
}

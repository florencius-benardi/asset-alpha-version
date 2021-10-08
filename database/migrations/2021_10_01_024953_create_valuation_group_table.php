<?php

use App\Domain\Master\ValuationGroups\Entities\ValuationGroup;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ValuationGroup::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(ValuationGroup::ATTR_CHAR_CODE, 10)->unique();
            $table->string(ValuationGroup::ATTR_CHAR_NAME, 100)->nullable();
            $table->integer(ValuationGroup::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(ValuationGroup::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(ValuationGroup::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(ValuationGroup::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ValuationGroup::ATTR_TABLE);
    }
}

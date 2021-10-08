<?php

use App\Domain\Orange\Employee\Entities\Employee;
use App\Domain\System\NoSeries\Entities\NoSeries;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\HandOvers\Entities\HandOverHeader;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetHandoverHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(HandOverHeader::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(HandOverHeader::ATTR_INT_NO_SERIES)->unsigned()->nullable();
            $table->string(HandOverHeader::ATTR_CHAR_DOCUMENT_NO, 30)->unsigned();
            $table->date(HandOverHeader::ATTR_DATE_TRANSACTION);
            $table->bigInteger(HandOverHeader::ATTR_INT_EMPLOYEE)->unsigned()->nullable();
            $table->mediumText(HandOverHeader::ATTR_CHAR_NOTES)->nullable();
            $table->smallInteger(HandOverHeader::ATTR_INT_STATUS)->default(0);
            $table->smallInteger(HandOverHeader::ATTR_INT_COUNT_PRINTED)->default(0);
            $table->integer(HandOverHeader::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(HandOverHeader::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(HandOverHeader::ATTR_INT_NO_SERIES)->constrained(NoSeries::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverHeader::ATTR_INT_EMPLOYEE)->constrained(Employee::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverHeader::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(HandOverHeader::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(HandOverHeader::ATTR_TABLE);
    }
}

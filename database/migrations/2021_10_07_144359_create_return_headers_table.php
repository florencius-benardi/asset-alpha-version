<?php

use App\Domain\Master\RetiredReasons\Entities\RetiredReason;
use App\Domain\Orange\Employee\Entities\Employee;
use App\Domain\System\NoSeries\Entities\NoSeries;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Returns\Entities\ReturnHeader;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ReturnHeader::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(ReturnHeader::ATTR_INT_NO_SERIES)->unsigned()->nullable();
            $table->string(ReturnHeader::ATTR_CHAR_DOCUMENT_NO, 30)->unsigned();
            $table->date(ReturnHeader::ATTR_DATE_TRANSACTION);
            $table->bigInteger(ReturnHeader::ATTR_INT_EMPLOYEE)->unsigned()->nullable();
            $table->smallInteger(ReturnHeader::ATTR_INT_STATUS)->default(0);
            $table->mediumText(ReturnHeader::ATTR_CHAR_NOTES)->nullable();
            $table->integer(ReturnHeader::ATTR_INT_RETIRED_REASON);
            $table->smallInteger(ReturnHeader::ATTR_INT_STATUS)->default(0);
            $table->smallInteger(ReturnHeader::ATTR_INT_COUNT_PRINTED)->default(0);
            $table->integer(ReturnHeader::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(ReturnHeader::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(ReturnHeader::ATTR_INT_RETIRED_REASON)->constrained(RetiredReason::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnHeader::ATTR_INT_NO_SERIES)->constrained(NoSeries::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnHeader::ATTR_INT_EMPLOYEE)->constrained(Employee::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnHeader::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(ReturnHeader::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ReturnHeader::ATTR_TABLE);
    }
}

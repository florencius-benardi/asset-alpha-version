<?php

use App\Domain\Orange\Employee\Entities\Employee;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Assets\Entities\Asset;
use App\Domain\Transaction\Assets\Entities\AssetEmployeeHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetResponsiblePersonHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AssetEmployeeHistory::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(AssetEmployeeHistory::ATTR_INT_ASSET)->unsigned();
            $table->integer(AssetEmployeeHistory::ATTR_INT_EMPLOYEE)->unsigned();
            $table->integer(AssetEmployeeHistory::ATTR_INT_SEQUENCE)->unsigned();
            $table->date(AssetEmployeeHistory::ATTR_DATE_EFFECTIVE)->nullable();
            $table->integer(AssetEmployeeHistory::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(AssetEmployeeHistory::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(AssetEmployeeHistory::ATTR_INT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(AssetEmployeeHistory::ATTR_INT_EMPLOYEE)->constrained(Employee::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(AssetEmployeeHistory::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(AssetEmployeeHistory::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->unique([AssetEmployeeHistory::ATTR_INT_SEQUENCE, AssetEmployeeHistory::ATTR_INT_ASSET]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(AssetEmployeeHistory::ATTR_TABLE);
    }
}

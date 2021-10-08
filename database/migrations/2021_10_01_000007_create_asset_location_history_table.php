<?php

use App\Domain\Master\Locations\Entities\Location;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Assets\Entities\Asset;
use App\Domain\Transaction\Assets\Entities\AssetLocationHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetLocationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AssetLocationHistory::ATTR_TABLE, function (Blueprint $table) {
            $table->integer(AssetLocationHistory::ATTR_INT_SEQUENCE)->unsigned();
            $table->date(AssetLocationHistory::ATTR_DATE_EFFECTIVE)->nullable();
            $table->integer(AssetLocationHistory::ATTR_INT_ASSET)->unsigned();
            $table->integer(AssetLocationHistory::ATTR_INT_LOCATION)->unsigned();
            $table->integer(AssetLocationHistory::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(AssetLocationHistory::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(AssetLocationHistory::ATTR_INT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(AssetLocationHistory::ATTR_INT_LOCATION)->constrained(Location::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(AssetLocationHistory::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(AssetLocationHistory::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->unique([AssetLocationHistory::ATTR_INT_SEQUENCE, AssetLocationHistory::ATTR_INT_ASSET]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(AssetLocationHistory::ATTR_TABLE);
    }
}

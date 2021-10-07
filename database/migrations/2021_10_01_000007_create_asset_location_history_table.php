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
            $table->id();
            $table->integer(AssetLocationHistory::ATTR_INT_ASSET)->unsigned();
            $table->integer(AssetLocationHistory::ATTR_INT_LOCATION)->unsigned();
            $table->integer(AssetLocationHistory::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(AssetLocationHistory::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(AssetLocationHistory::ATTR_INT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreignId(AssetLocationHistory::ATTR_INT_LOCATION)->constrained(Location::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreignId(AssetLocationHistory::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(AssetLocationHistory::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
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

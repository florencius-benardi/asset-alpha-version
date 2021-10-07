<?php

use App\Domain\Master\Depreciations\Entities\Depreciation;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Assets\Entities\Asset;
use App\Domain\Transaction\Assets\Entities\AssetDepreciationHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDepreciationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AssetDepreciationHistory::ATTR_TABLE, function (Blueprint $table) {
            $table->integer(AssetDepreciationHistory::ATTR_INT_ASSET);
            $table->integer(AssetDepreciationHistory::ATTR_INT_DEPRECIATION)->unsigned();
            $table->integer(AssetDepreciationHistory::ATTR_INT_SEQUENCE)->unsigned();
            $table->decimal(AssetDepreciationHistory::ATTR_DECIMAL_AMOUNT, 20, 3);
            $table->date(AssetDepreciationHistory::ATTR_DATE_PERIODE);
            $table->decimal(AssetDepreciationHistory::ATTR_DECIMAL_SALVAGE_VALUE, 12);
            $table->boolean(AssetDepreciationHistory::ATTR_BOOL_ACTIVE)->default(true);
            $table->integer(AssetDepreciationHistory::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(AssetDepreciationHistory::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(AssetDepreciationHistory::ATTR_INT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreignId(AssetDepreciationHistory::ATTR_INT_DEPRECIATION)->constrained(Depreciation::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreignId(AssetDepreciationHistory::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(AssetDepreciationHistory::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(AssetDepreciationHistory::ATTR_TABLE);
    }
}

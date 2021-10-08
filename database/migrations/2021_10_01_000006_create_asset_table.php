<?php

use App\Domain\Master\Depreciations\Entities\Depreciation;
use App\Domain\Master\Depreciations\Entities\DepreciationType;
use App\Domain\Master\Locations\Entities\Location;
use App\Domain\Master\Storages\Entities\Storage;
use App\Domain\Master\Vendors\Entities\Vendor;
use App\Domain\Orange\Employee\Entities\Employee;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Assets\Entities\Asset;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Asset::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Asset::ATTR_CHAR_CODE, 30)->unique();
            $table->bigInteger(Asset::ATTR_INT_ASSET_TYPE)->nullable()->unsigned();
            $table->bigInteger(Asset::ATTR_INT_ASSET_OWNER_GROUP)->nullable()->unsigned();
            $table->bigInteger(Asset::ATTR_INT_MATERIAL)->unsigned();
            $table->string(Asset::ATTR_CHAR_DESCRIPTION)->nullable();
            $table->string(Asset::ATTR_CHAR_SERIAL, 50)->nullable();
            $table->tinyInteger(Asset::ATTR_INT_LEVEL_ASSET)->default(0);
            $table->bigInteger(Asset::ATTR_INT_PARENT_ASSET)->nullable()->unsigned();
            $table->bigInteger(Asset::ATTR_INT_PREVIOUS_ASSET)->nullable()->unsigned();
            $table->integer(Asset::ATTR_INT_STATUS)->nullable();

            // Purchase History
            $table->date(Asset::ATTR_DATE_PURCHASE)->nullable();
            $table->integer(Asset::ATTR_INT_VENDOR)->nullable();
            $table->decimal(Asset::ATTR_DECIMAL_PURCHASE_PRICE, 20, 2)->default(0);
            $table->string(Asset::ATTR_CHAR_PURCHASE_CURRENCY, 3)->nullable();
            $table->date(Asset::ATTR_DATE_WARRANTY_VALID)->nullable();
            $table->date(Asset::ATTR_DATE_WARRANTY_EXPIRATION)->nullable();

            // Maintenance Schedule 
            $table->smallInteger(Asset::ATTR_INT_MAINTENANCE_CYCLE)->nullable()->unsigned();
            $table->smallInteger(Asset::ATTR_INT_MAINTENANCE_COUNT_DURATION)->nullable()->unsigned();
            $table->smallInteger(Asset::ATTR_INT_MAINTENANCE_UNIT_DURATION)->nullable()->unsigned();
            $table->date(Asset::ATTR_DATE_LAST_MAINTENANCE)->nullable();
            $table->date(Asset::ATTR_DATE_NEXT_MAINTENANCE)->nullable();

            $table->integer(Asset::ATTR_INT_EMPLOYEE)->nullable()->unsigned();
            $table->integer(Asset::ATTR_INT_LOCATION)->nullable()->unsigned();
            $table->integer(Asset::ATTR_INT_STORAGE)->nullable()->unsigned();

            // Retired Asset Field
            $table->integer(Asset::ATTR_DATE_RETIRED_REASON)->nullable();
            $table->date(Asset::ATTR_DATE_RETIRED_DATE)->nullable();
            $table->string(Asset::ATTR_DATE_RETIRED_NOTES, 30)->nullable();

            // Depreciation Field
            $table->boolean(Asset::ATTR_BOOL_ASSET)->default(false);
            $table->bigInteger(Asset::ATTR_INT_DEPRECIATION)->nullable()->unsigned();
            $table->bigInteger(Asset::ATTR_INT_DEPRECIATION_TYPE)->nullable()->unsigned();
            $table->bigInteger(Asset::ATTR_DECIMAL_SALVAGE_VALUE)->nullable()->default(0);

            $table->integer(Asset::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Asset::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Asset::ATTR_INT_EMPLOYEE)->constrained(Employee::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Asset::ATTR_INT_VENDOR)->constrained(Vendor::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Asset::ATTR_INT_STORAGE)->constrained(Storage::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Asset::ATTR_INT_LOCATION)->constrained(Location::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Asset::ATTR_INT_PARENT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Asset::ATTR_INT_PREVIOUS_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Asset::ATTR_INT_DEPRECIATION)->constrained(Depreciation::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Asset::ATTR_INT_DEPRECIATION_TYPE)->constrained(DepreciationType::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Asset::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Asset::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Asset::ATTR_TABLE);
    }
}

<?php

use App\Domain\Master\Locations\Entities\Location;
use App\Domain\Master\Locations\Entities\LocationType;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Location::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Location::ATTR_INT_ID);
            $table->string(Location::ATTR_CHAR_CODE, 8)->unique();
            $table->string(Location::ATTR_CHAR_NAME, 30);
            $table->integer(Location::ATTR_INT_LOCATION_TYPE)->unsigned();
            $table->string(Location::ATTR_CHAR_ADDRESS)->nullable();
            $table->string(Location::ATTR_CHAR_BUILDING)->nullable();
            $table->string(Location::ATTR_CHAR_UNIT)->nullable();
            $table->string(Location::ATTR_CHAR_CITY)->nullable();
            $table->string(Location::ATTR_CHAR_CONTACT)->nullable();
            $table->string(Location::ATTR_CHAR_PHONE)->nullable();
            $table->string(Location::ATTR_CHAR_EMAIL)->nullable();
            $table->string(Location::ATTR_CHAR_LATITUDE, 20)->nullable();
            $table->string(Location::ATTR_CHAR_LONGITUDE, 20)->nullable();
            $table->integer(Location::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Location::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(Location::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(Location::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(Location::ATTR_INT_LOCATION_TYPE)->constrained(LocationType::ATTR_TABLE)->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Location::ATTR_TABLE);
    }
}

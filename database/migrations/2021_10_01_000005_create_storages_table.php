<?php

use App\Domain\Master\Locations\Entities\Location;
use App\Domain\Master\Storages\Entities\Storage;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Storage::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Storage::ATTR_CHAR_CODE, 10)->unique();
            $table->string(Storage::ATTR_CHAR_NAME, 100)->nullable();
            $table->integer(Storage::ATTR_INT_LOCATION)->nullable()->unsigned();
            $table->integer(Storage::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Storage::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(Storage::ATTR_INT_LOCATION)->constrained(Location::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreignId(Storage::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(Storage::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Storage::ATTR_TABLE);
    }
}

<?php

use App\Domain\Master\Locations\Entities\LocationType;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(LocationType::ATTR_TABLE, function (Blueprint $table) {
            $table->smallIncrements(LocationType::ATTR_INT_ID);
            $table->string(LocationType::ATTR_CHAR_NAME)->nullable();
            $table->string(LocationType::ATTR_CHAR_ICON_IMAGE)->nullable();
            $table->integer(LocationType::ATTR_INT_ZOOM_LEVEL_START)->nullable();
            $table->integer(LocationType::ATTR_INT_ZOOM_LEVEL_END)->nullable();
            $table->integer(LocationType::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(LocationType::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(LocationType::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(LocationType::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(LocationType::ATTR_TABLE);
    }
}

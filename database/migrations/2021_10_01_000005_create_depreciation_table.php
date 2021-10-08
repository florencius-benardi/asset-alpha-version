<?php

use App\Domain\Master\Depreciations\Entities\Depreciation;
use App\Domain\Master\Depreciations\Entities\DepreciationType;
use App\Domain\System\Users\Entities\User;
use Doctrine\Deprecations\Deprecation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepreciationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Depreciation::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Depreciation::ATTR_CHAR_NAME, 30);
            $table->smallInteger(Depreciation::ATTR_INT_USEFUL_LIFE);
            $table->smallInteger(Depreciation::ATTR_INT_RATE);
            $table->integer(Depreciation::ATTR_INT_DEPRECIATION_TYPE);
            $table->integer(Depreciation::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Depreciation::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Depreciation::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Depreciation::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Depreciation::ATTR_INT_DEPRECIATION_TYPE)->constrained(DepreciationType::ATTR_TABLE)->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Depreciation::ATTR_TABLE);
    }
}

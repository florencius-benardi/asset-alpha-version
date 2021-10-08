<?php

use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialGroup;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\HandOvers\Entities\HandOverHeader;
use App\Domain\Transaction\HandOvers\Entities\HandOverLine;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetHandoverLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(HandOverLine::ATTR_TABLE, function (Blueprint $table) {
            $table->smallInteger(HandOverLine::ATTR_INT_SEQUENCE)->unsigned();
            $table->bigInteger(HandOverLine::ATTR_INT_HANDOVER_HEADER)->unsigned();
            $table->integer(HandOverLine::ATTR_INT_MATERIAL_GROUP)->unsigned();
            $table->bigInteger(HandOverLine::ATTR_INT_MATERIAL)->unsigned();
            $table->decimal(HandOverLine::ATTR_DECIMAL_QUANTITY, 8, 3)->unsigned();
            $table->boolean(HandOverLine::ATTR_BOOL_FROM_MATRIX);
            $table->integer(HandOverLine::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(HandOverLine::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(HandOverLine::ATTR_INT_HANDOVER_HEADER)->constrained(HandOverHeader::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverLine::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverLine::ATTR_INT_MATERIAL_GROUP)->constrained(MaterialGroup::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverLine::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(HandOverLine::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->unique([HandOverLine::ATTR_INT_SEQUENCE, HandOverLine::ATTR_INT_HANDOVER_HEADER]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(HandOverLine::ATTR_TABLE);
    }
}

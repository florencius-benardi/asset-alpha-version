<?php

use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialGroup;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Assets\Entities\Asset;
use App\Domain\Transaction\HandOvers\Entities\HandOverHeader;
use App\Domain\Transaction\HandOvers\Entities\HandOverLineDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandoverLineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(HandOverLineDetail::ATTR_TABLE, function (Blueprint $table) {
            $table->bigInteger(HandOverLineDetail::ATTR_INT_HANDOVER_HEADER)->unsigned();
            $table->smallInteger(HandOverLineDetail::ATTR_INT_HANDOVER_LINE_NO)->unsigned();
            $table->smallInteger(HandOverLineDetail::ATTR_INT_SEQUENCE)->unsigned();
            $table->bigInteger(HandOverLineDetail::ATTR_INT_ASSET)->unsigned();
            $table->integer(HandOverLineDetail::ATTR_INT_MATERIAL_GROUP)->unsigned();
            $table->bigInteger(HandOverLineDetail::ATTR_INT_MATERIAL)->unsigned();
            $table->decimal(HandOverLineDetail::ATTR_DECIMAL_QUANTITY, 8, 3)->unsigned();
            $table->decimal(HandOverLineDetail::ATTR_DECIMAL_PRICE, 20, 3)->unsigned();
            $table->integer(HandOverLineDetail::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(HandOverLineDetail::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(HandOverLineDetail::ATTR_INT_HANDOVER_HEADER)->constrained(HandOverHeader::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverLineDetail::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverLineDetail::ATTR_INT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverLineDetail::ATTR_INT_MATERIAL_GROUP)->constrained(MaterialGroup::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(HandOverLineDetail::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(HandOverLineDetail::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->unique([HandOverLineDetail::ATTR_INT_SEQUENCE, HandOverLineDetail::ATTR_INT_HANDOVER_HEADER, HandOverLineDetail::ATTR_INT_HANDOVER_LINE_NO]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(HandOverLineDetail::ATTR_TABLE);
    }
}

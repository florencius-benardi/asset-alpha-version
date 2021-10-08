<?php

use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialGroup;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Assets\Entities\Asset;
use App\Domain\Transaction\Returns\Entities\ReturnHeader;
use App\Domain\Transaction\Returns\Entities\ReturnLineDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnLineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ReturnLineDetail::ATTR_TABLE, function (Blueprint $table) {
            $table->bigInteger(ReturnLineDetail::ATTR_INT_RETURN_HEADER)->unsigned();
            $table->smallInteger(ReturnLineDetail::ATTR_INT_RETURN_LINE_NO)->unsigned();
            $table->smallInteger(ReturnLineDetail::ATTR_INT_SEQUENCE)->unsigned();
            $table->bigInteger(ReturnLineDetail::ATTR_INT_ASSET)->unsigned();
            $table->integer(ReturnLineDetail::ATTR_INT_MATERIAL_GROUP)->unsigned();
            $table->bigInteger(ReturnLineDetail::ATTR_INT_MATERIAL)->unsigned();
            $table->decimal(ReturnLineDetail::ATTR_DECIMAL_QUANTITY, 8, 3)->unsigned();
            $table->decimal(ReturnLineDetail::ATTR_DECIMAL_PRICE, 20, 3)->unsigned();
            $table->integer(ReturnLineDetail::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(ReturnLineDetail::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(ReturnLineDetail::ATTR_INT_RETURN_HEADER)->constrained(ReturnHeader::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnLineDetail::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnLineDetail::ATTR_INT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnLineDetail::ATTR_INT_MATERIAL_GROUP)->constrained(MaterialGroup::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnLineDetail::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(ReturnLineDetail::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->unique([ReturnLineDetail::ATTR_INT_SEQUENCE, ReturnLineDetail::ATTR_INT_RETURN_HEADER, ReturnLineDetail::ATTR_INT_RETURN_LINE_NO]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ReturnLineDetail::ATTR_TABLE);
    }
}

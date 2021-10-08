<?php

use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialGroup;
use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Returns\Entities\ReturnHeader;
use App\Domain\Transaction\Returns\Entities\ReturnLine;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ReturnLine::ATTR_TABLE, function (Blueprint $table) {
            $table->smallInteger(ReturnLine::ATTR_INT_SEQUENCE)->unsigned();
            $table->bigInteger(ReturnLine::ATTR_INT_RETURN_HEADER)->unsigned();
            $table->integer(ReturnLine::ATTR_INT_MATERIAL_GROUP)->unsigned();
            $table->bigInteger(ReturnLine::ATTR_INT_MATERIAL)->unsigned();
            $table->decimal(ReturnLine::ATTR_DECIMAL_QUANTITY, 8, 3)->unsigned();
            $table->boolean(ReturnLine::ATTR_BOOLEAN_REUSE)->default(false);
            $table->integer(ReturnLine::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(ReturnLine::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(ReturnLine::ATTR_INT_RETURN_HEADER)->constrained(ReturnHeader::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnLine::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnLine::ATTR_INT_MATERIAL_GROUP)->constrained(MaterialGroup::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(ReturnLine::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(ReturnLine::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->unique([ReturnLine::ATTR_INT_SEQUENCE, ReturnLine::ATTR_INT_RETURN_HEADER]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ReturnLine::ATTR_TABLE);
    }
}

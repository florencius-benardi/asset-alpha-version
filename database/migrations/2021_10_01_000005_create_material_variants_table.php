<?php

use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialVariant;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MaterialVariant::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(MaterialVariant::ATTR_INT_MATERIAL)->unsigned();
            $table->string(MaterialVariant::ATTR_CHAR_CODE, 30);
            $table->json(MaterialVariant::ATTR_JSON_DETAIL_VARIANT);
            $table->integer(MaterialVariant::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(MaterialVariant::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(MaterialVariant::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(MaterialVariant::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(MaterialVariant::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('CASCADE');
            $table->unique([MaterialVariant::ATTR_INT_MATERIAL, MaterialVariant::ATTR_CHAR_CODE]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(MaterialVariant::ATTR_TABLE);
    }
}

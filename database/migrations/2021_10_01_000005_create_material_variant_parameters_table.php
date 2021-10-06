<?php

use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialVariantField;
use App\Domain\Master\Materials\Entities\MaterialVariantParameter;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialVariantParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MaterialVariantParameter::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(MaterialVariantParameter::ATTR_INT_MATERIAL)->unsigned();
            $table->bigInteger(MaterialVariantParameter::ATTR_INT_VARIANT_FIELD)->unsigned();
            $table->string(MaterialVariantParameter::ATTR_CHAR_VALUE, 100);
            $table->integer(MaterialVariantParameter::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(MaterialVariantParameter::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(MaterialVariantParameter::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(MaterialVariantParameter::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(MaterialVariantParameter::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('CASCADE');
            $table->foreignId(MaterialVariantParameter::ATTR_INT_VARIANT_FIELD)->constrained(MaterialVariantField::ATTR_TABLE)->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(MaterialVariantParameter::ATTR_TABLE);
    }
}

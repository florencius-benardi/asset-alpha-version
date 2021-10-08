<?php

use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialVariantField;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialVariantFieldFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MaterialVariantField::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(MaterialVariantField::ATTR_INT_MATERIAL)->unsigned();
            $table->string(MaterialVariantField::ATTR_CHAR_NAME, 30);
            $table->integer(MaterialVariantField::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(MaterialVariantField::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(MaterialVariantField::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(MaterialVariantField::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(MaterialVariantField::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('CASCADE');
            $table->unique([MaterialVariantField::ATTR_INT_MATERIAL, MaterialVariantField::ATTR_CHAR_NAME]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(MaterialVariantField::ATTR_TABLE);
    }
}

<?php

use App\Domain\Master\Classifications\Entities\Classification;
use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialGroup;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Material::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Material::ATTR_CHAR_CODE, 20)->unique();
            $table->string(Material::ATTR_CHAR_DESCRIPTION, 100);
            $table->integer(Material::ATTR_INT_MATERIAL_GROUP)->unsigned();
            $table->integer(Material::ATTR_INT_MATERIAL_CLASSIFICATION)->nullable();
            $table->boolean(Material::ATTR_BOOL_VARIANT)->default(FALSE);
            $table->integer(Material::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Material::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Material::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Material::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Material::ATTR_INT_MATERIAL_GROUP)->constrained(MaterialGroup::ATTR_TABLE)->onDelete('CASCADE');
            $table->foreign(Material::ATTR_INT_MATERIAL_CLASSIFICATION)->constrained(Classification::ATTR_TABLE)->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Material::ATTR_TABLE);
    }
}

<?php

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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string(Material::ATTR_CHAR_CODE, 20)->unique();
            $table->string(Material::ATTR_CHAR_DESCRIPTION, 100);
            $table->integer('classification_id')->nullable();
            $table->integer(Material::ATTR_INT_MATERIAL_GROUP)->unsigned();
            $table->boolean(Material::ATTR_BOOL_VARIANT)->default(FALSE);
            $table->integer(Material::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Material::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(Material::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(Material::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(Material::ATTR_INT_MATERIAL_GROUP)->constrained(MaterialGroup::ATTR_TABLE)->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}

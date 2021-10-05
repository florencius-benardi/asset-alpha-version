<?php

use App\Domain\Master\Classifications\Entities\ClassificationParameter;
use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialClassificationParameter;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MaterialClassificationParameter::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(MaterialClassificationParameter::ATTR_INT_MATERIAL)->unsigned();
            $table->bigInteger(MaterialClassificationParameter::ATTR_INT_CLASSIFICATION_PARAMETER)->unsigned();
            $table->string(MaterialClassificationParameter::ATTR_CHAR_VALUE, 50)->nullable();
            $table->integer(MaterialClassificationParameter::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(MaterialClassificationParameter::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(MaterialClassificationParameter::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(MaterialClassificationParameter::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(MaterialClassificationParameter::ATTR_INT_CLASSIFICATION_PARAMETER)->constrained(ClassificationParameter::ATTR_TABLE)->onDelete('CASCADE');
            $table->foreignId(MaterialClassificationParameter::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(MaterialClassificationParameter::ATTR_TABLE);
    }
}

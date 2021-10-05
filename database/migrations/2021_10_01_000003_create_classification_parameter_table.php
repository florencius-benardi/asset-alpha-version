<?php

use App\Domain\Master\Classifications\Entities\Classification;
use App\Domain\Master\Classifications\Entities\ClassificationParameter;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationParameterParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ClassificationParameter::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(ClassificationParameter::ATTR_INT_CLASSIFICATION)->unsigned();
            $table->string(ClassificationParameter::ATTR_CHAR_NAME, 30);
            $table->tinyInteger(ClassificationParameter::ATTR_INT_DATA_TYPE);
            $table->smallInteger(ClassificationParameter::ATTR_INT_MAXIMUM_LENGTH)->default(5);
            $table->tinyInteger(ClassificationParameter::ATTR_INT_DECIMAL)->default(0);
            $table->string(ClassificationParameter::ATTR_CHAR_VALUE, 50);
            $table->boolean(ClassificationParameter::ATTR_BOOL_READING_VALUE)->default(TRUE);
            $table->integer(ClassificationParameter::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(ClassificationParameter::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(ClassificationParameter::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(ClassificationParameter::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(ClassificationParameter::ATTR_INT_CLASSIFICATION)->constrained(Classification::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ClassificationParameter::ATTR_TABLE);
    }
}

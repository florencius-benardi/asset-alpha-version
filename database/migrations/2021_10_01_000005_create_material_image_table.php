<?php

use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Materials\Entities\MaterialImage;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MaterialImage::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(MaterialImage::ATTR_INT_ID);
            $table->integer(MaterialImage::ATTR_INT_MATERIAL);
            $table->string(MaterialImage::ATTR_CHAR_FILE);
            $table->string(MaterialImage::ATTR_CHAR_ORIGINAL_FILE_NAME);
            $table->integer(MaterialImage::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(MaterialImage::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(MaterialImage::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(MaterialImage::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(MaterialImage::ATTR_INT_MATERIAL)->constrained(Material::ATTR_TABLE)->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(MaterialImage::ATTR_TABLE);
    }
}

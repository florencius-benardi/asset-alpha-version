<?php

use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Assets\Entities\Asset;
use App\Domain\Transaction\Assets\Entities\AssetImage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AssetImage::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(AssetImage::ATTR_INT_ASSET);
            $table->string(AssetImage::ATTR_CHAR_FILE);
            $table->string(AssetImage::ATTR_CHAR_ORIGINAL_FILE_NAME);
            $table->integer(AssetImage::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(AssetImage::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(AssetImage::ATTR_INT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(AssetImage::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(AssetImage::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(AssetImage::ATTR_TABLE);
    }
}

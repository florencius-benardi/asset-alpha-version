<?php

use App\Domain\Master\AssetTypes\Entities\AssetType;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AssetType::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(AssetType::ATTR_CHAR_CODE, 8)->unique();
            $table->string(AssetType::ATTR_CHAR_NAME, 50);
            $table->integer(AssetType::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(AssetType::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(AssetType::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(AssetType::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(AssetType::ATTR_TABLE);
    }
}

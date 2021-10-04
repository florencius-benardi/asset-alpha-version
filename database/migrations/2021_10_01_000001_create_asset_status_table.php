<?php

use App\Domain\Master\AssetStatus\Entities\AssetStatus;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AssetStatus::ATTR_TABLE, function (Blueprint $table) {
            $table->smallIncrements(AssetStatus::ATTR_INT_ID);
            $table->string(AssetStatus::ATTR_CHAR_CODE, 8)->unique();
            $table->string(AssetStatus::ATTR_CHAR_DESCRIPTION)->nullable();
            $table->integer(AssetStatus::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(AssetStatus::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(AssetStatus::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(AssetStatus::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_status');
    }
}

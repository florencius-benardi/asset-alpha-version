<?php

use App\Domain\System\Users\Entities\User;
use App\Domain\Transaction\Assets\Entities\Asset;
use App\Domain\Transaction\Assets\Entities\AssetImage360;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetImage360Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AssetImage360::ATTR_TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(AssetImage360::ATTR_INT_ASSET);
            $table->string(AssetImage360::ATTR_CHAR_FILE);
            $table->string(AssetImage360::ATTR_CHAR_ORIGINAL_FILE_NAME);
            $table->integer(AssetImage360::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(AssetImage360::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(AssetImage360::ATTR_INT_ASSET)->constrained(Asset::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreignId(AssetImage360::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(AssetImage360::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(AssetImage360::ATTR_TABLE);
    }
}

<?php

use App\Domain\Master\Depreciations\Entities\DepreciationType;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepreciationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DepreciationType::ATTR_TABLE, function (Blueprint $table) {
            $table->tinyIncrements(DepreciationType::ATTR_INT_ID);
            $table->string(DepreciationType::ATTR_CHAR_NAME, 30)->unique();
            $table->integer(DepreciationType::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(DepreciationType::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(DepreciationType::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(DepreciationType::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DepreciationType::ATTR_TABLE);
    }
}

<?php

use App\Domain\System\Configures\Entities\BarcodeConfigure;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigBarcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BarcodeConfigure::ATTR_TABLE, function (Blueprint $table) {
            $table->smallIncrements(BarcodeConfigure::ATTR_TABLE);
            $table->string(BarcodeConfigure::ATTR_CHAR_KEY, 50);
            $table->string(BarcodeConfigure::ATTR_CHAR_VALUE)->nullable();
            $table->integer(BarcodeConfigure::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(BarcodeConfigure::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(BarcodeConfigure::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(BarcodeConfigure::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(BarcodeConfigure::ATTR_TABLE);
    }
}

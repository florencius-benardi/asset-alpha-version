<?php

use App\Domain\Master\Vendors\Entities\Vendor;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Vendor::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Vendor::ATTR_INT_ID);
            $table->string(Vendor::ATTR_CHAR_CODE, 8)->unique();
            $table->string(Vendor::ATTR_CHAR_NAME, 30);
            $table->string(Vendor::ATTR_CHAR_ADDRESS)->nullable();
            $table->string(Vendor::ATTR_CHAR_BUILDING)->nullable();
            $table->string(Vendor::ATTR_CHAR_UNIT)->nullable();
            $table->string(Vendor::ATTR_CHAR_CITY)->nullable();
            $table->string(Vendor::ATTR_CHAR_PROVINCE)->nullable();
            $table->string(Vendor::ATTR_CHAR_CONTACT)->nullable();
            $table->string(Vendor::ATTR_CHAR_PHONE)->nullable();
            $table->string(Vendor::ATTR_CHAR_EMAIL)->nullable();
            $table->string(Vendor::ATTR_CHAR_WEBSITE)->nullable();
            $table->string(Vendor::ATTR_CHAR_LATITUDE, 20)->nullable();
            $table->string(Vendor::ATTR_CHAR_LONGITUDE, 20)->nullable();
            $table->integer(Vendor::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Vendor::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(Vendor::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(Vendor::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Vendor::ATTR_TABLE);
    }
}

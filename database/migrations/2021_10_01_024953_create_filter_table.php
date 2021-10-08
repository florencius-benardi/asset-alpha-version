<?php

use App\Domain\System\Configures\Entities\FilterPage;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(FilterPage::ATTR_TABLE, function (Blueprint $table) {
            $table->text(FilterPage::ATTR_CHAR_PAGE);
            $table->integer(FilterPage::ATTR_INT_USER)->nullable();
            $table->text(FilterPage::ATTR_CHAR_VALUE)->nullable();
            $table->timestamps();
            $table->foreign(FilterPage::ATTR_INT_USER)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(FilterPage::ATTR_TABLE);
    }
}

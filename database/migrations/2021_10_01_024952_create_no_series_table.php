<?php

use App\Domain\System\NoSeries\Entities\NoSeries;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(NoSeries::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(NoSeries::ATTR_INT_ID);
            $table->string(NoSeries::ATTR_CHAR_CODE, 12)->unique();
            $table->string(NoSeries::ATTR_CHAR_FORMAT, 100);
            $table->string(NoSeries::ATTR_CHAR_LAST_ORDER_DOCUMENT_NO, 100)->nullable();
            $table->integer(NoSeries::ATTR_INT_LAST_ORDER_NO)->nullable();
            $table->bigInteger(NoSeries::ATTR_INT_CREATED_BY);
            $table->bigInteger(NoSeries::ATTR_INT_UPDATED_BY);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId(NoSeries::ATTR_INT_CREATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreignId(NoSeries::ATTR_INT_UPDATED_BY)->constrained(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_series');
    }
}

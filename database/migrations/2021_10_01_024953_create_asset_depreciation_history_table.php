<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDepreciationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_depreciation_history', function (Blueprint $table) {
            $table->integer('asset_id');
            $table->integer('depreciation_id');
            $table->integer('sequence');
            $table->decimal('depreciation_amount', 12);
            $table->date('depreciation_periode');
            $table->decimal('salvage_value', 12);
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by');
            $table->softDeletes();
            $table->smallInteger('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_depreciation_history');
    }
}

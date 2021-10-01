<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->integer('asset_id', true);
            $table->string('code_asset');
            $table->integer('material_id')->nullable();
            $table->integer('id_type_asset')->nullable();
            $table->integer('old_asset')->nullable();
            $table->text('description_asset')->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('purchase_cost')->nullable();
            $table->date('waranty_start')->nullable();
            $table->date('waranty_finish')->nullable();
            $table->integer('id_supplier')->nullable();
            $table->string('serial_number')->nullable();
            $table->integer('level_asset');
            $table->integer('id_superior_asset')->nullable();
            $table->integer('count_duration')->nullable();
            $table->integer('unit_duration')->nullable();
            $table->integer('cycle_schedule')->nullable();
            $table->integer('status')->nullable();
            $table->string('curency')->nullable();
            $table->integer('valuation_groups')->nullable();
            $table->integer('retired_reason')->nullable();
            $table->date('retired_date')->nullable();
            $table->string('retired_ramarks')->nullable();
            $table->date('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->integer('location_id')->nullable();
            $table->bigInteger('depreciation_id_type')->nullable();
            $table->bigInteger('salvage_value')->nullable()->default(0);
            $table->integer('id_plant')->nullable();
            $table->integer('employee_id')->nullable();
            $table->bigInteger('depreciation_id')->nullable();
            $table->smallInteger('is_asset')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset');
    }
}

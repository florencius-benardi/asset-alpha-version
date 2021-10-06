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
            $table->id();
            $table->string('code_asset');
            $table->integer('material_id')->nullable();
            $table->integer('id_type_asset')->nullable();
            $table->integer('old_asset')->nullable();
            $table->text('description_asset')->nullable();

            $table->string('serial_number')->nullable();
            $table->tinyInteger('level_asset')->default(0);
            $table->integer('id_superior_asset')->nullable();

            // Purchase History
            $table->date('purchase_date')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->decimal('purchase_cost', 20, 2)->default(0);
            $table->string('currency')->nullable();
            $table->date('warranty_start')->nullable();
            $table->date('warranty_finish')->nullable();

            // Maintenance Schedule 
            $table->integer('maintenance_cycle_schedule')->nullable();
            $table->integer('count_duration')->nullable();
            $table->integer('unit_duration')->nullable();
            $table->date('last_maintenance_date')->nullable();
            $table->date('next_maintenance_date')->nullable();

            // Retired Asset Field
            $table->integer('retired_reason')->nullable();
            $table->date('retired_date')->nullable();
            $table->string('retired_notes', 30)->nullable();

            $table->integer('status')->nullable();

            $table->integer('location_id')->nullable();

            $table->integer('storage_id')->nullable();
            $table->integer('employee_id')->nullable();

            // Depreciation Field
            $table->smallInteger('is_asset')->nullable();
            $table->bigInteger('depreciation_id')->nullable();
            $table->bigInteger('depreciation_id_type')->nullable();
            $table->bigInteger('salvage_value')->nullable()->default(0);

            $table->integer(Storage::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Storage::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
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

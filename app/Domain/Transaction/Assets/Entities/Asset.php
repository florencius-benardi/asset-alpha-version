<?php

namespace App\Domain\Transaction\Assets\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\Master\AssetTypes\Entities\AssetType;
use App\Domain\Master\Depreciations\Entities\Depreciation;
use App\Domain\Master\Depreciations\Entities\DepreciationType;
use App\Domain\Master\Materials\Entities\Material;
use App\Domain\Master\Storages\Entities\Storage;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'assets';

    const ATTR_BOOL_ASSET = 'is_asset';
    const ATTR_CHAR_CODE = 'code';
    const ATTR_CHAR_PURCHASE_CURRENCY = 'purchase_currency';
    const ATTR_CHAR_SERIAL = 'serial_number';
    const ATTR_DATE_LAST_MAINTENANCE = 'last_maintenance_date';
    const ATTR_DATE_NEXT_MAINTENANCE = 'next_maintenance_date';
    const ATTR_DATE_PURCHASE = 'purchase_date';
    const ATTR_DATE_RETIRED_DATE = 'retired_date';
    const ATTR_DATE_RETIRED_NOTES = 'retired_notes';
    const ATTR_DATE_RETIRED_REASON = 'retired_reason';
    const ATTR_DATE_WARRANTY_EXPIRATION = 'warranty_expiration';
    const ATTR_DATE_WARRANTY_VALID = 'warranty_valid';
    const ATTR_DECIMAL_PURCHASE_PRICE = 'purchase_price';
    const ATTR_DECIMAL_SALVAGE_VALUE = 'salvage_value';
    const ATTR_INT_ASSET_TYPE = 'asset_type_id';
    const ATTR_INT_ASSET_OWNER_GROUP = 'owner_group_id';
    const ATTR_INT_DEPRECIATION = 'depreciation_id';
    const ATTR_INT_DEPRECIATION_TYPE = 'depreciation_type_id';
    const ATTR_INT_EMPLOYEE = 'employee_id';
    const ATTR_INT_LEVEL_ASSET = 'level_asset';
    const ATTR_INT_LOCATION = 'location_id';
    const ATTR_INT_MAINTENANCE_COUNT_DURATION = 'maintenance_count_duration';
    const ATTR_INT_MAINTENANCE_CYCLE = 'maintenance_cycle_schedule';
    const ATTR_INT_MAINTENANCE_UNIT_DURATION = 'maintenance_unit_duration';
    const ATTR_INT_MATERIAL = 'material_id';
    const ATTR_INT_PARENT_ASSET = 'parent_asset_id';
    const ATTR_INT_PREVIOUS_ASSET = 'previous_asset_id';
    const ATTR_INT_STORAGE = 'storage_id';
    const ATTR_INT_VENDOR = 'vendor_id';

    const ATTR_RELATIONSHIP_VENDOR = 'material';
    const ATTR_RELATIONSHIP_PARENT_ASSET = 'parentAsset';
    const ATTR_RELATIONSHIP_PREVIOUS_ASSET = 'previousAsset';
    const ATTR_RELATIONSHIP_DEPRECIATION = 'depreciation';
    const ATTR_RELATIONSHIP_DEPRECIATION_TYPE = 'depreciationType';
    const ATTR_RELATIONSHIP_ASSET_TYPE = 'assetType';
    const ATTR_RELATIONSHIP_LOCATION = 'location';
    const ATTR_RELATIONSHIP_STORAGE = 'storage';
    const ATTR_RELATIONSHIP_MATERIAL = 'material';
    const ATTR_RELATIONSHIP_CREATED_BY = 'createdBy';
    const ATTR_RELATIONSHIP_UPDATED_BY = 'updatedBy';

    // Status : 
    // 0. Active
    // 1. Disposed / Inactive
    // 2. On Service / Maintenance

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = self::ATTR_TABLE;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = self::ATTR_INT_ID;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [
        self::ATTR_CHAR_DESCRIPTION,
        self::ATTR_BOOL_ASSET,
        self::ATTR_CHAR_CODE,
        self::ATTR_CHAR_PURCHASE_CURRENCY,
        self::ATTR_CHAR_SERIAL,
        self::ATTR_DATE_LAST_MAINTENANCE,
        self::ATTR_DATE_NEXT_MAINTENANCE,
        self::ATTR_DATE_PURCHASE,
        self::ATTR_DATE_RETIRED_DATE,
        self::ATTR_DATE_RETIRED_NOTES,
        self::ATTR_DATE_RETIRED_REASON,
        self::ATTR_DATE_WARRANTY_EXPIRATION,
        self::ATTR_DATE_WARRANTY_VALID,
        self::ATTR_DECIMAL_PURCHASE_PRICE,
        self::ATTR_DECIMAL_SALVAGE_VALUE,
        self::ATTR_INT_ASSET_TYPE,
        self::ATTR_INT_ASSET_OWNER_GROUP,
        self::ATTR_INT_DEPRECIATION,
        self::ATTR_INT_DEPRECIATION_TYPE,
        self::ATTR_INT_EMPLOYEE,
        self::ATTR_INT_LEVEL_ASSET,
        self::ATTR_INT_LOCATION,
        self::ATTR_INT_MAINTENANCE_COUNT_DURATION,
        self::ATTR_INT_MAINTENANCE_CYCLE,
        self::ATTR_INT_MAINTENANCE_UNIT_DURATION,
        self::ATTR_INT_MATERIAL,
        self::ATTR_INT_PARENT_ASSET,
        self::ATTR_INT_PREVIOUS_ASSET,
        self::ATTR_INT_STORAGE,
        self::ATTR_INT_VENDOR,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY
    ];

    /**
     * Get the parent asset with the asset.
     */
    public function parentAsset()
    {
        return $this->hasOne(self::class, self::ATTR_INT_PARENT_ASSET)->select(
            self::ATTR_INT_ID,
            self::ATTR_CHAR_CODE,
            self::ATTR_CHAR_DESCRIPTION,
            self::ATTR_INT_MATERIAL,
            self::ATTR_INT_STATUS
        );
    }

    /**
     * Get the previously asset with the asset.
     */
    public function previousAsset()
    {
        return $this->hasOne(self::class, self::ATTR_INT_PREVIOUS_ASSET)->select(
            self::ATTR_INT_ID,
            self::ATTR_CHAR_CODE,
            self::ATTR_CHAR_DESCRIPTION,
            self::ATTR_INT_MATERIAL,
            self::ATTR_INT_STATUS
        );
    }

    /**
     * Get the location associated with the material.
     */
    public function location()
    {
        return $this->hasOne(Material::class, self::ATTR_INT_MATERIAL)->select(
            Material::ATTR_INT_ID,
            Material::ATTR_CHAR_CODE,
            Material::ATTR_CHAR_NAME,
            Material::ATTR_INT_MATERIAL_GROUP,
        );
    }

    /**
     * Get the material associated with the material.
     */
    public function storage()
    {
        return $this->hasOne(Storage::class, self::ATTR_INT_MATERIAL)->select(
            Storage::ATTR_INT_ID,
            Storage::ATTR_CHAR_CODE,
            Storage::ATTR_CHAR_NAME,
            Storage::ATTR_INT_LOCATION,
        );
    }


    /**
     * Get the material associated with the material.
     */
    public function material()
    {
        return $this->hasOne(Material::class, self::ATTR_INT_MATERIAL)->select(
            Material::ATTR_INT_ID,
            Material::ATTR_CHAR_CODE,
            Material::ATTR_CHAR_NAME,
            Material::ATTR_INT_MATERIAL_GROUP,
        );
    }

    /**
     * Get the asset depreciation associated with the depreciation.
     */
    public function depreciation()
    {
        return $this->hasOne(Depreciation::class, self::ATTR_INT_DEPRECIATION)->select(
            Depreciation::ATTR_INT_ID,
            Depreciation::ATTR_CHAR_NAME,
            Depreciation::ATTR_INT_RATE,
            Depreciation::ATTR_INT_USEFUL_LIFE,
            Depreciation::ATTR_INT_DEPRECIATION_TYPE
        );
    }

    /**
     * Get the asset depreciation associated with the depreciation.
     */
    public function depreciationType()
    {
        return $this->hasOne(DepreciationType::class, self::ATTR_INT_DEPRECIATION_TYPE)->select(
            DepreciationType::ATTR_INT_ID,
            DepreciationType::ATTR_CHAR_NAME
        );
    }

    /**
     * Get the asset type associated with the asset type.
     */
    public function assetType()
    {
        return $this->hasOne(AssetType::class, self::ATTR_INT_ASSET_TYPE)->select(
            AssetType::ATTR_INT_ID,
            AssetType::ATTR_CHAR_DESCRIPTION
        );
    }

    /**
     * Get the user creator associated with the user.
     */
    public function createdBy()
    {
        return $this->hasOne(User::class, self::ATTR_INT_CREATED_BY)->select(
            User::ATTR_INT_ID,
            User::ATTR_CHAR_NAME
        );
    }

    /**
     * Get the user updater associated with the user.
     */
    public function updatedBy()
    {
        return $this->hasOne(User::class, self::ATTR_INT_UPDATED_BY)->select(
            User::ATTR_INT_ID,
            User::ATTR_CHAR_NAME
        );
    }
}

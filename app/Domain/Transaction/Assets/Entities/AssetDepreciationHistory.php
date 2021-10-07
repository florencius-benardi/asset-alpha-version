<?php

namespace App\Domain\Transaction\Assets\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\Master\Depreciations\Entities\Depreciation;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetDepreciationHistory extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'asset_depreciation_histories';

    const ATTR_INT_ASSET = 'asset_id';
    const ATTR_INT_DEPRECIATION = 'depreciation_id';
    const ATTR_DATE_PERIODE = 'periode';
    const ATTR_DECIMAL_AMOUNT = 'amount';
    const ATTR_INT_SEQUENCE = 'sequence';
    const ATTR_DECIMAL_SALVAGE_VALUE = 'salvage_value';
    const ATTR_BOOL_ACTIVE = 'active';

    const ATTR_RELATIONSHIP_ASSET = 'asset';
    const ATTR_RELATIONSHIP_DEPRECIATION = 'depreciation';
    const ATTR_RELATIONSHIP_CREATED_BY = 'createdBy';
    const ATTR_RELATIONSHIP_UPDATED_BY = 'updatedBy';

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
    protected $primaryKey = null;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [
        self::ATTR_INT_ASSET,
        self::ATTR_INT_SEQUENCE,
        self::ATTR_INT_DEPRECIATION,
        self::ATTR_DECIMAL_AMOUNT,
        self::ATTR_DATE_PERIODE,
        self::ATTR_DECIMAL_SALVAGE_VALUE,
        self::ATTR_BOOL_ACTIVE,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        self::ATTR_DATE_PERIODE => 'date:Y-m',
    ];

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
            Depreciation::ATTR_INT_DEPRECIATION_TYPE,
        );
    }

    /**
     * Get the asset associated with the asset table.
     */
    public function asset()
    {
        return $this->hasOne(Asset::class, self::ATTR_INT_ASSET)->select(
            Asset::ATTR_INT_ID,
            Asset::ATTR_CHAR_CODE,
            Asset::ATTR_CHAR_DESCRIPTION,
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

<?php

namespace App\Domain\Transaction\HandOvers\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HandOverHeader extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'hand_over_headers';

    const ATTR_INT_ASSET = 'asset_id';
    const ATTR_INT_DEPRECIATION = 'depreciation_id';
    const ATTR_MONTHYEAR_PERIODE = 'periode';
    const ATTR_DECIMAL_AMOUNT = 'amount';
    const ATTR_INT_SEQUENCE = 'sequence';
    const ATTR_DECIMAL_SALVAGE_VALUE = 'salvage_value';
    const ATTR_BOOL_ACTIVE = 'active';

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
        self::ATTR_INT_ASSET,
        self::ATTR_INT_DEPRECIATION,
        self::ATTR_INT_SEQUENCE,
        self::ATTR_DECIMAL_AMOUNT,
        self::ATTR_MONTHYEAR_PERIODE,
        self::ATTR_DECIMAL_SALVAGE_VALUE,
        self::ATTR_BOOL_ACTIVE,
    ];


    /**
     * Get the asset depreciation associated with the depreciation.
     */
    public function handOverLine()
    {
        return $this->hasOne(Depreciation::class, self::ATTR_INT_DEPRECIATION)->select(
            User::ATTR_INT_ID,
            User::ATTR_CHAR_NAME
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

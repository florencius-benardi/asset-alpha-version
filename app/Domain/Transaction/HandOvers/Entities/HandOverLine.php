<?php

namespace App\Domain\Transaction\HandOvers\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HandOverLine extends BaseModel
{
    use HasFactory, SoftDeletes;
    use \Awobaz\Compoships\Compoships;

    const ATTR_TABLE = 'handover_lines';

    const ATTR_INT_HANDOVER_HEADER = 'handover_header_id';
    const ATTR_INT_MATERIAL = 'material_id';
    const ATTR_INT_MATERIAL_GROUP = 'material_group_id';
    const ATTR_INT_SEQUENCE = 'sequence';
    const ATTR_DECIMAL_QUANTITY = 'quantity';
    const ATTR_BOOL_FROM_MATRIX = 'from_matrix';

    const ATTR_RELATIONSHIP_HANDOVER_HEADER = 'handOverHeader';
    const ATTR_RELATIONSHIP_HANDOVER_DETAIL = 'handOverLineDetails';
    const ATTR_RELATIONSHIP_MATERIAL = 'material';
    const ATTR_RELATIONSHIP_MATERIAL_GROUP = 'materialGroup';
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
        self::ATTR_INT_HANDOVER_HEADER,
        self::ATTR_INT_SEQUENCE,
        self::ATTR_INT_MATERIAL,
        self::ATTR_INT_MATERIAL_GROUP,
        self::ATTR_DECIMAL_QUANTITY,
        self::ATTR_BOOL_FROM_MATRIX,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];


    /**
     * Get the asset depreciation associated with the depreciation.
     */
    public function handOverHeader()
    {
        return $this->hasOne(HandOverHeader::class, self::ATTR_INT_HANDOVER_HEADER)->select(
            HandOverHeader::ATTR_INT_ID,
            HandOverHeader::ATTR_DATE_TRANSACTION,
            HandOverHeader::ATTR_CHAR_DOCUMENT_NO,
            HandOverHeader::ATTR_INT_EMPLOYEE
        );
    }

    /**
     * Get the asset depreciation associated with the depreciation.
     */
    public function handOverLineDetail()
    {
        return $this->hasMany(
            HandOverLineDetail::class,
            [
                HandOverLineDetail::ATTR_INT_HANDOVER_HEADER, HandOverLineDetail::ATTR_INT_HANDOVER_LINE_NO
            ],
            [
                self::ATTR_INT_HANDOVER_HEADER, self::ATTR_INT_SEQUENCE
            ]
        )
            ->select(
                HandOverLineDetail::ATTR_INT_HANDOVER_HEADER,
                HandOverLineDetail::ATTR_INT_HANDOVER_LINE_NO,
                HandOverLineDetail::ATTR_INT_SEQUENCE,
                HandOverLineDetail::ATTR_INT_MATERIAL,
                HandOverLineDetail::ATTR_DECIMAL_QUANTITY,
                HandOverLineDetail::ATTR_DECIMAL_PRICE
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

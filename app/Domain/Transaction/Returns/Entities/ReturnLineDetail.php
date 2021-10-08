<?php

namespace App\Domain\Transaction\Returns\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnLineDetail extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'return_line_details';

    const ATTR_INT_RETURN_HEADER = 'return_header_id';
    const ATTR_INT_RETURN_LINE_NO = 'return_line_no';
    const ATTR_INT_ASSET = 'asset_id';
    const ATTR_DECIMAL_QUANTITY = 'quantity';
    const ATTR_DECIMAL_PRICE = 'price';
    const ATTR_INT_MATERIAL = 'material_id';
    const ATTR_INT_MATERIAL_GROUP = 'material_group_id';
    const ATTR_INT_SEQUENCE = 'sequence';

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
        self::ATTR_INT_RETURN_HEADER,
        self::ATTR_INT_RETURN_LINE_NO,
        self::ATTR_INT_SEQUENCE,
        self::ATTR_INT_ASSET,
        self::ATTR_INT_MATERIAL,
        self::ATTR_INT_MATERIAL_GROUP,
        self::ATTR_DECIMAL_QUANTITY,
        self::ATTR_DECIMAL_PRICE,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];


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

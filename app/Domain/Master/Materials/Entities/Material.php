<?php

namespace App\Domain\Master\Materials\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'materials';

    const ATTR_CHAR_CODE = 'code';
    const ATTR_INT_MATERIAL_CLASSIFICATION = 'material_classification_id';
    const ATTR_INT_MATERIAL_GROUP = 'material_group_id';
    const ATTR_BOOL_VARIANT = 'material_variant';
    const ATTR_BOOL_IMAGE = 'material_image';

    const ATTR_RELATIONSHIP_LOCATION_TYPE = 'locationType';
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
        self::ATTR_CHAR_CODE,
        self::ATTR_CHAR_NAME,
        self::ATTR_INT_MATERIAL_GROUP,
        self::ATTR_BOOL_VARIANT,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * Get the Material group associated with the Material group.
     */
    public function materialGroup()
    {
        return $this->hasOne(MaterialGroup::class, self::ATTR_INT_MATERIAL_GROUP)
            ->select(
                MaterialGroup::ATTR_INT_ID,
                MaterialGroup::ATTR_CHAR_CODE,
                MaterialGroup::ATTR_CHAR_DESCRIPTION,
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

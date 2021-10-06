<?php

namespace App\Domain\Master\Materials\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialVariantParameter extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'material_variant_parameters';

    const ATTR_CHAR_VALUE = 'value';
    const ATTR_INT_VARIANT_FIELD = 'material_variant_field_id';
    const ATTR_INT_MATERIAL = 'material_id';

    const ATTR_RELATIONSHIP_MATERIAL = 'material';
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
        self::ATTR_INT_MATERIAL,
        self::ATTR_INT_VARIANT_FIELD,
        self::ATTR_CHAR_VALUE,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

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
     * Get the variant associated with the material variant field.
     */
    public function variantField()
    {
        return $this->hasOne(MaterialVariantField::class, self::ATTR_INT_VARIANT_FIELD)->select(
            MaterialVariantField::ATTR_INT_ID,
            MaterialVariantField::ATTR_CHAR_NAME
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

<?php

namespace App\Domain\Master\Materials\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\Master\Classifications\Entities\ClassificationParameter;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialClassificationParameter extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'material_classification_parameters';
    const ATTR_INT_CLASSIFICATION_PARAMETER = 'classification_parameter_id';
    const ATTR_INT_MATERIAL = 'material_id';
    const ATTR_CHAR_VALUE = 'value';


    const ATTR_RELATIONSHIP_CLASSIFICATION_PARAMETER = 'classificationParameter';
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
        self::ATTR_CHAR_NAME,
        self::ATTR_INT_MATERIAL,
        self::ATTR_INT_CLASSIFICATION_PARAMETER,
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
     * Get the parameter associated with the classification parameter.
     */
    public function classificationParameter()
    {
        return $this->hasOne(ClassificationParameter::class, self::ATTR_INT_CLASSIFICATION_PARAMETER)->select(
            ClassificationParameter::ATTR_INT_ID,
            ClassificationParameter::ATTR_CHAR_NAME,
            ClassificationParameter::ATTR_INT_DATA_TYPE,
            ClassificationParameter::ATTR_INT_MAXIMUM_LENGTH,
            ClassificationParameter::ATTR_CHAR_VALUE,
            ClassificationParameter::ATTR_INT_DECIMAL
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

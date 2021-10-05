<?php

namespace App\Domain\Master\Classifications\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassificationParameter extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'classification_parameters';
    const ATTR_INT_CLASSIFICATION = 'classification_id';
    const ATTR_INT_DATA_TYPE = 'type';
    const ATTR_INT_MAXIMUM_LENGTH = 'length';
    const ATTR_INT_DECIMAL = 'decimal';
    const ATTR_CHAR_VALUE = 'value';
    const ATTR_BOOL_READING_VALUE = 'reading';

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
        self::ATTR_CHAR_VALUE,
        self::ATTR_INT_CLASSIFICATION,
        self::ATTR_INT_DATA_TYPE,
        self::ATTR_INT_MAXIMUM_LENGTH,
        self::ATTR_INT_DECIMAL,
        self::ATTR_BOOL_READING_VALUE,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * Get the classification associated with the classification.
     */
    public function classification()
    {
        return $this->hasOne(Classification::class, self::ATTR_INT_CLASSIFICATION)->select(
            Classification::ATTR_INT_ID,
            Classification::ATTR_CHAR_NAME,
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

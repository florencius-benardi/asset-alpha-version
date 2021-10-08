<?php

namespace App\Domain\Orange\Employee\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\Orange\Grade\Entities\Grade;
use App\Domain\Orange\Level\Entities\Level;
use App\Domain\Orange\Organization\Entities\Organization;
use App\Domain\Orange\Position\Entities\Position;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'employees';

    const ATTR_CHAR_CODE = 'code';
    const ATTR_INT_LEVEL = 'level_id';
    const ATTR_INT_GRADE = 'grade_id';
    const ATTR_INT_ORGANIZATION = 'organization_id';
    const ATTR_INT_POSITION = 'position_id';

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
        self::ATTR_INT_POSITION,
        self::ATTR_INT_GRADE,
        self::ATTR_INT_LEVEL,
        self::ATTR_INT_ORGANIZATION,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * Get the level associated with the level.
     */
    public function level()
    {
        return $this->hasOne(Level::class, self::ATTR_INT_LEVEL)->select(
            Level::ATTR_INT_ID,
            Level::ATTR_CHAR_CODE,
            Level::ATTR_CHAR_DESCRIPTION
        );
    }

    /**
     * Get the Organization associated with the Organization.
     */
    public function organization()
    {
        return $this->hasOne(Organization::class, self::ATTR_INT_ORGANIZATION)->select(
            Organization::ATTR_INT_ID,
            Organization::ATTR_CHAR_CODE,
            Organization::ATTR_CHAR_DESCRIPTION
        );
    }

    /**
     * Get the Position Employee associated with the Position.
     */
    public function position()
    {
        return $this->hasOne(Position::class, self::ATTR_INT_POSITION)->select(
            Position::ATTR_INT_ID,
            Position::ATTR_CHAR_CODE,
            Position::ATTR_CHAR_DESCRIPTION
        );
    }

    /**
     * Get the Position Employee associated with the Position.
     */
    public function grade()
    {
        return $this->hasOne(Grade::class, self::ATTR_INT_GRADE)->select(
            Grade::ATTR_INT_ID,
            Grade::ATTR_CHAR_CODE,
            Grade::ATTR_CHAR_DESCRIPTION
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

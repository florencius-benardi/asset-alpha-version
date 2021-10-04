<?php

namespace App\Domain\System\UserRoles\Entities;

use App\Domain\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends BaseModel
{
    use HasFactory;

    const ATTR_TABLE = 'user_roles';
    const ATTR_INT_ROLE = 'role_id';
    const ATTR_INT_USER = 'user_id';

    const ATTR_RELATIONSHIP_ROLE = 'role';
    const ATTR_RELATIONSHIP_USER = 'user';
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
        self::ATTR_INT_ROLE,
        self::ATTR_INT_USER,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * Get the role user associated with the role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, self::ATTR_INT_ROLE);
    }

    /**
     * Get the role user associated with the user.
     */
    public function user()
    {
        return $this->belongsTo(Module::class, self::ATTR_INT_USER);
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

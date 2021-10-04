<?php

namespace App\Domain\System\RoleModules\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Modules\Entities\Module;
use App\Domain\System\Roles\Entities\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleModule extends BaseModel
{
    use HasFactory;

    const ATTR_TABLE = 'role_modules';
    const ATTR_INT_ROLE = 'role_id';
    const ATTR_INT_MODULE = 'module_id';

    const ATTR_RELATIONSHIP_ROLE = 'role';
    const ATTR_RELATIONSHIP_MODULE = 'module';
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
        self::ATTR_INT_MODULE,
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
     * Get the module role associated with the module.
     */
    public function module()
    {
        return $this->belongsTo(Module::class, self::ATTR_INT_MODULE);
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

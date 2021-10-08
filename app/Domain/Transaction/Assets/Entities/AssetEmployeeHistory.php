<?php

namespace App\Domain\Transaction\Assets\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\Orange\Employee\Entities\Employee;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetEmployeeHistory extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'asset_employee_histories';

    const ATTR_INT_SEQUENCE = 'sequence';
    const ATTR_INT_ASSET = 'asset_id';
    const ATTR_INT_EMPLOYEE = 'employee_id';
    const ATTR_DATE_EFFECTIVE = 'effective_date';

    const ATTR_RELATIONSHIP_ASSET = 'asset';
    const ATTR_RELATIONSHIP_LOCATION = 'depreciation';
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
        self::ATTR_INT_SEQUENCE,
        self::ATTR_DATE_EFFECTIVE,
        self::ATTR_INT_ASSET,
        self::ATTR_INT_EMPLOYEE,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * Get the employee storage creator associated with the employee.
     */
    public function employee()
    {
        return $this->hasOne(Employee::class, self::ATTR_INT_EMPLOYEE)->select(
            Employee::ATTR_INT_ID,
            Employee::ATTR_CHAR_CODE,
            Employee::ATTR_CHAR_NAME,
            Employee::ATTR_INT_POSITION,
            Employee::ATTR_INT_GRADE,
            Employee::ATTR_INT_LEVEL,
            Employee::ATTR_INT_ORGANIZATION
        );
    }

    /**
     * Get the asset associated with the asset table.
     */
    public function asset()
    {
        return $this->hasOne(Asset::class, self::ATTR_INT_ASSET)->select(
            Asset::ATTR_INT_ID,
            Asset::ATTR_CHAR_CODE,
            Asset::ATTR_CHAR_DESCRIPTION,
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

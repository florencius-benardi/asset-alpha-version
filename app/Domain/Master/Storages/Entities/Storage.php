<?php

namespace App\Domain\Master\Storages\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\Master\Locations\Entities\Location;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storage extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'storages';

    const ATTR_CHAR_CODE = 'code';
    const ATTR_INT_LOCATION = 'location_id';

    const ATTR_RELATIONSHIP_LOCATION = 'location';
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
        self::ATTR_INT_LOCATION,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * Get the location storage creator associated with the location.
     */
    public function location()
    {
        return $this->hasOne(Location::class, self::ATTR_INT_LOCATION)->select(
            Location::ATTR_INT_ID,
            Location::ATTR_CHAR_CODE,
            Location::ATTR_CHAR_ADDRESS
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

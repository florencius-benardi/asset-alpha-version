<?php

namespace App\Domain\Master\Locations\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'locations';

    const ATTR_CHAR_CODE = 'code';
    const ATTR_CHAR_ADDRESS = 'address';
    const ATTR_CHAR_BUILDING = 'building';
    const ATTR_CHAR_CITY = 'city';
    const ATTR_CHAR_CONTACT = 'contact';
    const ATTR_INT_LOCATION_TYPE = 'location_type_id';
    const ATTR_CHAR_PHONE = 'phone';
    const ATTR_CHAR_UNIT = 'unit';
    const ATTR_CHAR_EMAIL = 'email';
    const ATTR_CHAR_LATITUDE = 'latitude';
    const ATTR_CHAR_LONGITUDE = 'longitude';

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
        self::ATTR_CHAR_ADDRESS,
        self::ATTR_CHAR_BUILDING,
        self::ATTR_CHAR_UNIT,
        self::ATTR_INT_LOCATION_TYPE,
        self::ATTR_CHAR_CITY,
        self::ATTR_CHAR_CONTACT,
        self::ATTR_CHAR_PHONE,
        self::ATTR_CHAR_LATITUDE,
        self::ATTR_CHAR_LONGITUDE,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * Get the location type associated with the location type.
     */
    public function locationType()
    {
        return $this->hasOne(LocationType::class, self::ATTR_INT_LOCATION_TYPE)
            ->select(
                LocationType::ATTR_INT_ID,
                LocationType::ATTR_CHAR_CODE,
                LocationType::ATTR_CHAR_DESCRIPTION,
                LocationType::ATTR_INT_ZOOM_LEVEL_START,
                LocationType::ATTR_INT_ZOOM_LEVEL_END,
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

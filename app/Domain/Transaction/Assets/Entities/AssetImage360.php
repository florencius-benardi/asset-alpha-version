<?php

namespace App\Domain\Transaction\Assets\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetImage360 extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'asset_image_360';

    const ATTR_INT_ASSET = 'asset_id';
    const ATTR_CHAR_FILE = 'file_name';
    const ATTR_CHAR_ORIGINAL_FILE_NAME = 'original_file_name';

    const ATTR_RELATIONSHIP_Asset = 'Asset';
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
        self::ATTR_INT_ASSET,
        self::ATTR_CHAR_FILE,
        self::ATTR_CHAR_ORIGINAL_FILE_NAME,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * Get the Asset associated with the Asset.
     */
    public function Asset()
    {
        return $this->hasOne(Asset::class, self::ATTR_INT_ASSET)->select(
            Asset::ATTR_INT_ID,
            Asset::ATTR_CHAR_DESCRIPTION
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

<?php

namespace App\Domain\System\Configures\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilterPage extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'filter_pages';

    const ATTR_CHAR_PAGE = 'page';
    const ATTR_INT_USER = 'user_id';
    const ATTR_CHAR_VALUE = 'value';

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
        self::ATTR_CHAR_PAGE,
        self::ATTR_INT_USER,
        self::ATTR_CHAR_VALUE,
    ];
}

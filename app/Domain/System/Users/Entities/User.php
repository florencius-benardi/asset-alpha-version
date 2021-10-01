<?php

namespace App\Domain\System\Users\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Domain\Core\Entities\BaseModel;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ATTR_TABLE = 'users';

    const ATTR_CHAR_NAME = 'username';
    const ATTR_CHAR_EMAIL = 'email';
    const ATTR_CHAR_PASSWORD = 'password';
    const ATTR_CHAR_TOKEN = 'remember_token';
    const ATTR_CHAR_IMAGE = 'image';
    const ATTR_INT_ID = 'id';
    const ATTR_INT_STATUS = 'status';
    const ATTR_DATETIME_VERIFIED = 'email_verified_at';
    const ATTR_DATETIME_CREATED = 'created_at';
    const ATTR_DATETIME_UPDATED = 'updated_at';
    const ATTR_INT_CREATED_BY = 'created_by';
    const ATTR_INT_UPDATED_BY = 'updated_by';
    const ATTR_DATETIME_DELETED_AT = 'deleted_at';

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

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        self::ATTR_CHAR_NAME,
        self::ATTR_CHAR_IMAGE,
        self::ATTR_CHAR_EMAIL,
        self::ATTR_CHAR_PASSWORD,
        self::ATTR_INT_STATUS,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        self::ATTR_CHAR_PASSWORD,
        self::ATTR_CHAR_TOKEN,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        self::ATTR_DATETIME_VERIFIED => 'datetime',
    ];
}

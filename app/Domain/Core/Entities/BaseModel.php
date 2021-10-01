<?php

namespace App\Domain\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class BaseModel  extends BaseModel
{
    const ATTR_INT_ID = 'id';
    const ATTR_CHAR_DESCRIPTION = 'description';
    const ATTR_CHAR_NAME = 'name';
    const ATTR_DATETIME_CREATED = 'created_at';
    const ATTR_DATETIME_UPDATED = 'updated_at';
    const ATTR_INT_CREATED_BY = 'created_by';
    const ATTR_INT_UPDATED_BY = 'updated_by';
    const ATTR_DATETIME_DELETED_AT = 'deleted_at';
    const ATTR_INT_STATUS = 'status';
}

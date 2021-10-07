<?php

namespace App\Domain\Transaction\Returns\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturnLineDetail extends BaseModel
{
    use HasFactory;
}

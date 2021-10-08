<?php

namespace App\Domain\Transaction\Returns\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\NoSeries\Entities\NoSeries;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnHeader extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'return_headers';

    const ATTR_INT_EMPLOYEE = 'employee_id';
    const ATTR_INT_COUNT_PRINTED = 'count_printed';
    const ATTR_DATE_TRANSACTION = 'date_transaction';
    const ATTR_INT_NO_SERIES = 'no_series_document';
    const ATTR_CHAR_DOCUMENT_NO = 'document_no';
    const ATTR_CHAR_NOTES = 'notes';
    const ATTR_INT_RETIRED_REASON = 'retired_reason_id';

    const ATTR_RELATIONSHIP_SERIES_NO = 'noSeries';
    const ATTR_RELATIONSHIP_RETURN_LINE = 'returnLines';
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
        self::ATTR_INT_EMPLOYEE,
        self::ATTR_INT_NO_SERIES,
        self::ATTR_INT_COUNT_PRINTED,
        self::ATTR_CHAR_DOCUMENT_NO,
        self::ATTR_DATE_TRANSACTION,
        self::ATTR_CHAR_NOTES,
        self::ATTR_INT_RETIRED_REASON,
        self::ATTR_INT_STATUS,
        self::ATTR_INT_CREATED_BY,
        self::ATTR_INT_UPDATED_BY,
    ];


    /**
     * Get the NO SERIES associated with the series.
     */
    public function noSeries()
    {
        return $this->hasOne(NoSeries::class, self::ATTR_INT_NO_SERIES)->select(
            NoSeries::ATTR_INT_ID,
            NoSeries::ATTR_CHAR_CODE,
            NoSeries::ATTR_CHAR_FORMAT,
            NoSeries::ATTR_INT_LAST_ORDER_NO,
            NoSeries::ATTR_CHAR_LAST_ORDER_DOCUMENT_NO
        );
    }

    /**
     * Get the return line associated with the returnline .
     */
    public function returnLines()
    {
        return $this->belongsTo(ReturnLine::class, ReturnLine::ATTR_INT_RETURN_HEADER)->select(
            ReturnLine::ATTR_INT_ID,
            ReturnLine::ATTR_INT_SEQUENCE,
            ReturnLine::ATTR_INT_MATERIAL,
            ReturnLine::ATTR_INT_MATERIAL_GROUP,
            ReturnLine::ATTR_DECIMAL_QUANTITY,
        )->sortBy(ReturnLine::ATTR_INT_SEQUENCE);;
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

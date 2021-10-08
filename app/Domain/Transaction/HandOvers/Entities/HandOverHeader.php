<?php

namespace App\Domain\Transaction\HandOvers\Entities;

use App\Domain\Core\Entities\BaseModel;
use App\Domain\System\NoSeries\Entities\NoSeries;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HandOverHeader extends BaseModel
{
    use HasFactory, SoftDeletes;

    const ATTR_TABLE = 'handover_headers';

    const ATTR_INT_EMPLOYEE = 'employee_id';
    const ATTR_INT_COUNT_PRINTED = 'count_printed';
    const ATTR_DATE_TRANSACTION = 'date_transaction';
    const ATTR_INT_NO_SERIES = 'no_series_document';
    const ATTR_CHAR_DOCUMENT_NO = 'document_no';
    const ATTR_CHAR_NOTES = 'notes';

    const ATTR_RELATIONSHIP_SERIES_NO = 'noSeries';
    const ATTR_RELATIONSHIP_HANDOVER_LINE = 'handOverLines';
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
     * Get the handover line associated with the handoverline .
     */
    public function handOverLines()
    {
        return $this->belongsTo(HandOverLine::class, HandOverLine::ATTR_INT_HANDOVER_HEADER)->select(
            HandOverLine::ATTR_INT_ID,
            HandOverLine::ATTR_INT_SEQUENCE,
            HandOverLine::ATTR_INT_MATERIAL,
            HandOverLine::ATTR_INT_MATERIAL_GROUP,
            HandOverLine::ATTR_DECIMAL_QUANTITY,
        )->sortBy(HandOverLine::ATTR_INT_SEQUENCE);;
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

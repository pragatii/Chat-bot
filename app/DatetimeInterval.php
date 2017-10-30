<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 30/10/17
 * Time: 12:23 AM
 */

namespace App;


use Carbon\Carbon;

class DatetimeInterval extends Entity
{
    public $to;
    public $from;
    public $confidence;
    public $type;

    function __construct($object)
    {
        if (isset($object->from)) {
            $this->from = new DateTimeEntityValue($object->from);
        }
        if (isset($object->to)) {
            $this->to = new DateTimeEntityValue($object->to);
        }

        $this->confidence = $object->confidence;
        $this->type = $object->type;
    }

    function getQuery($query)
    {
        if (!is_null($this->from)) {
            $fromDate = $this->from->value;
        } else {
            $fromDate = Carbon::now()->subCentury();
        }

        if (!is_null($this->to)) {
            $toDate = $this->to->value;
        } else {
            $toDate = Carbon::now();
        }
//        dd($fromDate, $toDate);

        return $query->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate);
    }
}
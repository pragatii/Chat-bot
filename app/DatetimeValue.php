<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 30/10/17
 * Time: 10:38 PM
 */

namespace App;


use Carbon\Carbon;

class DatetimeValue extends Entity
{
    public $confidence;
    public $value;
    public $type;
    public $grain;

    function __construct($object)
    {
        $this->confidence = $object->confidence;
        $this->grain = $object->grain;
        $this->type = $object->type;
        $this->value = $object->value;
    }

    function getQuery($query)
    {
        $date = Carbon::parse($this->value);
        $start_of_day = $date->copy()->startOfDay();
        $end_of_day = $date->copy()->endOfDay();

        return $query->where('created_at', '>=', $start_of_day)
            ->where('created_at', '<=', $end_of_day);
    }
}
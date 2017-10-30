<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 30/10/17
 * Time: 12:23 AM
 */

namespace App;


use Carbon\Carbon;

class DatetimeInterval
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
}
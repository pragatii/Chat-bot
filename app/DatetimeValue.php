<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 30/10/17
 * Time: 10:38 PM
 */

namespace App;


class DatetimeValue
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
}
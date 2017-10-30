<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 30/10/17
 * Time: 10:11 PM
 */

namespace App;


use Carbon\Carbon;

class DateTimeEntityValue
{
    public $value;
    public $grain;

    function __construct($object)
    {
        $this->grain = $object->grain;
        $this->value = Carbon::parse($object->value);
    }
}
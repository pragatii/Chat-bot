<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 30/10/17
 * Time: 12:22 AM
 */

namespace App;


class Greeting
{
    public $value;
    public $confidence;

    function __construct($object)
    {
        $this->value = $object->value;
        $this->confidence = $object->confidence;
    }
}
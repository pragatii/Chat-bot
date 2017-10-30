<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 31/10/17
 * Time: 2:15 AM
 */

namespace App;


class EmailEntity extends Entity
{
    public $confidence;
    public $value;

    function __construct($object)
    {
        $this->confidence = $object->confidence;
        $this->value = $object->value;
    }

    function getQuery($query)
    {
        return $query->where('username', $this->value);
    }
}
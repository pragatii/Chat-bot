<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 30/10/17
 * Time: 10:09 PM
 */

namespace App;


use App\Exceptions\LocationIntentNotFoundException;

class Intent extends Entity
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
        if ($this->confidence < 0.7 || $this->value != 'location') {
            throw new LocationIntentNotFoundException();
        }
        return $query->where('entity', 'Location');
    }
}
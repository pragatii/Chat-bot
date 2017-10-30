<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 30/10/17
 * Time: 10:09 PM
 */

namespace App;


class Intent extends Entity
{
    function __construct($object)
    {
    }

    function getQuery($query)
    {
        return $query->where('entity', 'Location');
    }
}
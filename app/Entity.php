<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 31/10/17
 * Time: 1:34 AM
 */

namespace App;


abstract class Entity
{
    abstract function getQuery($query);
}
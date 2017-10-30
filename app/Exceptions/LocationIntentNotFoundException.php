<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 31/10/17
 * Time: 2:24 AM
 */

namespace App\Exceptions;


use Exception;

class LocationIntentNotFoundException extends \Exception
{
    public function __construct($message = "Location intent was not found in the query", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
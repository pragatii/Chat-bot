<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 29/10/17
 * Time: 2:18 PM
 */

namespace App\Services;


use App\DatetimeInterval;
use App\DatetimeValue;
use App\EmailEntity;
use App\Greeting;
use App\Intent;
use Curl\Curl;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class WitService
{
    const WIT_BASE_URL = 'https://api.wit.ai/';

    protected $curl;

    /**
     * WitService constructor.
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * @param $query
     * @return array Entity
     * @throws \Exception
     */
    public function getEntities($query)
    {
        $this->curl->setHeader('Authorization', 'Bearer ' . env('WIT_SERVER_ACCESS_TOKEN'));

        $this->curl->get(self::WIT_BASE_URL . 'message', [
            'q' => $query
        ]);

        if ($this->curl->error) {
            throw new BadRequestHttpException($this->curl->errorMessage);
        }

        $response = $this->curl->response;
//        dd($response);

        $objects = [];

        foreach ($response->entities as $key => $entities) {
            foreach ($entities as $entity) {
                switch ($key) {
                    case 'datetime':
                        if ($entity->type == 'value') {
                            array_push($objects, new DatetimeValue($entity));
                        } else if ($entity->type == 'interval') {
                            array_push($objects, new DatetimeInterval($entity));
                        } else {
                            throw new \Exception('Not compatible type');
                        }
                        break;
                    case 'intent':
                        array_push($objects, new Intent($entity));
                        break;
                    case 'greetings':
                        array_push($objects, new Greeting($entity));
                        break;
                    case 'thanks':
                        //
                        break;
                    case 'email':
                        array_push($objects, new EmailEntity($entity));
                }
            }
        }

        return $objects;
    }

    public function __destruct()
    {
        $this->curl->close();
    }

}
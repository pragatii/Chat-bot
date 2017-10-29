<?php
/**
 * Created by PhpStorm.
 * User: pragati
 * Date: 29/10/17
 * Time: 2:18 PM
 */

namespace App\Services;


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
        dd($response);

        $entities = [];

        if (isset($response->entities) && count($response->entities) > 0) {
            if(isset($response->entities->datetime)){
                $timestamp = $response->entities->datetime[0]->value;
                //dd($timestamp);
                SimplifiiDatabaseService::locationsMarkedOnSingleDAy($timestamp);
            }
           /* foreach ($response->entities as $key => $entity) {
                foreach ($entity as $e) {
                    $ob = new WitEntity($key, $e->value, $e->confidence);
                    array_push($entities, $ob);
                }
            }*/
        }

        return $entities;
    }

    public function __destruct()
    {
        $this->curl->close();
    }

}
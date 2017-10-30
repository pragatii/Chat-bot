<?php

namespace App\Http\Controllers;

use App\DatetimeInterval;
use App\DatetimeValue;
use App\Greeting;
use App\Intent;
use App\Services\WitService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function ask(Request $request)
    {
        $query = $request->get('query');
        $witService = new WitService();
        $entities = $witService->getEntities($query);
//        dd($entities);

        $objects = [];

        foreach ($entities->entities as $key => $entities) {
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
                        array_push($objects, new Intent($objects));
                        break;
                    case 'greetings':
                        array_push($objects, new Greeting($entity));
                        break;
                    case 'thanks':
                        //
                        break;
                }
            }
        }
        dd($objects);
    }
}

<?php

namespace App\Http\Controllers;

use App\Exceptions\LocationIntentNotFoundException;
use App\Services\WitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function ask(Request $request)
    {
        $queryString = $request->get('query');
        $witService = new WitService();
        $entities = $witService->getEntities($queryString);
//        dd($entities);

        $query = DB::table('cards');

        if (count($entities) < 1) {
            return view('welcome', [
                'query' => $queryString,
                'errorString' => 'asd'
            ]);
        }
//        dd($entities);

        foreach ($entities as $entity) {
            try {
                $query = $entity->getQuery($query);
            } catch (LocationIntentNotFoundException $e) {
                return view('welcome', [
                    'query' => $queryString,
                    'errorString' => $e->getMessage()
                ]);
            } catch (\Exception $e) {

            }
        }

        return view('welcome', [
            'result' => $query->get(),
            'query' => $queryString
        ]);
    }
}

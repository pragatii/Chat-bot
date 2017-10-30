<?php

namespace App\Http\Controllers;

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

        $query = DB::table('cards');

        foreach ($entities as $entity) {
            $query = $entity->getQuery($query);
        }

        return view('welcome', [
            'result' => $query->get(),
            'query' => $queryString
        ]);
    }
}

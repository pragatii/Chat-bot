<?php

namespace App\Http\Controllers;

use App\Services\WitService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function ask(Request $request){
        $query = $request->get('query');
        $witService = new WitService();
        $witService->getEntities($query);
    }
}

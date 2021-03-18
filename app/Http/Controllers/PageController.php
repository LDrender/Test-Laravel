<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FilterGraphController;

class PageController extends Controller
{
    public function mapping(Request $request){
        return view('mapping', [
                "filterGraph" => FilterGraphController::getListFilter($request)
            ]);
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entreprise;

class ClientsController extends Controller
{
    public function list()
    {
        $clients = Client::status();
        $entreprises_ = Entreprise::all();
    
        return view('clients.index', compact(
            'clients', 'entreprises_'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'status' => 'required|integer',
            'entreprise_id' => 'required|integer'
        ]);

        
        Client::create($data);

        return back();
    }
}

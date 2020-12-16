<?php

namespace App;

use App\Client;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $guarded = [];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}

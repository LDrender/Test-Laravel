<?php

namespace App;
 
use App\Entreprise;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function scopeStatus($query)
    {
        return $query->where('status', 1)->get();
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}

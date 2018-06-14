<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kyc_tipo extends Model
{
    protected $fillable = [
        'titulo', 
    ];
    public function kycdocumentos()
    {
        return $this->hasMany('App\kycdocumento');
    }    
}

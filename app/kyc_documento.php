<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kyc_documento extends Model
{
    protected $fillable = [
        'user_id', 'kyctipo_id', 'nombre' 
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kyctipodocumento()
    {
        return $this->belongsTo('App\kyctipodocumento');
    }
}

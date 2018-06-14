<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kyc_estado extends Model
{
    protected $fillable = [
        'titulo', 
    ];
    public function users()
    {
        return $this->hasMany('App\User');
    }
}

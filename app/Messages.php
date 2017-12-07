<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        'group', 'user', 'message',
    ];

    public function group(){
    	return belongsTo('App\Groups');
    }
}

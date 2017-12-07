<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'lead', 'name', 'code', 'groupmembers', 'open',
    ];

    protected $dates = ['deleted_at'];

    public function events(){
    	return hasMany('App\Events');
    }

    public function future(){
    	return hasMany('App\FutureEvents');
    }

    public function messages(){
    	return hasMany('App\Messages');
    }

    public function voulenteer(){
    	return hasMany('App\Voulenteer');
    }
}

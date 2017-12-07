<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	
    protected $fillable = [
        'date', 'starttime', 'name', 'description', 'group', 'creator',
    ];

    public function group(){
    	return belongsTo('App\Groups');
    }
}

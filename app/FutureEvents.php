<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FutureEvents extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'group', 'days', 'times', 'name', 'description', 'responded', 'results', 'creator',
    ];

    public function group(){
    	return belongsTo('App\Groups');
    }
}

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
}

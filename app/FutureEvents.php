<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FutureEvents extends Model
{
    protected $fillable = [
        'group', 'days', 'times', 'name', 'description', 'responded', 'results',
    ];
}

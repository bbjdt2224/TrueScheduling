<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voulenteer extends Model
{
    protected $fillable = [
        'group', 'days', 'times', 'name', 'description', 'number', 'voulenteers',
    ];
}

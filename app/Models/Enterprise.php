<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    //
    protected $fillable = [
        'name'
    ];
    protected $visible = [
        'id', 'name'
    ];
}

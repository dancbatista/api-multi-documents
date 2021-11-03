<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    //

    protected $fillable = [
        'name'
    ];
    protected $visible = [
        'id', 'name'
    ];
}

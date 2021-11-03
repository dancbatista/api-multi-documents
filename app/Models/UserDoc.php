<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDoc extends Model
{
    //
     protected $fillable = [
        'document', 'document_type_id'
    ];
    protected $visible = [
        'id', 'document_type_id', 'document', 'userDocumentType'
    ];

    public function userDocumentType() {
        return $this->hasOne(DocumentType::class, 'id', 'document_type_id');
    }
}

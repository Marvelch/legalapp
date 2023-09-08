<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documentAgreement extends Model
{
    use HasFactory;

    protected $table = 'document_agreements';

    protected $fillable = [
        'key',
        'file_name',
        'path'
    ];
}

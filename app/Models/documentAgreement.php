<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class documentAgreement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_agreements';

    protected $fillable = [
        'key',
        'file_name',
        'path'
    ];
}

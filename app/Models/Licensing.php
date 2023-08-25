<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licensing extends Model
{
    use HasFactory;

    protected $table = 'licensings';

    protected $fillable = [
        'legal_entity_id',
        'permit_number',
        'permit_name',
        'publisher_id',
        'date_start',
        'date_end',
        'period',
        'extra_time',
        'documents',
        'description'
    ];

    public function legals() {
        return $this->belongsTo(LegalEntity::class,'legal_entity_id','id');
    }

    public function publishers() {
        return $this->belongsTo(Publisher::class,'publisher_id','id');
    }
}

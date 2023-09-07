<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licensing extends Model
{
    use HasFactory;

    protected $table = 'licensings';

    protected $fillable = [
        'company_id',
        'permit_number',
        'permit_name',
        'publisher_id',
        'date_start',
        'date_end',
        'period',
        'extra_time',
        'documents',
        'description',
        'user_id',
        'document1',
        'document2',
        'document3',
        'document4',
        'document5',
        'document6',
        'document7',
        'document8',
        'document9',
        'document10',
        'document11',
        'document12',
        'document13',
        'document14',
        'document15',
        'document16',
        'document17',
        'document18',
        'document19',
        'document20',
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function legals() {
        return $this->belongsTo(LegalEntity::class,'legal_entity_id','id');
    }

    public function publishers() {
        return $this->belongsTo(Publisher::class,'publisher_id','id');
    }
}

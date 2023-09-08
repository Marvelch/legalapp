<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Licensing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'licensings';

    protected $fillable = [
        'company_id',
        'permit_number',
        'permit_name',
        'publisher_id',
        'date_start',
        'date_end',
        'check_date_period',
        'period',
        'add_date',
        'set_notification',
        'description',
        'user_id',
        'document_keys'
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function documents() {
        return $this->hasMany(document::class,'key','document_keys');
    }

    public function companys() {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function publishers() {
        return $this->belongsTo(Publisher::class,'publisher_id','id');
    }
}

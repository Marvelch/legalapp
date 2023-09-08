<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agreement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'agreements';

    protected $fillable = [
        'agreement_name',
        'company_id',
        'counter_party_name',
        'signing_date',
        'effective_date',
        'check_date_period',
        'date_end',
        'period',
        'add_date',
        'set_notification',
        'documents',
        'description',
        'user_id',
        'document_keys'
    ];

    public function companys() {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function documentAgreements() {
        return $this->hasMany(documentAgreement::class,'key','document_keys');
    }

}

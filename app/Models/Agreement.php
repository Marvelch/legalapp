<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected $table = 'agreements';

    protected $fillable = [
        'agreement_name',
        'company_id',
        'counter_party_name',
        'signing_date',
        'effective_date',
        'end_date',
        'renewal_date',
        'date_notification',
        'documents',
        'description'
    ];

    public function companys() {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}

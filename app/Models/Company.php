<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'region_id',
        'address',
        'division_id',
        'information'
    ];

    public function divisions() {
        return $this->belongsTo(Division::class,'division_id','id');
    }

    public function regions() {
        return $this->belongsTo(region::class,'region_id','id');
    }
}

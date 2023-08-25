<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalEntity extends Model
{
    use HasFactory;

    protected $table = 'legal_entities';

    protected $fillable = [
        'name',
        'address',
        'division_id',
        'description'
    ];

    public function legals() {
        return $this->belongsTo(Division::class,'division_id','id');
    }
}

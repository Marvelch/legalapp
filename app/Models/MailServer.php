<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailServer extends Model
{
    use HasFactory;

    protected $table = 'mail_servers';

    protected $fillable = [
        'mail_server',
        'port',
        'smtp',
        'username',
        'password',
        'description',
        'default'
    ];
}

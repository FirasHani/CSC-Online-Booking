<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailContent extends Model
{
    protected $table = 'email_contents';

    protected $fillable = [
        'content',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}


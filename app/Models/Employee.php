<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'store_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'image_url',
    ];
    public function employee()
    {
    return $this->hasOne(Employee::class);
    }
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}

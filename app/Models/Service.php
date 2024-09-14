<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

   

    protected $fillable = [
        'service_name',
        'price',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
  
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_service');
    }
    
}
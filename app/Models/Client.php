<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'location',
        'appointment_date',
        'appointment_time',
    ];
    public function services()
    {
        return $this->belongsToMany(Service::class, 'client_service');
    }
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    public function emailContent()
    {
        return $this->hasOne(EmailContent::class);
    }
}
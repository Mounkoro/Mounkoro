<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = ['client_id', 'type', 'description', 'location', 'status'];

    public function client()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

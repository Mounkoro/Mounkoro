<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    protected $fillable = ['user_id', 'phone', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(ServiceRequest::class, 'client_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'client_id');
    }
}

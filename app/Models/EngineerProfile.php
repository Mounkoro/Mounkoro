<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EngineerProfile extends Model
{
    protected $fillable = ['user_id', 'skills', 'availability', 'intervention_zone', 'bio', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'engineer_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'engineer_id');
    }
}

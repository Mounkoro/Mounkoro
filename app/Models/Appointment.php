<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['service_request_id', 'engineer_id', 'appointment_date', 'status'];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function engineer()
    {
        return $this->belongsTo(EngineerProfile::class, 'engineer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['engineer_id', 'client_id', 'amount', 'items', 'status'];

    protected $casts = [
        'items' => 'array',
    ];

    public function engineer()
    {
        return $this->belongsTo(EngineerProfile::class, 'engineer_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }
}

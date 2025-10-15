<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaneModel extends Model
{
    protected $fillable = [
        'model',
        'fuel_capacity',
        'arrival_date',
        'departure_date',
        'airport_id',
    ];

    protected $casts = [
        'model' => 'string',
        'fuel_capacity' => 'decimal:2',
        'arrival_date' => 'datetime',
        'departure_date' => 'datetime',
        'airport_id' => 'integer'
    ];

    public function airport(){
        return $this->belongsTo(AirportModel::class, 'airport_id');
    }
}

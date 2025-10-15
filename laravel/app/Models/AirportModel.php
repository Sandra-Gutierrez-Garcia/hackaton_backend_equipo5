<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirportModel extends Model
{
    protected $fillable = [
        'name',
        'territory_id',
        'plane_id',
        'capacity',
        'runaways',
    ];

    protected $casts = [
        'name' => 'string',
        'territory_id' => 'integer',
        'plane_id' => 'integer',
        'capacity' => 'ineteger',
        'runaways' => 'integer'
    ];

    public function territory(){
        return $this->belongsTo(TerritoryModel::class, 'territory_id');
    }

    public function plane(){
        return $this->belongsTo(PlaneModel::class, 'plane_id');
    }
}

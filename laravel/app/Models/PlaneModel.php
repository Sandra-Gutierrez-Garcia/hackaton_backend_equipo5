<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaneModel extends Model
{
    use HasFactory;

    protected $table = 'planes';
    
    protected $fillable = [
        'model',
        'capacity',
        'range_km',
        'flight_type',
        'arrival_date',
        'departure_date',
        //'airport_id',
    ];

    protected $casts = [

        'capacity' => 'integer',
        'range_km' => 'integer',

        'arrival_date' => 'datetime',
        'departure_date' => 'datetime',
        //'airport_id' => 'integer'
    ];

    public function airport(){
        return $this->belongsTo(PlaneModel::class);
    }
}

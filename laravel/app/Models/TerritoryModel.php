<?php

namespace App\Models;

use Database\Factories\TerritoryFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TerritoryModel extends Model
{
    use HasFactory;

    protected $table = 'territories';

    protected $fillable = [
        'name',
        'citizens',
        'pollution_level',
        'airport_id'
    ];

    protected $casts = [
        'citizens' => 'integer',
        'pollution_level' => 'decimal:2',
        'airport_id' => 'integer'
    ];

    public function airport()
    {
        return $this->belongsTo(AirportModel::class, 'airport_id');
    }

     protected static function newFactory(){
        return TerritoryFactory::new();
    }
}

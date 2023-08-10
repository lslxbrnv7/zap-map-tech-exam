<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Location extends Model
{
    protected $table = 'locations';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'longitude',
        'latitude',
    ];

    protected $casts = [
        'longitude' => 'float',
        'latitude' => 'float',
    ];

    public function scopeFallsWithinRadius(Builder $query, $latitude, $longitude, $radius)
    {
        return $query->select('id', 'name', 'latitude', 'longitude')
            ->whereRaw("ST_DISTANCE_SPHERE(point(latitude, longitude), point(?, ?)) <= ?", [$latitude, $longitude, $radius]);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'rate',
        'city',
        'taluk_id',
        'district_id',
       // 'amenity_id',
        'pincode',
        'address',
        'landmark',
        'gmap',
        'avaiable',
        'active',
        'avaiablearea',
        'test',
      //  'amenity',
    ];

    protected $casts = [

        'test' => 'array',
    ];

    public function taluk()
    {
        return $this->belongsTo(Taluk::class);
    }


    public function district()
    {
        return $this->belongsTo(District::class);
    }


    public function amenity()
    {
        return $this->belongsTo(Amenity::class);
    }
}

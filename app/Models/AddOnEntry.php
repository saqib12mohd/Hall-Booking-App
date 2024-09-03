<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnEntry extends Model


{
    use HasFactory;
    protected $fillable = [

        'booking_id',
        'additional_serve_id',
        'discount',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);

    }

    public function additional_serve()
    {
        return $this->belongsTo(AdditionalServe::class);

    }
}

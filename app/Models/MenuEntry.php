<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'menu_id',
        'discount',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);

    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'number',
        'from',
        'to',
        'event_id',
        'venue_id',
        // 'menu_id',
        'people',
        'bookby',
        'contact',
        'email',

    ];

    Public function menuentry()
    {
        return $this->hasMany(MenuEntry::class);
    }

    Public function addonentry()
    {
        return $this->hasMany(AddOnEntry::class);
    }


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function Venue()
    {
        return $this->belongsTo(Venue::class);
    }


    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }


}

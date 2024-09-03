<?php

namespace App\Filament\Widgets;

use App\Models\AdditionalServe;
use App\Models\Amenity;
use App\Models\Booking as ModelsBooking;
use App\Models\District;
use App\Models\Event;
use App\Models\Menu;
use App\Models\Taluk;
use App\Models\Venue;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class booking extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Booking', ModelsBooking::count())
            ->description('New Booking that has been Inculded')
            ->descriptionIcon('heroicon-m-newspaper', IconPosition::Before)
            ->chart([1000,4000 ,8000 , 10000, 25000 , 40000])
            ->color('info')
            ->url('http://127.0.0.1:8000/admin/bookings'),

            Stat::make('Taluk', Taluk::count())
            ->description('New Taluk that has been Inculded')
            ->descriptionIcon('heroicon-m-newspaper', IconPosition::Before)
            ->chart([1000,4000 ,8000 , 10000, 25000 , 40000])
            ->color('warning')
            ->url('http://127.0.0.1:8000/admin/taluks'),

            Stat::make('District', District::count())
            ->description('New District that has been Inculded')
            ->descriptionIcon('heroicon-m-newspaper', IconPosition::Before)
            ->chart([1000,4000 ,8000 , 10000, 25000 , 40000])
            ->color('danger')
            ->url('http://127.0.0.1:8000/admin/districts'),

            Stat::make('Event', Event::count())
            ->description('New Event that has been Inculded')
            ->descriptionIcon('heroicon-m-newspaper', IconPosition::Before)
            ->chart([1000,4000 ,8000 , 10000, 25000 , 40000])
            ->color('success')
            ->url('http://127.0.0.1:8000/admin/events'),


            Stat::make('Amenity', Amenity::count())
            ->description('New Ameunity that has been Inculded')
            ->descriptionIcon('heroicon-m-newspaper', IconPosition::Before)
            ->chart([1000,4000 ,8000 , 10000, 25000 , 40000])
            ->color('gray')
            ->url('http://127.0.0.1:8000/admin/amenities'),


            Stat::make('Menu', Menu::count())
            ->description('New Menu that has been Inculded')
            ->descriptionIcon('heroicon-m-newspaper', IconPosition::Before)
            ->chart([1000,4000 ,8000 , 10000, 25000 , 40000])
            ->color('primary')
            ->url('http://127.0.0.1:8000/admin/menus'),


            Stat::make('Venue', Venue::count())
            ->description('New Venue that has been Inculded')
            ->descriptionIcon('heroicon-m-newspaper', IconPosition::Before)
            ->chart([1000,4000 ,8000 , 10000, 25000 , 40000])
            ->color('danger')
            ->url('http://127.0.0.1:8000/admin/venues'),


            Stat::make('Additional Service', AdditionalServe::count())
            ->description('New Additional Services that has been Inculded')
            ->descriptionIcon('heroicon-m-newspaper', IconPosition::Before)
            ->chart([1000,4000 ,8000 , 10000, 25000 , 40000])
            ->color('info')
            ->url('http://127.0.0.1:8000/admin/additional-serves'),

        ];
    }
}

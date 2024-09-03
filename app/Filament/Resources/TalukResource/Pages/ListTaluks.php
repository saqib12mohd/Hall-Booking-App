<?php

namespace App\Filament\Resources\TalukResource\Pages;

use App\Filament\Resources\TalukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaluks extends ListRecords
{
    protected static string $resource = TalukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

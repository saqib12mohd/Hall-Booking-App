<?php

namespace App\Filament\Resources\AdditionalServeResource\Pages;

use App\Filament\Resources\AdditionalServeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdditionalServes extends ListRecords
{
    protected static string $resource = AdditionalServeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

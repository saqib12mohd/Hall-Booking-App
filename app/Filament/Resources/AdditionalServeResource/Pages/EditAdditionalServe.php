<?php

namespace App\Filament\Resources\AdditionalServeResource\Pages;

use App\Filament\Resources\AdditionalServeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdditionalServe extends EditRecord
{
    protected static string $resource = AdditionalServeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

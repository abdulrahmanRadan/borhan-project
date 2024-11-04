<?php

namespace App\Filament\Resources\BooksCategoryResource\Pages;

use App\Filament\Resources\BooksCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBooksCategory extends EditRecord
{
    protected static string $resource = BooksCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

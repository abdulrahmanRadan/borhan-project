<?php

namespace App\Filament\Resources\BooksCategoryResource\Pages;

use App\Filament\Resources\BooksCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBooksCategories extends ListRecords
{
    protected static string $resource = BooksCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

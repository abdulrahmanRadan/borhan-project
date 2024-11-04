<?php

namespace App\Filament\Resources\BooksCategoryResource\Pages;

use App\Filament\Resources\BooksCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBooksCategory extends CreateRecord
{
    protected static string $resource = BooksCategoryResource::class;
}

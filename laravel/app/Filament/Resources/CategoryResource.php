<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;





use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'الفيديو';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'اقسام الفيديوهات';

    public static function getNavigationBadge() : ?string 
    {
        return static::getModel()::where('is_visible', '=', 1 )->count() ;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('اسم القسم')
                    ->required()
                    ->live(true)
                    ->afterStateUpdated(function($operation, $state, Forms\Set $set){
                        if($operation !== 'create'){
                            return ;
                        }
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->unique(Category::class,'slug', ignoreRecord:true),
                Forms\Components\Select::make('user_id')
                    ->default(Auth::id())
                    ->relationship('user', 'name')
                    ->options(function(){
                        $userId = Auth::id();
                        return User::where('id', $userId)->pluck('name', 'id');
                    })
                    ->native(false),
                MarkdownEditor::make('description')->columnSpan(2)->label('الوصف'),
                Group::make()
                ->schema([
                    FileUpload::make('photo')
                        ->directory('videoCategory')
                        ->image()
                        ->label('الصورة')
                        ->preserveFilenames()
                        ->imageEditor()
                        ->panelLayout('grid')
                        ->deletable()
                        ->openable(),
                    Toggle::make('is_visible')
                        ->label(' عرض قسم الفيديوهات هذا')
                        ->default(true)
                        ->helperText('هل تريد ان يعرض قسم الفيديوهات عند الجميع'),
                    DatePicker::make('created_at')
                        ->label('تاريخ ادخال قسم الفيديوهات في النظام')
                        ->default(Carbon::now()->format('d F Y'))
                        ->readOnly(true)
                        ->disabled()
                        ->displayFormat('d F Y')
                        ->native(false)
                ]),
                

            ])->Columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                ->label('الصورة')
                ->circular(),
                TextColumn::make('name')
                ->label('اسم القسم ')
                ->searchable()
                ->sortable(),
                TextColumn::make('description')
                ->label('وصف القسم ')
                ->searchable(),
                ToggleColumn::make('is_visible'),
                TextColumn::make('slug')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->toggleable()
                    ->date(),
                TextColumn::make('updated_at')
                    ->toggleable()
                    ->date(),

                
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('قسم الفيديوا المعروضة')
                    ->boolean()
                    ->trueLabel('اعرض فقط قسم الفيديوا المتاحة للجميع')
                    ->falseLabel(' اعرض فقط قسم الفيديوا غير المتاحة للجميع')
                    ->native(false),
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
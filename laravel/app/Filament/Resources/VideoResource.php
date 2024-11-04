<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
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
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\Console\Descriptor\Descriptor;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'الفيديو';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = ' الفيديوهات';
    
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                ->schema([
                    TextInput::make('name')
                        ->label(' عنوان الفيديو')
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
                        ->unique(Video::class,'slug', ignoreRecord:true),
                MarkdownEditor::make('description')->columnSpan(2)->label('الوصف'),
                ])->columns(2),
                Group::make()
                ->schema([
                FileUpload::make('video')
                    ->directory('videos')
                    ->required()
                    // ->preserveFilenames()
                    ->maxSize(20000)
                    ->deletable(),
                Group::make()
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label(' اسمك ')
                        ->default(Auth::id())
                        ->relationship('user', 'name')
                        ->options(function(){
                            $userId = Auth::id();
                            return User::where('id', $userId)->pluck('name', 'id');
                        })
                        ->native(false),
                    Select::make('category_id')
                        ->label('قوائم تشغيل الفيديو')
                        ->relationship('category', 'name')
                        ->default(Category::first()->id??null)
                        ->native(false)
                        ->live(true)
                        ->searchable(),
                    DatePicker::make('date')
                        ->label('تاريخ انشاء الفيديوا')
                        ->default(Carbon::now())
                        ->locale('ar')
                        ->native(false),
                    Toggle::make('is_visible')
                        ->default(true)
                        ->label('متاح للجميع')
                        ->helperText('هذا الفيديو سيكون متاحاً للجميع'),
                    ])->columns(2),
                ]),
                
                
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Custom column to display video
                ViewColumn::make('video')
                ->label('Video')
                ->view('filament.pages.list-video'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable()
                    ->toggleable(),
                ToggleColumn::make('is_visible')->sortable(),
                TextColumn::make('date')
                    // ->toggleable()
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('created_at')->toggleable(),
                TextColumn::make('updated_at')->toggleable(),
                
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('الفيديوهات المعروضة')
                    ->boolean()
                    ->trueLabel('اعرض فقط الفيديوهات المتاحة للجميع')
                    ->falseLabel(' اعرض فقط الفيديوهات غير المتاحة للجميع')
                    ->native(false),
                SelectFilter::make('user_id')
                    ->relationship('user', 'name'),
                

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'view' => Pages\ViewVideo::route('/{record}'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
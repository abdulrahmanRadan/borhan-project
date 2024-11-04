<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use App\Models\Books_category;
use App\Models\User;
use Attribute;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use League\Csv\Query\Row;
use Carbon\Carbon;
use Directory;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function Laravel\Prompts\warning;
use function Termwind\style;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'المكتبة';
    protected static ?string $navigationLabel = "الكتب";
    protected static ?string $titleLabel = "الكتب";
    protected static ?int $navigationSort = 1;
    protected static ?string $activeNavigationIcon = 'letsicon-book-open-duotone';

    protected static ?string $recordTitleAttribute = 'name';
    protected static int $globalSearchResultsLimit = 10;
    
    public static function getGloballySearchableAttributes(): array
    {
        return ['name','description', 'slug', 'date','author'];
    }
    
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Book' => $record->name,
        ];
    }

    //////////////////////////      Navigation Badge         ////////////////
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $counts = static::getModel()::count();
        return $counts < 5
        ? Color::Green
        :( $counts < 20
            ? Color::Lime
            : ($counts <50
                ? Color::Orange
                :($counts < 100
                ? Color::Amber
                :Color::Red)
            )
        );
    }


        
        
    ////////////////////////////////////////////////////////
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        // ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        //     if (($get('slug') ?? '') !== Str::slug($old)) {
                        //         return;
                        //     }
                        
                        //     $set('slug', Str::slug($state));
                        // }),
                        ->afterStateUpdated(function(string $operation, $state, Forms\Set $set){
                            if($operation !== 'create'){
                                return ;
                            }

                            $set('slug',Str::slug($state));
                        }),
                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(Book::class, 'slug',ignoreRecord:true)
                            ,
                        Forms\Components\TextInput::make('author')
                            ->label('المؤلف'),
                        Forms\Components\Select::make('user_id')
                            ->label('اسم المستخدم الحالي')
                            ->default(Auth::id())
                            ->relationship('user', 'name')
                            ->options(function () {
                                $userId = Auth::id();
                                return User::where('id', $userId)->pluck('name', 'id');
                            })
                            ->native(false),

                            // ->required(),
                            // ->disabled(), // Disable the select to make it read-only
                        Forms\Components\MarkdownEditor::make('description')->columnSpan(2)
                        
                    ])->columns(2),
                    

                Forms\Components\Group::make()
                    ->schema([
                        FileUpload::make('pdf')
                                ->label('تحميل الكتاب')
                                ->acceptedFileTypes(['application/pdf']) // Allow only PDF files
                                ->directory('bookspdfs') // Optional: specify a directory for uploaded files
                                ->maxSize(10240)
                                ->required()
                                ->panelLayout('grid')
                                ->downloadable()
                                ->openable(),
                        FileUpload::make('photo')
                                    ->directory('books')
                                    ->image()
                                    ->label('الصور')
                                    ->preserveFilenames()
                                    // ->preserveFilenames()
                                    ->imageEditor()
                                    ->panelLayout('grid')
                                    ->deletable()
                                    ->openable(),
                            Select::make('books_category_id')
                                ->label('اقسام الكتب ')
                                // ->options(Books_category::all()->pluck('name', 'id')->toArray())
                                ->relationship('books_category', 'name')
                                ->default(Books_category::first()->id?? null)
                                ->native(false),
                    Forms\Components\Toggle::make('is_visible')
                        ->label('عرض الكتاب')
                        ->default(true)
                        ->helperText('هل تريد ان يعرض الكتاب عند الجميع'),
                    ]), // Add custom class here,
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('date')
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->label('تاريخ انشاء الكتاب')
                            ->default(Carbon::now()->format('Y'))
                            ->displayFormat('Y')
                            ->locale('ar')
                            ->minDate(now()->subYears(50))
                            ->maxDate(now())
                            ->native(false),
                        Forms\Components\DatePicker::make('created_at')
                            ->label('تاريخ ادخال الكتاب في النظام')
                            ->default(Carbon::now()->format('d F Y'))
                            ->readOnly(true)
                            ->disabled()
                            ->displayFormat('d F Y')
                            ->native(false)
                    ])
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('الصور')
                    ->circular(), // Apply circular class using Tailwind
                    // ->extraImgAttributes(['class' => 'rounded-full']),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ,
                // Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('description')
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('pdf')
                    ->label('PDF')
                    ->formatStateUsing(function ($state) {
                        return $state ? '<a href="' . asset('storage/' . $state) . '" target="_blank">View PDF</a>' : 'No PDF';
                    })
                    ->html(),
                // Tables\Columns\IconColumn::make('is_visible')
                //     ->boolean(),
                ToggleColumn::make('is_visible')->sortable(),
                Tables\Columns\TextColumn::make('date')
                    // ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('author')->sortable()->searchable(),
                TextColumn::make('created_at')->toggleable(),
                TextColumn::make('updated_at')->toggleable(),
                
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('الكتب المعروضة')
                    ->boolean()
                    ->trueLabel('اعرض فقط الكتب المتاحة للجميع')
                    ->falseLabel(' اعرض فقط الكتب غير المتاحة للجميع')
                    ->native(false),
                SelectFilter::make('author')
                    ->relationship('user', 'name')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
    
}
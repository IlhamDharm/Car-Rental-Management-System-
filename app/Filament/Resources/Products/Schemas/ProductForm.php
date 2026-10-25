<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    Step::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->description('Isi informasi dasar produk')
                        ->schema([
                            Group::make([
                                TextInput::make('name')->required(),
                                TextInput::make('sku')->required()->unique(ignoreRecord: true),
                            ])->columns(2),

                            Group::make([
                                TextInput::make('brand')->required(),
                                TextInput::make('model')->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description')->required(),
                        ]),

                    Step::make('Pricing & Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->description('Isi harga dan jumlah stok')
                        ->schema([
                            Group::make([
                                TextInput::make('price')
                                    ->numeric()
                                    ->minValue(1)
                                    ->required(),
                                TextInput::make('stock')
                                    ->numeric()
                                    ->default(1)
                                    ->readOnly()
                                    ->required(),
                            ])->columns(2),
                            Group::make([
                                Select::make('type')
                                    ->options([
                                        'SUV' => 'SUV',
                                        'MPV' => 'MPV',
                                        'Sedan' => 'Sedan',
                                    ])->required(),
                                TextInput::make('capacity')
                                    ->label('Kapasitas (Penumpang)')
                                    ->numeric()
                                    ->required(),
                                Select::make('transmission')
                                    ->label('Transmisi')
                                    ->options([
                                        'Automatic' => 'Automatic',
                                        'Manual' => 'Manual',
                                    ])->required(),
                                Select::make('fuel_type')
                                    ->label('Bahan Bakar')
                                    ->options([
                                        'Bensin' => 'Bensin',
                                        'Diesel' => 'Diesel',
                                        'Listrik' => 'Listrik',
                                    ])->required(),
                            ])->columns(2),
                            TextInput::make('location')
                                ->required(),
                        ]),

                    Step::make('Car Details')
                        ->icon('heroicon-o-truck')
                        ->description('Isi detail unit kendaraan')
                        ->schema([
                            Group::make([
                                TextInput::make('tahun')
                                    ->label('Tahun Produksi')
                                    ->numeric(),
                                TextInput::make('warna')
                                    ->label('Warna'),
                            ])->columns(2),
                            Group::make([
                                TextInput::make('plat_nomor')
                                    ->label('Plat Nomor'),
                                TextInput::make('kapasitas_mesin')
                                    ->label('Kapasitas Mesin (CC)')
                                    ->numeric(),
                            ])->columns(2),
                            TagsInput::make('fitur')
                                ->label('Fitur & Fasilitas')
                                ->placeholder('Tambah fitur'),
                            MarkdownEditor::make('kondisi')
                                ->label('Kondisi Kendaraan'),
                        ]),

                    Step::make('Media & Status')
                        ->icon('heroicon-o-photo')
                        ->description('Upload gambar dan atur status')
                        ->schema([
                            FileUpload::make('image')
                                ->label('Gambar Utama')
                                ->disk('public')
                                ->directory('products')
                                ->maxSize(2048),
                            FileUpload::make('images')
                                ->label('Galeri Gambar')
                                ->multiple()
                                ->reorderable()
                                ->appendFiles()
                                ->image()
                                ->disk('public')
                                ->directory('products')
                                ->maxSize(2048),
                            Checkbox::make('is_active')->label('Aktif'),
                            Checkbox::make('is_booked')->label('Booked / Disewa'),
                            Checkbox::make('is_featured')->label('Produk Unggulan'),
                        ]),

                ])
                    ->columnSpanFull()
                    ->submitAction(
                        Action::make('save')
                            ->label('Save Product')
                            ->color('primary')
                            ->submit('save')
                    ),
            ]);
    }
}

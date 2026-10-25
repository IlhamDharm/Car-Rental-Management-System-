<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
// Import Actions khusus struktur Filament v4 (Schema)
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Booking Mobil';

    protected static ?string $pluralModelLabel = 'Booking Mobil';

    // ----------------------------------------------------
    // FUNGSI PERHITUNGAN TOTAL HARGA OTOMATIS
    // ----------------------------------------------------
    protected static function updateTotalPrice(Get $get, Set $set): void
    {
        $productId = $get('product_id');
        $startDate = $get('start_date');
        $endDate = $get('end_date');

        if ($productId && $startDate && $endDate) {
            $product = Product::find($productId);

            if ($product) {
                $start = Carbon::parse($startDate);
                $end = Carbon::parse($endDate);

                if ($end->lessThan($start)) {
                    $set('total_price', 0);

                    return;
                }

                $duration = $start->diffInDays($end);
                if ($duration == 0) {
                    $duration = 1;
                }

                $totalPrice = $product->price * $duration;
                $set('total_price', $totalPrice);
            }
        }
    }

    // ----------------------------------------------------
    // FORM CONFIGURATION (CREATE & EDIT)
    // ----------------------------------------------------
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pelanggan & Mobil')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('Pilih Mobil')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        Forms\Components\Select::make('user_id')
                            ->label('Akun User Terkait')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('customer_contact')
                            ->label('Kontak/No. HP')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Detail Sewa & Pembayaran')
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga (Otomatis)')
                            ->numeric()
                            ->prefix('Rp')
                            ->readOnly()
                            ->required(),

                        Forms\Components\Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'transfer' => 'Transfer Bank',
                                'e_wallet' => 'E-Wallet',
                                'cash' => 'Tunai / Cash',
                            ])->required(),

                        Forms\Components\Select::make('status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled',
                            ])->default('pending')->required(),
                    ])->columns(2),

                Section::make('Informasi Tambahan Logistik')
                    ->schema([
                        Forms\Components\TextInput::make('pickup_location')
                            ->label('Lokasi Pengambilan'),

                        Forms\Components\TextInput::make('pickup_method')
                            ->label('Metode Pengambilan'),

                        Forms\Components\TextInput::make('return_method')
                            ->label('Metode Pengembalian'),

                        Forms\Components\TextInput::make('source_info')
                            ->label('Info Asal Orderan'),
                    ])->columns(2),

                // ==========================================
                // SECTION BARU: OPERASIONAL & DOKUMENTASI
                // ==========================================
                Section::make('Operasional & Dokumentasi')
                    ->description('Kelola status kendaraan dan bukti video serah terima mobil.')
                    ->schema([
                        Forms\Components\Select::make('rental_status')
                            ->label('Status Operasional Rental')
                            ->options([
                                'Menunggu Konfirmasi' => 'Menunggu Konfirmasi',
                                'Telah Dikonfirmasi' => 'Telah Dikonfirmasi',
                                'Pengembalian Dalam Proses' => 'Pengembalian Dalam Proses',
                                'Pengembalian Berhasil' => 'Pengembalian Berhasil',
                                'Dibatalkan' => 'Dibatalkan',
                            ])
                            ->default('Menunggu Konfirmasi')
                            ->required(),

                        Forms\Components\Toggle::make('agree_terms')
                            ->label('Pelanggan Telah Menyetujui Syarat & Ketentuan')
                            ->default(true)
                            ->inline(false),

                        Forms\Components\FileUpload::make('video_sebelum')
                            ->label('Video Kondisi Sebelum Dirental (Opsional)')
                            ->directory('bookings/videos_sebelum')
                            ->acceptedFileTypes(['video/mp4', 'video/quicktime', 'video/x-msvideo'])
                            ->maxSize(51200) // Maksimal 50MB
                            ->helperText('Unggah video kondisi mobil sebelum diserahkan ke pelanggan.'),

                        Forms\Components\FileUpload::make('video_sesudah')
                            ->label('Video Kondisi Sesudah Dirental (Opsional)')
                            ->directory('bookings/videos_sesudah')
                            ->acceptedFileTypes(['video/mp4', 'video/quicktime', 'video/x-msvideo'])
                            ->maxSize(51200) // Maksimal 50MB
                            ->helperText('Unggah video kondisi mobil saat dikembalikan oleh pelanggan.'),
                    ])->columns(2),
            ]);
    }

    // ----------------------------------------------------
    // TABLE CONFIGURATION (LIST VIEW)
    // ----------------------------------------------------
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('product.name')
                    ->label('Mobil')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai Sewa')
                    ->date('d M Y')
                    ->sortable(),

                // Kolom Baru: Status Operasional
                Tables\Columns\TextColumn::make('rental_status')
                    ->label('Status Rental')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu Konfirmasi' => 'warning',
                        'Telah Dikonfirmasi' => 'primary',
                        'Pengembalian Dalam Proses' => 'info',
                        'Pengembalian Berhasil' => 'success',
                        'Dibatalkan' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rental_status')
                    ->label('Filter Status Rental')
                    ->options([
                        'Menunggu Konfirmasi' => 'Menunggu Konfirmasi',
                        'Telah Dikonfirmasi' => 'Telah Dikonfirmasi',
                        'Pengembalian Dalam Proses' => 'Pengembalian Dalam Proses',
                        'Pengembalian Berhasil' => 'Pengembalian Berhasil',
                        'Dibatalkan' => 'Dibatalkan',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    // ----------------------------------------------------
    // INFOLIST CONFIGURATION (VIEW DETAILS)
    // ----------------------------------------------------
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Rangkuman Booking')
                    ->schema([
                        Infolists\Components\TextEntry::make('product.name')->label('Mobil yang Disewa'),
                        Infolists\Components\TextEntry::make('customer_name')->label('Nama Pelanggan'),
                        Infolists\Components\TextEntry::make('customer_contact')->label('No. Telepon'),
                        Infolists\Components\TextEntry::make('total_price')->label('Total Harga')->money('IDR', locale: 'id'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status Pembayaran')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'confirmed' => 'success',
                                'pending' => 'warning',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                    ])->columns(2),

                Section::make('Waktu & Logistik Pelaksanaan')
                    ->schema([
                        Infolists\Components\TextEntry::make('start_date')->label('Tanggal Mulai')->date('d F Y'),
                        Infolists\Components\TextEntry::make('end_date')->label('Tanggal Selesai')->date('d F Y'),
                        Infolists\Components\TextEntry::make('pickup_location')->label('Lokasi Jemput/Ambil'),
                        Infolists\Components\TextEntry::make('pickup_method')->label('Metode Pengambilan'),
                        Infolists\Components\TextEntry::make('return_method')->label('Metode Pengembalian'),
                        Infolists\Components\TextEntry::make('source_info')->label('Info Asal Orderan'),
                    ])->columns(2),

                // ==========================================
                // INFOLIST: OPERASIONAL & DOKUMENTASI
                // ==========================================
                Section::make('Operasional & Dokumentasi')
                    ->schema([
                        Infolists\Components\TextEntry::make('rental_status')
                            ->label('Status Rental')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Menunggu Konfirmasi' => 'warning',
                                'Telah Dikonfirmasi' => 'primary',
                                'Pengembalian Dalam Proses' => 'info',
                                'Pengembalian Berhasil' => 'success',
                                'Dibatalkan' => 'danger',
                                default => 'gray',
                            }),
                        Infolists\Components\IconEntry::make('agree_terms')
                            ->label('Persetujuan Syarat & Ketentuan')
                            ->boolean(),
                        Infolists\Components\TextEntry::make('video_sebelum')
                            ->label('Video Sebelum')
                            ->formatStateUsing(fn ($state) => $state ? 'Telah Diunggah' : 'Belum Ada Data')
                            ->badge()
                            ->color(fn ($state) => $state ? 'success' : 'gray'),
                        Infolists\Components\TextEntry::make('video_sesudah')
                            ->label('Video Sesudah')
                            ->formatStateUsing(fn ($state) => $state ? 'Telah Diunggah' : 'Belum Ada Data')
                            ->badge()
                            ->color(fn ($state) => $state ? 'success' : 'gray'),
                    ])->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}

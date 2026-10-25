<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required(),
            TextInput::make('email')
                ->email()
                ->required(),
            TextInput::make('password')
                ->password()
                ->dehydrated(fn($state) => filled($state)),

            Select::make('role')
                ->options([
                    'admin' => 'Admin',
                    'user' => 'User',
                ])
                ->required()
                ->native(true),

            Textarea::make('alamat')
                ->label('Alamat Lengkap')
                ->rows(2),

            Select::make('verification_status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])
                ->required()
                ->label('Status Verifikasi'),

            FileUpload::make('ktp_file')
                ->label('Foto KTP')
                ->image()
                ->disk('public')
                ->directory('profiles/ktp')
                ->visibility('public')
                ->imagePreviewHeight('250'),

            FileUpload::make('sim_file')
                ->label('Foto SIM A')
                ->image()
                ->disk('public')
                ->directory('profiles/sim')
                ->visibility('public')
                ->imagePreviewHeight('250')
        ]);
    }
}

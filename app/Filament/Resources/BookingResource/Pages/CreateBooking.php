<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Booking berhasil dibuat!')
            ->body('Booking mobil Anda telah berhasil dibuat dan menunggu konfirmasi.');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set status default ke pending jika belum diset
        if (! isset($data['status'])) {
            $data['status'] = 'pending';
        }

        return $data;
    }
}

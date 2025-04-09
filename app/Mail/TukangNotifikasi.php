<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class TukangNotifikasi extends Mailable
{
    use Queueable, SerializesModels;

    public $proyek;
    public $tukang;
    public $linkTerima;

    public function __construct($proyek, $tukang)
    {
        $this->proyek = $proyek;
        $this->tukang = $tukang;

        // Buat signed URL yang hanya berlaku 60 menit
        $this->linkTerima = URL::temporarySignedRoute(
            'proyek.terima', // nama route
            now()->addMinutes(60), // durasi aktif
            [
                'proyek' => $proyek->id,
                'tukang' => $tukang->id,
            ]
        );
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('subastianhambali@gmail.com', 'Admin Proyek'),
            subject: 'Undangan Proyek Baru',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.tukang-notifikasi',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

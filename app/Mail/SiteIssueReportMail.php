<?php

namespace App\Mail;

use App\Models\SiteIssue;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SiteIssueReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public SiteIssue $siteIssue)
    {
    }

    /**
     * Subject & pengirim email — menggantikan ->subject() di cara lama.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan Gangguan Net Site: ' . $this->siteIssue->netSite->name,
        );
    }

    /**
     * Isi email — "markdown" dipakai, bukan "view", supaya Laravel
     * render pakai komponen bawaan (button, panel, dll) dan otomatis
     * bikin versi plain-text juga.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.site-issue-report',
        );
    }
}
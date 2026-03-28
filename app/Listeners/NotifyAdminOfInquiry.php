<?php

namespace App\Listeners;

use App\Events\InquirySubmitted;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class NotifyAdminOfInquiry
{
    public function handle(InquirySubmitted $event): void
    {
        $to = config('services.inquiry.notify_email');
        if (! is_string($to) || $to === '' || filter_var($to, FILTER_VALIDATE_EMAIL) === false) {
            return;
        }

        $inquiry = $event->inquiry;
        $body = implode("\n", [
            'Inquiry baru masuk.',
            '',
            'Nama: ' . ($inquiry->name ?? '-'),
            'Telepon: ' . ($inquiry->phone ?? '-'),
            'Email: ' . ($inquiry->email ?? '-'),
            'Sumber: ' . ($inquiry->source ?? '-'),
            'Pesan: ' . ($inquiry->message ?? '-'),
            'Link WA (tersimpan): ' . ($inquiry->whatsapp_url ?? '-'),
        ]);

        try {
            Mail::raw($body, function ($message) use ($to, $inquiry): void {
                $message->to($to)
                    ->subject('[' . config('app.name') . '] Inquiry baru — ' . ($inquiry->name ?: 'Tanpa nama'));
            });
        } catch (Throwable $e) {
            report($e);
            Log::warning('Inquiry email notification failed', ['inquiry_id' => $inquiry->id]);
        }
    }
}

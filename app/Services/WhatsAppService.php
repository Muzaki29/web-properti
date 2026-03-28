<?php

namespace App\Services;

class WhatsAppService
{
    public function normalizePhone(string $phone): string
    {
        $phone = trim($phone);
        $phone = str_replace([' ', '-', '(', ')'], '', $phone);
        $phone = preg_replace('/[^0-9+]/', '', $phone) ?? '';

        if (str_starts_with($phone, '+')) {
            return substr($phone, 1);
        }

        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }

        return $phone;
    }

    public function buildUrl(string $phone, string $message): string
    {
        $normalized = $this->normalizePhone($phone);
        return 'https://wa.me/' . $normalized . '?text=' . urlencode($message);
    }

    /**
     * @param array<string, string|null> $lead
     */
    public function buildLeadMessage(array $lead): string
    {
        $name = trim(($lead['first_name'] ?? '') . ' ' . ($lead['last_name'] ?? ''));
        $project = $lead['project_title'] ?? '-';
        $message = $lead['message'] ?? '-';
        $contactPref = $lead['contact_pref'] ?? 'whatsapp';

        return "Halo {$name}, terima kasih sudah menghubungi Jagad Property.\n"
            . "Project/Properti: {$project}\n"
            . "Preferensi kontak: {$contactPref}\n"
            . "Pesan Anda: {$message}";
    }
}


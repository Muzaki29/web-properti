<?php

namespace App\Services;

use App\Events\InquirySubmitted;
use App\Models\Inquiry;

class InquiryService
{
    public function __construct(
        private readonly WhatsAppService $whatsAppService
    ) {
    }

    /**
     * Temporary business-layer helper until inquiry table is introduced
     * in the database phase. This keeps lead formatting logic out of controllers.
     *
     * @param array<string, mixed> $validated
     * @param string $targetPhone
     * @return array<string, mixed>
     */
    public function prepareLeadPayload(array $validated, string $targetPhone): array
    {
        $leadData = [
            'first_name' => (string) ($validated['first_name'] ?? ''),
            'last_name' => (string) ($validated['last_name'] ?? ''),
            'project_title' => isset($validated['project_title']) ? (string) $validated['project_title'] : null,
            'message' => isset($validated['message']) ? (string) $validated['message'] : null,
            'contact_pref' => isset($validated['contact_pref']) ? (string) $validated['contact_pref'] : null,
        ];

        $waMessage = $this->whatsAppService->buildLeadMessage($leadData);
        $waUrl = $this->whatsAppService->buildUrl($targetPhone, $waMessage);

        return [
            'lead' => $validated,
            'whatsapp_message' => $waMessage,
            'whatsapp_url' => $waUrl,
        ];
    }

    /**
     * @param array<string, mixed> $validated
     */
    public function createInquiry(array $validated, string $targetPhone): Inquiry
    {
        $payload = $this->prepareLeadPayload($validated, $targetPhone);

        $fullName = trim(
            (string) ($validated['first_name'] ?? '') . ' ' . (string) ($validated['last_name'] ?? '')
        );

        $inquiry = Inquiry::create([
            'property_id' => $validated['property_id'] ?? null,
            'name' => $fullName,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'message' => $validated['message'] ?? null,
            'source' => $validated['source'] ?? 'home',
            'whatsapp_url' => $payload['whatsapp_url'],
        ]);

        InquirySubmitted::dispatch($inquiry);

        return $inquiry;
    }
}


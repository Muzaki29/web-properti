<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadInquiryRequest;
use App\Services\InquiryService;
use Illuminate\Database\QueryException;
use Throwable;

class InquiryController extends Controller
{
    public function store(LeadInquiryRequest $request, InquiryService $inquiryService)
    {
        $validated = $request->validated();

        $targetPhone = (string) config('services.whatsapp.phone_e164_digits');

        try {
            $inquiryService->createInquiry($validated, $targetPhone);
        } catch (QueryException $e) {
            report($e);

            return redirect()->to(route('home') . '#contact')
                ->withInput()
                ->with('error', 'Gagal menyimpan inquiry. Jalankan migrasi terbaru lalu coba lagi.');
        } catch (Throwable $e) {
            report($e);

            return redirect()->to(route('home') . '#contact')
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim inquiry. Silakan coba lagi.');
        }

        return redirect()->to(route('home') . '#contact')
            ->with('success', 'Inquiry berhasil dikirim. Tim kami akan menghubungi Anda segera.');
    }
}


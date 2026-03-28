<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Placeholder controller for upcoming inquiry module.
     * Will be wired after inquiry migration/model/routes are introduced.
     */
    public function index()
    {
        return redirect()->route('admin.dashboard')
            ->with('error', 'Fitur inquiry belum aktif.');
    }

    public function show($id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', 'Detail inquiry belum tersedia.');
    }

    public function updateStatus(Request $request, $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', 'Update status inquiry belum tersedia.');
    }
}


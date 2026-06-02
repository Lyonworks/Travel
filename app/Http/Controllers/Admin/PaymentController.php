<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Load data payment beserta relasi polymorphic-nya
        $payments = Payment::with('booking')->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load('booking.user');
        return view('admin.payments.show', compact('payment'));
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Dibayar,Gagal,Refund',
        ]);

        $payment->update([
            'status' => $validated['status'],
        ]);

        // Opsional: Update status booking terkait menjadi 'confirmed' jika pembayaran 'Dibayar'
        if ($validated['status'] == 'Dibayar') {
            $payment->booking->update(['status' => 'confirmed', 'payment_status' => 'paid']);
        }

        return redirect()->back()->with('success', 'Status pembayaran berhasil diubah.');
    }
}

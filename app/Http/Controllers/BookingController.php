<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Menampilkan halaman detail sebelum memesan
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('user.booking_detail', compact('schedule'));
    }

    // Memproses pesanan ke database
    public function store(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        // Hitung total harga
        $total_price = $request->total_seats * $schedule->price;

        // Upload bukti pembayaran
        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Simpan ke tabel Bookings
        Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'total_seats' => $request->total_seats,
            'total_price' => $total_price,
            'payment_name' => $request->payment_name,
            'payment_proof' => $paymentProofPath
        ]);

        // Kurangi stok di tabel schedules
        $schedule->decrement('stock', $request->total_seats);

        // Kembali ke dashboard
        return redirect('/dashboard');
    }

    // Menampilkan riwayat pesanan user yang sedang login
    public function history()
    {
        $orders = Booking::where('user_id', Auth::id())
                        ->with('schedule') 
                        ->latest()
                        ->get();

        return view('user.history', compact('orders'));
    }
}
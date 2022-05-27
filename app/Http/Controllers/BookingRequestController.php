<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\CompanyConfiguration;
use App\Models\User;
use App\Notifications\BookingRequested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BookingRequestController extends Controller
{
    public function create()
    {
        return view('booking-requests.create', [
            'config' => CompanyConfiguration::first()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'keluhan' => 'required|max:255',
            'waktu_booking' => ['required', 'date', 'after:'.now()],
            'no_plat' => 'required',
            'no_telp' => 'required|max:15',
        ]);

        $booking = new BookingRequest();

        $booking->waktu_request = now();
        $booking->nama = $request->nama;
        $booking->email = $request->email;
        $booking->keluhan = $request->keluhan;
        $booking->waktu_booking = $request->waktu_booking;
        $booking->no_plat = $request->no_plat;
        $booking->no_telp = $request->no_telp;
        $booking->pernah_service = ($request->pernah_service === 'sudah');

        $booking->save();

        $users = User::where('kode_peran', 'ADMN')->orWhere('kode_peran', 'KBKL')->get();

        Notification::send($users, new BookingRequested($booking));

        return redirect(route('booking.thanks'));
    }

    public function thanks()
    {
        return view('booking-requests.thanks', [
            'config' => CompanyConfiguration::first()

        ]);
    }

    public function destroy(BookingRequest $booking)
    {
        if($booking->pendaftaran_service) {
            return redirect(route('bookings.index'))->with('error', 'Tidak bisa dihapus - Sudah didaftarkan.');

        }

        $booking->delete();
        return redirect(route('bookings.index'));
    }

    public function index()
    {
        return view('booking-requests.index');
    }
}

<?php

namespace App\Http\Livewire\BookingRequest;

use App\Mail\BookingAccepted;
use App\Models\BookingRequest;
use App\Models\Pelanggan;
use App\Models\PendaftaranService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public $booking;

    // Pelanggan
    public $pelangganMode;
    public $pelangganId;

    public $registeredPelanggan;

    public function mount($id)
    {
        $this->booking = BookingRequest::find($id);
        $this->pelangganMode = 'baru';
        if($this->booking->pernah_service){
            $match = Pelanggan::where('noTelp', $this->booking->no_telp)->where('nama', $this->booking->nama)->first();
            if($match){
                if(!(($match->email && $this->booking->email) && ($match->email !== $this->booking->email))){
                    $this->registeredPelanggan = $match;
                }
            }
        }
        $firstPelanggan = Pelanggan::first();
        $this->pelangganId = $firstPelanggan->id;

    }

    public function savePelanggan(){
        $this->authorize('create', Pelanggan::class);

        $pelanggan = new Pelanggan;

        $pelanggan->nama = $this->booking->nama;
        $pelanggan->noTelp = $this->booking->no_telp;
        $pelanggan->email = $this->booking->email;

        $pelanggan->save();

        $this->booking->pelanggan_id = $pelanggan->id;
        $this->booking->save();
        $this->booking->refresh();
    }

    public function savePendaftaran()
    {
        $this->authorize('create', PendaftaranService::class);

        if($this->registeredPelanggan){
            $this->booking->pelanggan_id = $this->registeredPelanggan->id;
        }else {
            $this->authorize('create', Pelanggan::class);
            $pelanggan = new Pelanggan;
            $pelanggan->nama = $this->booking->nama;
            $pelanggan->noTelp = $this->booking->no_telp;
            $pelanggan->email = $this->booking->email;
            $pelanggan->save();
            $this->booking->pelanggan_id = $pelanggan->id;
        }

        $this->booking->save();
        $this->booking->refresh();

        $pendaftaran = new PendaftaranService();
        $pendaftaran->waktu_pendaftaran = now();
        $pendaftaran->no_plat = $this->booking->no_plat;
        $pendaftaran->pelanggan_id = $this->booking->pelanggan_id;
        $pendaftaran->waktu_booking = $this->booking->waktu_booking;
        $pendaftaran->keluhan = $this->booking->keluhan;
        $pendaftaran->user_id = auth()->user()->id;
        $pendaftaran->booking_request_id = $this->booking->id;

        $pendaftaran->save();

        Mail::to($this->booking->email)->send(new BookingAccepted($pendaftaran));

        return redirect(route('pendaftaran-services.index'));
    }

    public function render()
    {
        return view('livewire.booking-request.show', [
            'pelanggans' => Pelanggan::all()
        ]);
    }
}

<?php

namespace App\Http\Livewire\BookingRequest;

use App\Models\BookingRequest;
use App\Models\Pelanggan;
use App\Models\PendaftaranService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public $booking;

    // Pelanggan
    public $pelangganMode;
    public $pelangganId;

    public function mount($id)
    {
        $this->booking = BookingRequest::find($id);
        $this->pelangganMode = 'baru';
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

        if($this->pelangganMode === 'baru' && !$this->booking->pelanggan_id){
            session()->flash('error', 'Buat pelanggan baru atau pilih pelanggan lama.');
            return;
        }

        $pendaftaran = new PendaftaranService();
        $pendaftaran->waktu_pendaftaran = now();
        $pendaftaran->no_plat = $this->booking->no_plat;
        $pendaftaran->pelanggan_id = $this->pelangganMode === 'baru' ? $this->booking->pelanggan_id : $this->pelangganId;
        $pendaftaran->waktu_booking = $this->booking->waktu_booking;
        $pendaftaran->keluhan = $this->booking->keluhan;
        $pendaftaran->user_id = auth()->user()->id;
        $pendaftaran->booking_request_id = $this->booking->id;

        $pendaftaran->save();

        return redirect(route('pendaftaran-services.index'));
    }

    public function render()
    {
        return view('livewire.booking-request.show', [
            'pelanggans' => Pelanggan::all()
        ]);
    }
}

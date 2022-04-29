<?php

namespace App\Http\Livewire\BookingRequest;

use App\Models\BookingRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    // Search and sort
    public $query = "";
    public $sortField;
    public $sortDir = "asc";

    // Continuation
    public $contSort = "semua";
    public $waktuBookingSort;
    
    public function setSort($field)
    {
        if($this->sortField === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        }else {
            $this->sortDir = 'asc';
        }

        $this->sortField = $field;
    }

    public function destroy(BookingRequest $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();
    }

    public function render()
    {
        $bookings = BookingRequest::search('id', $this->query)
            ->optionalSort($this->sortField, $this->sortDir);

        if($this->waktuBookingSort){
            $bookings->whereDate('waktu_booking', $this->waktuBookingSort);
        }

        return view('livewire.booking-request.index', [
            'bookings' => $bookings->paginate(10)
        ]);
    }
}

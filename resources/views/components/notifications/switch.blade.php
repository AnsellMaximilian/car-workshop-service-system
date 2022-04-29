@props(['notification'])

@switch(class_basename($notification->type))
    @case('ServicePaymentDue')
        <span>Service {{$notification->data['no_plat']}} siap dibayar.</span>
        @break
    @case('BookingRequested')
        <span>Request Booking Baru!</span>
        @break
    @default
        <span>Service Test</span>
        
@endswitch
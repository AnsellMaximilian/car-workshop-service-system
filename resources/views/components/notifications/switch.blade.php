@props(['notification'])

@switch(class_basename($notification->type))
    @case('ServicePaymentDue')
        <span>Service {{$notification->data['no_plat']}} siap dibayar.</span>
        @break
    @default
        <span>Service Test</span>
        
@endswitch
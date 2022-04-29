<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function ServicePaymentDue($id)
    {

        $notification = auth()->user()->notifications->where('id', $id)->first();

        $notification->markAsRead();

        return redirect(route('services.show', $notification->data['service']['id']));
    }

    public function BookingRequested($id)
    {

        $notification = auth()->user()->notifications->where('id', $id)->first();

        $notification->markAsRead();

        return redirect(route('bookings.show', $notification->data['booking']['id']));
    }
}

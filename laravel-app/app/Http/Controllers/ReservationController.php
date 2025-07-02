<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function reserve($wishId)
    {
        $wish = Wish::findOrFail($wishId);
        if ($wish->is_reserved) {
            return back()->with('error', 'Этот подарок уже забронирован!');
        }
        Reservation::create([
            'wish_id' => $wish->id,
            'user_id' => Auth::id(),
        ]);
        $wish->is_reserved = true;
        $wish->save();
        return back()->with('success', 'Подарок забронирован!');
    }

    public function unreserve($wishId)
    {
        $wish = Wish::findOrFail($wishId);
        $reservation = Reservation::where('wish_id', $wish->id)->where('user_id', Auth::id())->first();
        if ($reservation) {
            $reservation->delete();
            $wish->is_reserved = false;
            $wish->save();
            return back()->with('success', 'Бронирование снято!');
        }
        return back()->with('error', 'Вы не бронировали этот подарок!');
    }
} 
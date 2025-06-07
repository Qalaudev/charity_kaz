<?php

namespace App\Http\Controllers;

use App\Models\PaymentDonation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function storeDonation(Request $request)
    {
        $request->validate([
           'amount' => 'required|numeric',
           'card_number' => 'required|string|min:16|max:16',
        ]);

        $donation = PaymentDonation::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'card_last_digits' => substr($request->card_number,-4),
        ]);
        return response()->json(['message' => 'Успешно сохранено', 'donation' => $donation]);
    }

    public function myDonations()
    {
        return PaymentDonation::where('user_id', auth()->id())->latest()->get();
    }

    public function allDonations()
    {
        return PaymentDonation::with('user')->latest()->get();
    }

}

<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{

    public function paypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
              "return_url" => route('success'),
              "cancel_url" => route('cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ]
                ]
            ]
        ]);
//        dd($response);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return response()->json(['links' => $response['links']]);
                }
            }
        }
        return response()->json(['error' => 'Unable to create PayPal order.'], 500);

    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
//        dd($response);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $payment = new Payment();
            $payment->payment_id = $response['id'];
            $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = "Paypal";
            $payment->save();

            return redirect()->route('payment-success');

            unset($_SESSION['amount']);
        }else {
            return redirect()->route('cancel');
        }
    }

    public function cancel(Request $request)
    {

    }



}

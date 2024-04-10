<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\User;

class PaymentController extends Controller
{
  public function checkout(Request $request){
    // StripeClient::setApiKey(config('services.stripe.secret'));
    $stripe = new StripeClient(config('services.stripe.secret'));
    $order = Order::find($request->order_id);
    $customer = User::find($order->user_id);
    try {
      $checkout_session = $stripe->checkout->sessions->create([
        'line_items' => [[
          'price_data' => [
            'currency' => 'MYR',
            'product_data' => [
              'name' => 'test', 
            ],
            'unit_amount' => $order->order_price*100,
          ],  
          'quantity' => 1,
        ]],
        'customer' => $customer->stripe_id,
        'mode' => 'payment',
        'success_url' => route('api.payment.process').'?session_id={CHECKOUT_SESSION_ID}&order_id='.$order->id,
      //   'cancel_url' => route('employer.payment.process.checkout').'?session_id={CHECKOUT_SESSION_ID}',
      ]);
      dd($checkout_session);
      // return redirect()->route('payment.success')->with('success', 'Payment successful!');
      return response()->json(['data' => 'Payment successful!'], 200);
    } catch (\Exception $e) {
      // return redirect()->route('payment.failure')->with('error', $e->getMessage());
      return response()->json(['data' => $e->getMessage()], 404);
    }
  }

  public function processPayment(Request $request)
	{
		try {
      $stripe = new StripeClient(config('services.stripe.secret'));
      $checkout = $stripe->checkout->sessions->retrieve($request->session_id,array());
		} catch (\Exception $e) {
      return redirect()->route('employer.payment');
    }

    $order = Order::find($request->order_id);
    $transaction = Transaction::where('payment_id',$checkout->id)->first();
    if (!$transaction) {
      if ($checkout->status == 'complete' && $checkout->payment_status == 'paid'){
        $amount = number_format($checkout->amount_total/100, 2, '.','');
        $transaction_id = generate_unique_id("T-", "Transaction", "transaction_id");

        $transaction = Transaction::create([
          'order_id' => $request->order_id,
          'transaction_id' => $transaction_id,
          'payment_id' => $checkout->id,
          'order_price' => $amount,
          'description' => 'Stripe '.$checkout->mode.' - '.'direct',
          'type' => 'card',
        ]);

        DB::transaction(function() {
          $transaction->status = 1;
          $transaction->save();

          $order->status = 3;
        });

      } else {
        $transaction = Transaction::create([
          'order_id' => Auth::user()->profile->id,
          'payment_id' => $checkout->id,
          'order_price' => $amount,
          'description' => 'Stripe '.$checkout->mode.' - '.'direct',
          'type' => 'card',
        ]);
      }

      try {
        $pdf = PDF::loadView('order.payment_receipt', ['transaction' => $transaction]);

        Mail::send('email.payment', array('transaction' => $transaction), function($message) use ($transaction, $file){
          $message->from('payment-noreply@jobstore.com');
          $message->to(Auth::user()->email)
            ->bcc('payment@jobstore.com')
            ->subject('Jobstore Payment Receipt '.$transaction->payment_id);
          $message->attach($file, array('as' => 'jobstore_payment_receipt.pdf'));
        });
      }
      catch (\Exception $e) {
        Log::error($e);
      }
    }
		return view('employer.payment_confirmation', compact('transaction'));
	}

}
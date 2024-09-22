<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
  public function payOrder($order_id){
    $stripe = new StripeClient(config('services.stripe.secret'));
    $order_detail = OrderDetail::where('order_id', $order_id)->get();
    $customer = Auth::user();
    $line_items = [];

    foreach ($order_detail as $item) {
      $product = Product::find($item->product_id);

      $line_items[] = [
          'price_data' => [
              'currency' => 'MYR',
              'product_data' => [
                  'name' => $product->name,
              ],
              'unit_amount' => $item->order_price * 100, // Assuming $value holds individual order details
          ],
          'quantity' => 1,
      ];
    }
    dd($order_detail->count());
    try {
      $checkout_session = $stripe->checkout->sessions->create([
        'line_items' => $line_items,
        'customer' => $customer->stripe_id,
        'mode' => 'payment',
        'success_url' => route('api.payment.process').'?session_id={CHECKOUT_SESSION_ID}&order_id='.$order_id,
      //   'cancel_url' => route('employer.payment.process.checkout').'?session_id={CHECKOUT_SESSION_ID}',
      ]);

      // return redirect()->route('payment.success')->with('success', 'Payment successful!');
      return response()->json(['data' => $checkout_session], 200);
    } catch (\Exception $e) {
      // return redirect()->route('payment.failure')->with('error', $e->getMessage());
      return response()->json(['data' => $e->getMessage()], 404);
    }
  }

  public function processPayment(Request $request)
	{
		try {
      $stripe = new StripeClient(config('services.stripe.secret'));
      $checkout = $stripe->checkout->sessions->retrieve($request->session_id, []);
		} catch (\Exception $e) {
      return redirect()->route('employer.payment');
    }

    $order = Order::find($request->order_id);
    $transaction = Transaction::where('payment_id',$checkout->id)->first();
    dd($transaction);
    DB::beginTransaction();

    try {
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
              'status' => 1
            ]);

            $order->status = 3;
            $order->save();

        } else {
          $transaction = Transaction::create([
            'order_id' => Auth::user()->profile->id,
            'payment_id' => $checkout->id,
            'order_price' => $amount,
            'description' => 'Stripe '.$checkout->mode.' - '.'direct',
            'type' => 'card',
          ]);
        }

        // $pdf = PDF::loadView('order.payment_receipt', ['transaction' => $transaction]);

        // Mail::send('email.payment', array('transaction' => $transaction), function($message) use ($transaction, $file){
        //   $message->from('payment-noreply@simpleshop.com');
        //   $message->to(Auth::user()->email)
        //     ->bcc('payment@jobstore.com')
        //     ->subject('Simple Shop Payment Receipt '.$transaction->payment_id);
        //   $message->attach($file, array('as' => 'jobstore_payment_receipt.pdf'));
        // });
      }
    }
    catch (\Exception $e) {
      Log::error($e);
    }

    DB::commit();

		return view('employer.payment_confirmation', compact('transaction'));
	}

}
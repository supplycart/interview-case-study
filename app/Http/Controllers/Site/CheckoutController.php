<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use Cart;
use Illuminate\Http\Request;
use App\Contracts\OrderContract;
//use App\Services\PaypalService;

/**
 * Class CheckoutController
 * @package App\Http\Controllers
 * @author Haze Illias <hazreenaaida@gmail.com>
 */

class CheckoutController extends BaseController
{
    protected $orderRepository;
   // protected $payPal;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        //$this->payPal = $payPal;
    }

    public function getCheckout()
    {
        return view('site.pages.checkout');
    }

    public function placeOrder(Request $request)
    {
        $validator = (new Order)->getValidatorOrder($request->all());
        if (!$validator->fails()) {
            $order = $this->orderRepository->storeOrderDetails($request->all());
            if ($order) {
                Cart::clear();
                return $this->responseRedirectBack('Checkout successful.', 'success', true, true);
               // $this->payPal->processPayment($order);
            }
        }

        return redirect()->back()->with('message','Order not placed');
    }

    public function complete(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        Cart::clear();
        return view('site.pages.success', compact('order'));
    }
}

<?php
/**
 *
 * @Project: interview-case-study
 * @Filename: CartController.php
 * @Author: longnc <nguyenchilong90@gmail.com>
 * @Created Date: 12/16/20 7:00 PM
 *
 * @Description: Text description here
 */

namespace App\Http\Controllers;

use App\Libraries\Common;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
	
	public function __construct(Request $request){
		parent::__construct($request);
	}
	
	/**
	 * create order
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function postCreate(Request $request): JsonResponse
	{
		$validator = Validator::make($request->all(), [
			'data'    => 'required|array',
			'address' => 'required|string'
		]);
		if ($validator->fails()) {
			$response = Common::formatResponse($validator->errors(), Response::HTTP_BAD_REQUEST);
			return response()->json($response);
		}
		$user = $request->authUser;
		$totalAmount = 0;
		$orderDetails = [];
		$address = $request->input('address');
		// get price from db and sum total price for order
		foreach ($request->input('data') as $item) {
			$product = Product::select('id', 'price')
				->where(['id' => $item['id'], 'status' => 'PUBLISH'])
				->first();
			if(!empty($product)) {
				$totalAmount += ($product->price * $item['quantity']);
				array_push($orderDetails, [
					'order_id'   => 0,
					'product_id' => $item['id'],
					'price'      => $product->price,
					'qty'        => $item['quantity']
				]);
			}
		}
		// create order and order detail in transaction
		DB::beginTransaction();
		try {
			$order = Order::create([
				'user_id'      => $user->id,
				'total_amount' => round($totalAmount, 2),
				'address'      => $address,
				'status'       => 'ORDERED'
			]);
			if(!empty($orderDetails)) {
				foreach ($orderDetails as $detail) {
					$detail['order_id'] = $order->id;
					OrderDetail::create($detail);
				}
			}
			DB::commit();
			$response = Common::formatResponse([
				'message' => 'The order created and waiting for delivery to your address, please wait delivery and enjoy it.'
			]);
			return response()->json($response);
		} catch (\Exception $exception) {
			Log::debug($exception->getMessage());
			DB::rollBack();
			$response = Common::formatResponse([
				'message' => 'The order have problem during create, please check again or contact CS Team to help'
			], Response::HTTP_BAD_REQUEST);
			return response()->json($response);
		}
	}
	
}

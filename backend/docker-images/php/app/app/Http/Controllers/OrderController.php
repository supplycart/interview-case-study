<?php
/**
 *
 * @Project: interview-case-study
 * @Filename: OrderController.php
 * @Author: longnc <nguyenchilong90@gmail.com>
 * @Created Date: 12/16/20 7:00 PM
 *
 * @Description: Text description here
 */

namespace App\Http\Controllers;


use App\Models\Order;
use App\Libraries\Common;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	private $user;
	public function __construct(Request $request)
	{
		parent::__construct($request);
		$this->user = $request->authUser;
	}
	
	/**
	 * get list order of current user
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getList(Request $request)
	{
		if(!empty($this->user)) {
			$orders = Order::select(
				'id',
				'total_amount',
				'address',
				'status',
				'created_at',
				'updated_at')
				->where('user_id', '=', $this->user->id)
				->where('status', '!=', 'DELETED')
				->orderBy('updated_at', 'desc')
				->get();
			$response = Common::formatResponse($orders);
		} else {
			$message = 'Please login first then list order again';
			$response = Common::formatResponse(['message' => $message]);
		}
		return response()->json($response);
	}
	
	/**
	 * get order detail for current user
	 * @param Request $request
	 * @param int $orderId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getOrder(Request $request, int $orderId)
	{
		if(!empty($this->user)) {
			$order = Order::select(
				'id',
				'total_amount',
				'address',
				'status',
				'created_at',
				'updated_at')
				->where('user_id', '=', $this->user->id)
				->where('status', '!=', 'DELETED')
				->where('id', '=', $orderId)
				->first();
			$order->detail = OrderDetail::select(
				'order_details.id',
				'products.name',
				'products.short',
				'products.thumb')
				->join('products', 'order_details.product_id', '=', 'products.id')
				->where('order_id', '=', $orderId)
				->get();
			$response = Common::formatResponse($order);
		} else {
			$message = 'Please login first then list order again';
			$response = Common::formatResponse(['message' => $message]);
		}
		return response()->json($response);
	}
}

<?php
/**
 *
 * @Project: interview-case-study
 * @Filename: ProductController.php
 * @Author: longnc <nguyenchilong90@gmail.com>
 * @Created Date: 12/16/20 6:56 PM
 *
 * @Description: Text description here
 */

namespace App\Http\Controllers;


use App\Models\Product;
use App\Libraries\Common;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
	public function __construct(Request $request){
		parent::__construct($request);
	}
	
	/**
	 * Get list products
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getList(Request $request)
	{
		$products = Product::select(
			'id',
			'name',
			'short',
			'description',
			'price',
			'thumb')
			->where('status', 'PUBLISH')
			->orderBy('updated_at', 'desc')
			->get();
		$formated = $this->formatProducts($products);
		$response = Common::formatResponse($formated);
		return response()->json($response);
	}
	
	/**
	 * Get product by ID
	 * @param Request $request
	 * @param int $productId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getProduct(Request $request, int $productId)
	{
		if(empty($productId)) {
			$response = Common::formatResponse([
				'message' => 'The field productId is required'
			], Response::HTTP_BAD_REQUEST);
			return response()->json($response);
		}
		$product = Product::find($productId);
		if(empty($product)) {
			$response = Common::formatResponse([
				'message' => 'The value productId not have in system, please check again'
			], Response::HTTP_BAD_REQUEST);
			return response()->json($response);
		}
		$formated = $this->productItem($product);
		$response = Common::formatResponse($formated);
		return response()->json($response);
	}
	
	/**
	 * format list products items for demo
	 * @param $products
	 * @return array
	 */
	private function formatProducts($products)
	{
		$formated = [];
		if(!empty($products)) {
			foreach ($products as $key => $item) {
				$product = $this->productItem($item);
				array_push($formated, $product);
			}
		}
		return $formated;
	}
	
	/**
	 * format one product item
	 * @param $product
	 * @return array
	 */
	private function productItem($product)
	{
		return [
			'id'            => $product->id,
			'title'         => $product->name,
			'short'         => $product->short,
			'description'   => $product->description,
			'thumb'         => $product->thumb,
			'price'         => $product->price,
			'ratings'       => rand(1, 5),
			'reviews'       => rand(1, 5),
			'isAddedToCart' => false,
			'isAddedBtn'    => false,
			'isFavourite'   => false,
			'quantity'      => 1
		];
	}
}

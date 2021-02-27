<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use \Exception;

class ProductService
{

    /**
     * @param $request
     * @return mixed
     */
    public function getProducts($request)
    {
        $products = Product::get();
        if ($products) {
            $products = $products->toArray();
            foreach ($products as $id => $product) {
                $products[$id] = $this->generateSign($request, $products[$id]);
            }
        }

        return $products;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getProduct($request)
    {
        $product = Product::where('id', $request->product_id)->first();
        if ($product) {
            $product = $product->toArray();
            $product = $this->generateSign($request, $product);
        }

        return $product;
    }

    /**
     * @param $request
     * @return array
     */
    public function getCart($request)
    {
        try {
            $carts = json_decode($request->carts, true);
            $products_ids = array_keys($carts);
            $products = Product::whereIn('id', $products_ids)->get();
            $subtotal = 0;
            $sign = '';
            if ($products) {
                $products = $products->toArray();
                foreach ($products as $id => $product) {
                    if ( isset( $carts[$product['id']] ) ) {
                        $products[$id] = $this->generateSign($request, $products[$id]);

                        $sign = $products[$id]['sign'];
                        $products[$id]['quantity'] = $carts[ $product['id'] ];
                        $total_product_price = $products[$id]['price'] * $carts[ $product['id'] ];
                        $products[$id]['total'] = number_format((float) $total_product_price, 2, '.', '');
                        $subtotal += $total_product_price;
                    }
                }
            }

            $delivery = Product::DELIVERY_PRICE;
            $discount = Product::DISCOUNT_PRICE;
            $subtotal = number_format((float) $subtotal, 2, '.', '');
            $total = number_format((float) $subtotal + $delivery - $discount, 2, '.', '');
            return [
                'success' => true,
                'products' => $products,
                'subtotal' => $subtotal,
                'delivery' => $delivery,
                'discount' => $discount,
                'total' => $total,
                'sign' => $sign,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Some error'
            ];
        }
    }

    /**
     * @param $request
     * @param $product
     * @return mixed
     */
    public function generateSign($request, $product)
    {
        if ( isset($request->currency) && $request->currency == Product::CURRENCY_EUR ) {
            $product['price'] = number_format((float) $product['price'] * Product::CURRENCY_EUR_RATE, 2, '.', '');
            $product['sign'] = Product::CURRENCY_EUR_SIGN;
        } else {
            $product['sign'] = Product::CURRENCY_MYR_SIGN;
        }
        return $product;
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateCheckout($data)
    {
        $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'is_create_account' => ['required', 'integer'],
        ];

        if ($data['is_create_account'] == User::CREATE_ACCOUNT) {
            $rules = array_merge($rules, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'max:250', 'string'],
            ]);
        }
        $validator = Validator::make($data, $rules);

        return $validator;
    }


    /**
     * @param $request
     * @return mixed
     */
    public function getProductsForCheckout($request)
    {
        $carts = $request->carts;
        $products_ids = array_keys($carts);
        return Product::whereIn('id', $products_ids)->get();
    }



}

<?php

namespace App;

class Cart
{

	// public $pizzas = null;
	// public $totalQty = 0;
	// public $totalPrice = 0;

	// public function __construct($oldCart)
	// {
	// 	if ($oldCart) 
	// 	{
	// 		$this->pizzas = $oldCart->pizzas;
	// 		$this->totalQty = $oldCart->totalQty;
	// 		$this->totalPrice = $oldCart->totalPrice;
	// 	}
	// }

	// public function add($pizza, $id) 
	// {
	// 	$storedItem = ['qty' => 0, 'price' => $pizza->price, 'pizza' => $pizza, 'id' => $id];
	// 	if ($this->pizzas) 
	// 	{
	// 		if (array_key_exists($id, $this->pizzas)) 
	// 		{
	// 			$storedItem = $this->pizzas[$id];
	// 		}
	// 	}
	// 	$storedItem['qty']++;
	// 	$storedItem['price'] = $pizza->price * $storedItem['qty'];
	// 	$this->pizzas[$id] = $storedItem;
	// 	$this->totalQty++;
	// 	$this->totalPrice += $pizza->price;
	// }

	// public function reduce($id) 
	// {
	// 	$this->pizzas[$id]['qty']--;
	// 	$this->pizzas[$id]['price'] -= $this->pizzas[$id]['pizza']['price'];
	// 	$this->totalQty--;
	// 	$this->totalPrice -= $this->pizzas[$id]['pizza']['price'];

	// 	if ($this->pizzas[$id]['qty'] <= 0)
	// 	{
	// 		unset($this->pizzas[$id]);
	// 	}
	// }

	// public function increase($id) 
	// {
	// 	$this->pizzas[$id]['qty']++;
	// 	$this->pizzas[$id]['price'] += $this->pizzas[$id]['pizza']['price'];
	// 	$this->totalQty++;
	// 	$this->totalPrice += $this->pizzas[$id]['pizza']['price'];
	// }
}
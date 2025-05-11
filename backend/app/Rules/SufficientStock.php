<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Product;

class SufficientStock implements ValidationRule
{
    protected int $requestedQuantity;

    /**
     * Create a new rule instance.
     * The $value passed to validate from the FormRequest 'items.*' rule is the individual item array.
     */
    public function __construct()
    {
        // Quantity is accessed from the $value in the validate method
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute The attribute name (e.g., 'items.0')
     * @param  mixed  $value   The value of the attribute (e.g., ['product_id' => 1, 'quantity' => 2])
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value) || !isset($value['product_id']) || !isset($value['quantity'])) {
            // This shouldn't happen if 'items.*.product_id' and 'items.*.quantity' are required.
            // But good for robustness.
            $fail('Invalid item data structure.');
            return;
        }

        $productId = $value['product_id'];
        $requestedQuantity = (int)$value['quantity'];

        /** @var Product|null $product */
        $product = Product::find($productId);

        if (!$product) {
            // This should be caught by 'exists:products,id' but good to double check.
            $fail("The product for item :position does not exist.")->translate(['position' => $this->getItemPosition($attribute) + 1]);
            return;
        }

        if ($product->stock_quantity < $requestedQuantity) {
            $fail("Not enough stock for :product_name. Requested: :requested, Available: :available.")
                ->translate([
                    'product_name' => $product->name,
                    'requested' => $requestedQuantity,
                    'available' => $product->stock_quantity,
                ]);
        }
    }

    /**
     * Helper to get item position from attribute name like 'items.0'.
     */
    private function getItemPosition(string $attribute): int
    {
        return (int) explode('.', $attribute)[1];
    }
}

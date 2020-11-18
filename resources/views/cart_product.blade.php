@forelse ($cart as $product)
<div class="flex justify-between mt-6 pb-2 border-b">
    <div class="flex">
        <img class="h-20 w-20 object-cover rounded" src="{{$product->image_path}}" alt="">
        <div class="mx-3">
            <h3 class="text-sm font-bold">{{$product->name}}</h3>
            <div class="flex text-gray-700 mt-2">{{$product->qty}} x RM{{number_format($product->price, 2)}}</div>
        </div>
    </div>
    <div class="flex">{{number_format($product->total, 2)}}</div>
</div>
@empty
<p class="font-bold text-2xl text-center">No items in cart.</p>
@endforelse
<option>select action ..</option>
@if ($order->status !== 'pending payment')
    <option value="repeat" data-order-id="{{$order->id}}">Repeat Order</option>
@else
    <option value="replay payment" data-order-id="{{$order->id}}">Pay Now</option>
    <option value="deleted" data-order-id="{{$order->id}}">Cancel Order</option>
@endif
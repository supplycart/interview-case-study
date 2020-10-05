<!-- Modal -->
<div class="modal fade" id="cartModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('addcart')}}" method="POST">
                    @csrf
                    <div class=" p-2">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <label for="name">Name:</label>
                        <input name="name" value="{{$product->name}}" readonly />
                        <hr>
                        <label for="price">Price:</label>
                        <input name="price" value="{{$product->price}}" readonly />
                        <hr>
                        <div>
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" />
                        </div>
                    </div>
                    <button class="btn btn-primary"> Add to Cart</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
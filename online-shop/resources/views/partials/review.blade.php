<div class="col-md-6">
    <h4 class="mb-4">Leave a review</h4>
    <small>Your email address will not be published. Required fields are marked *</small>
    <form method="POST" action="{{ url('product-detail/' . $product->id . '/review') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex my-3">
            <p class="mb-0 mr-2">Your Rating * :</p>
            <div class="text-primary">
                @for ($i = 0; $i < 5; $i++)
                    <input value={{ $i + 1 }} id={{ 'radio' . $i }} type="radio" name="rating">
                    @for ($j = 0; $j < 5; $j++)
                        @if ($j <= $i)
                            <small class="fa fa-star text-primary mr-1"></small>
                        @else
                            <small class="far fa-star text-primary mr-1"></small>
                        @endif
                    @endfor
                    <br />
                @endfor
            </div>
        </div>
        <div class="form-group">
            <label for="message">Your Review *</label>
            <textarea name="review_message" cols="30" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-primary px-3">Leave Your Review</button>
        </div>
    </form>
</div>
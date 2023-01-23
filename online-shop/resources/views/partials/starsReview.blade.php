@for ($i = 0; $i < 5; $i++)
    @if (((($review->rating) - $i) < 1) && (($review->rating) - $i) > 0 )
        <small class="fa fa-star-half-alt text-primary mr-1"></small>
    @else
        @if ($i < ($review->rating))
            <small class="fa fa-star text-primary mr-1"></small>
        @else
            <small class="far fa-star text-primary mr-1"></small>
        @endif
    @endif
@endfor

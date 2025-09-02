@foreach($product->sizes as $size)
<div class="custom-size" data-width="{{ $size->width }}" data-height="{{ $size->height }}" data-price="{{ $size->price }}">
    {{ $size->width.'X'.$size->height }}
</div>
@endforeach
<div class="form-group row">
    <div class="col-12 product-images-wrapper" style="padding: 5px">
        @if(!empty($product->image))
             @foreach($product->image as $image)
                <div class="row  product-images-row" style="width: 60%; margin: 32px auto 0;">
                    <div class="col-8">
                            <img src="{{Storage::url( $image->path)}}" height="250" width="250">
                            <br><br>
                        @if(!$product->image())
                        <input type="file" name="products-images[]">
                        @endif
                    </div>
                    <div class="col-4">
                        <button class="btn btn-danger product-images-remove ajax"
                                data-route="{{route('ajax.image.remove', $image->id)}}"
                        >Remove</button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="col-12">
        <button class="btn btn-outline-primary product-image-add float-right mt-2">Add Image</button>
    </div>
</div>
@push('footer-scripts')
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/admin/products-images.js') }}"></script>
@endpush

@extends('layouts.admin')

@section('content')
    <div class="container" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('SKU') }}</th>
                        <th scope="col">{{ __('Pictures') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Category') }}</th>
                        <th scope="col">{{ __('Small description') }}</th>
                        <th class="text-center" scope="col">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @each('admin.products.parts.product_row', $products , 'product')

                    </tbody>
                </table>

                {{$products->links()}}
            </div>
        </div>
    </div>
@endsection

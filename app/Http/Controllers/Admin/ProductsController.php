<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('category')->paginate(5);

        return view('admin/products/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all()->toArray();
        return view('admin/products/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(CreateProductRequest $request)
    {
       $product = $request->all();
       unset($product['products-images']);
       unset($product['_token']);
       unset($product['thumbnail']);
        if(!empty($request->file('thumbnail'))) {
            $imageService = app()->make(\App\Services\Contract\ImageServiceInterface::class);
            $filePath = $imageService->upload($request->file('thumbnail'));
            $product['thumbnail'] = $filePath;
        }
        $product = Product::create($product);

        if(!empty($request->file('products-images'))) {
            foreach ($request->file('products-images') as $image) {
                $filePath = $imageService->upload($image);
                $product->image()->create(['path' => $filePath]);
            }
        }

        return redirect(route('admin.products.index'))->with(['status' => 'The product has been created!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->toArray();
        return view('admin/products/edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update([
            'category_id'       => $request->get('category_id'),
            'sku'               => $request->get('sku'),
            'name'              => $request->get('name'),
            'description'       => $request->get('description'),
            'short_description' => $request->get('short_description'),
            'price'             => $request->get('price'),
            'discount'          => $request->get('discount'),
            'quantity'          => $request->get('quantity'),
        ]);

        unset($product['_token']);

        $imageService = app()->make(\App\Services\Contract\ImageServiceInterface::class);

        if(!empty($request->file('thumbnail'))) {

            $imageService->remove($product->image()->first()->path);
            $filePath = $imageService->upload($request->file('thumbnail'));
            $product->update([
                'thumbnail' => $filePath
            ]);
        }

        if(!empty($request->file('products-images'))) {
            foreach ($request->file('products-images') as $image) {
                $filePath = $imageService->upload($image);
                $product->image()->create(['path' => $filePath]);
            }
        }

        return redirect(route('admin.products.index'))->with(['status' => 'The product has been update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Product $product)
    {
        $imageService = app()->make(\App\Services\Contract\ImageServiceInterface::class);
        $imageService->remove($product->thumbnail);

        if($product->image()) {
            $paths = $product
                ->image()
                ->select('path')
                ->where('imageable_id', '=', $product->id)
                ->get()
                ->toArray();

            foreach ($paths as $path) {
                $imageService->remove( $path['path']);
            }
            $product->image()->delete();
        }

        $product->delete();

        return redirect(route('admin.products.index'))
            ->with(['status' => 'The product was successfully delete.']);
    }
}

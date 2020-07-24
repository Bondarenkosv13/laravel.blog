<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::withCount('products')->paginate(5);

        return view('admin/categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateCategoryRequest $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateCategoryRequest $request, Category $category)
    {
       $newCategory = $category->create([
           'name'        => $request->get('name'),
           'description' => $request->get('description')
       ]);

       if(!empty($request->file('image'))) {

           $imageService = app()->make(\App\Services\Contract\ImageServiceInterface::class);
           $filePath = $imageService->upload($request->file('image'));

           $newCategory->image()
               ->create([
                   'path'=> $filePath
               ]);
       }

       return redirect(route('admin.categories.index'))
           ->with(['status' => 'The new category was successfully create.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {

        $image = null;
        if($category->image()->exists()) {
            $image = $category->image()->first();
        }
        return view('admin/categories/edit', compact('category', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        /**
         * не использовал CategoryObserve потому что он не работает если менять только картинку.
         * Поэтому сделал на прямую
         */

        if(!empty($request->file('image'))) {

                $imageService = app()->make(\App\Services\Contract\ImageServiceInterface::class);
                $imageService->remove($category->image()->first()->path);
                $filePath = $imageService->upload($request->file('image'));

            if($category->image()->first()) {
                $category->image()
                    ->update([
                        'path' => $filePath
                    ]);
            } else {
                $category->image()
                    ->create([
                        'path' => $filePath
                    ]);
            }
        }

        return redirect(route('admin.categories.index'))
            ->with(['status' => 'The category was successfully update.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $imageService = app()->make(\App\Services\Contract\ImageServiceInterface::class);
        $imageService->remove($category->image()->first()->path);

        return redirect(route('admin.categories.index'))
            ->with(['status' => 'The category was successfully delete.']);
    }
}

<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function remove(Image $image)
    {
        $image->delete();
        $imageService = app()->make(\App\Services\Contract\ImageServiceInterface::class);
        $imageService->remove($image->path);
        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}

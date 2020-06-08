<?php
namespace App\Services\Contract;

use Illuminate\Http\UploadedFile;

interface ImageServiceInterface
{
    /**
     * @param string $file
     * @return string
     */
    public function upload(UploadedFile $file): string;

    /**
     * @param string $file
     */
    public function remove(string $file);

}

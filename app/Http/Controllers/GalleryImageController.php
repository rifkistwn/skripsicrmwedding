<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryImageController extends Controller
{
    public function store($galleryId)
    {
        try {
            $this->uploadImage($galleryId);
        }catch (Throwable $th) {
            return redirect()->back()->with('error','Save Error!');
        }
    }

    public function destroy()
    {
        try {
            $data = $this->deleteImage();
            if($data){
                return redirect()->route('admin.gallery.edit', request('gallery_id'))->with('success', 'Delete Success.');
            }else {
                return redirect()->route('admin.gallery.edit', request('gallery_id'))->with('error', 'File Not Exists.');
            }
        }catch (Throwable $th) {
            return redirect()->back()->with('error','Save Error!');
        }
    }

    public function uploadImage($galleryId)
    {
        $request = request()->all();
        $images = request('image');
        unset($request['image']);
        $request['gallery_id'] = $galleryId;

        foreach($images as $value)
        {
            if(request()->hasFile('image')) {
                $path = $this->handleImage($value, $galleryId);
                $request['path'] = $path;
                GalleryImage::create($request);
            }
        }
    }

    public function deleteImage()
    {
        $banner = GalleryImage::findOrFail(request('id'));
        $banner->delete();
        return $this->deleteStorageImage($banner);
    }

    public function deleteStorageImage($banner)
    {
        return Storage::disk('public')->exists($banner->path) ? Storage::disk('public')->delete($banner->path) : false;
    }

    private function handleImage($image, $galleryId)
    {
        return Storage::disk('public')->putFileAs('gallery'. '/' . base64_encode($galleryId) .'/' , $image, Str::random(12) .'.'.$image->getClientOriginalExtension());
    }
}

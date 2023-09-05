<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsImageRequest;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class NewsImageController extends Controller
{
    public function store(NewsImageRequest $request)
    {
        try {
            $this->uploadImage();
            return redirect()->route('admin.news.image', request('news_id'))
            ->with('success', 'Upload Success.');
        }catch (Throwable $th) {
            return redirect()->back()->with('error','Save Error!');
        }
    }

    public function destroy()
    {
        try {
            $data = $this->deleteImage();
            if($data){
                return redirect()->route('admin.news.image', request('news_id'))->with('success', 'Delete Success.');
            }else {
                return redirect()->route('admin.news.image', request('news_id'))->with('error', 'File Not Exists.');
            }
        }catch (Throwable $th) {
            return redirect()->back()->with('error','Save Error!');
        }
    }

    public function uploadImage()
    {
        $request = request()->all();
        $images = request('image');
        unset($request['image']);

        foreach($images as $value)
        {
            if(request()->hasFile('image')) {
                $path = $this->handleImage($value);
                $request['path'] = $path;
                NewsImage::create($request);
            }
        }
    }

    public function deleteImage()
    {
        $banner = NewsImage::findOrFail(request('id'));
        $banner->delete();
        return $this->deleteStorageImage($banner);
    }

    public function deleteStorageImage($banner)
    {
        return Storage::disk('public')->exists($banner->path) ? Storage::disk('public')->delete($banner->path) : false;
    }

    private function handleImage($image)
    {
        return Storage::disk('public')->putFileAs('news'. '/' . base64_encode(request('news_id')) .'/' , $image, Str::random(12) .'.'.$image->getClientOriginalExtension());
    }
}

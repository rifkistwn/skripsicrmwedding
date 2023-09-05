<?php

namespace App\Http\Controllers\Admin\Venue;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VenueImageRequest;
use App\Models\VenueImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Throwable;

class VenueImageController extends Controller
{
    public function store(VenueImageRequest $request)
    {
        try {
            $this->uploadImage();
            return redirect()->route('admin.venue.image', request('venue_id'))
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
                return redirect()->route('admin.venue.image', request('venue_id'))->with('success', 'Delete Success.');
            }else {
                return redirect()->route('admin.venue.image', request('venue_id'))->with('error', 'File Not Exists.');
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
                VenueImage::create($request);
            }
        }
    }

    public function deleteImage()
    {
        $banner = VenueImage::findOrFail(request('id'));
        $banner->delete();
        return $this->deleteStorageImage($banner);
    }

    public function deleteStorageImage($banner)
    {
        return Storage::disk('public')->exists($banner->path) ? Storage::disk('public')->delete($banner->path) : false;
    }

    private function handleImage($image)
    {
        return Storage::disk('public')->putFileAs('venue'. '/' . base64_encode(request('venue_id')) .'/' , $image, Str::random(12) .'.'.$image->getClientOriginalExtension());
    }
}

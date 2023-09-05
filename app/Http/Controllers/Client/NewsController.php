<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\News;
use Throwable;

class NewsController extends Controller
{
    public function index()
    {
      $news = $this->getNews();
      $hardcodes = $this->getHardcodeData();

      return view('client.pages.news.index', compact('news', 'hardcodes'));
    }
    
    public function show($slug)
    {
      $news = $this->showNews($slug);

      return view('client.pages.news.show', compact('news'));
    }

    private function getNews()
    {
      try {
        return News::with('images')->paginate()->map(function($news) {
          $thumbnails = $news->images;
          
          $news->thumbnail = count($thumbnails) ? "storage/{$thumbnails[0]->path}" : $this->getHardcodeData()->thumbnails;
  
          return $news;
        });
      } catch(Throwable $th) {
        return redirect()->back()->with('error', $th->getMessage());
      }
    }

    private function showNews($slug)
    {
      try {
          return News::whereSlug($slug)->with('images')->firstOrFail();
      } catch (Throwable $th) {
          return redirect()->back()->with('error', $th->getMessage());
      }
    }

    private function getHardcodeData()
    {
      return (object) [
        'thumbnails' => 'assets/images/client/images/default-news-image.jpg'
      ];
    }
}

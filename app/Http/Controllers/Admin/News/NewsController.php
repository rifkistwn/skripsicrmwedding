<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.news.index');
    }
    public function create()
    {
        return $this->form(new News);
    }

    public function edit(News $news)
    {
        return $this->form($news);
    }

    public function store(NewsRequest $request)
    {
        try {
            $data = request()->all();
            $data['slug'] = Str::slug($data['title'], '-');
            
            News::create($data);
            return redirect()->route('admin.news.index')
            ->with('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(NewsRequest $request, News $news)
    {
        try {            
            $news->update(request()->all());
            return redirect()->route('admin.news.index')
            ->with('success', 'Data berhasil diupdate.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(News $news)
    {
        try {
            $news->delete();
            return redirect()->route('admin.news.index')
            ->with('success', 'Data berhasil dihapus.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    protected function form(News $news)
    {
        $exists = $news->exists;
        return view('admin.news.form', [
            'data' => $news,
            'action' => !$exists ? route('admin.news.store') : route('admin.news.update', $news),
            'method' => !$exists ? 'POST' : 'PUT',
        ]);
    }

    public function image($news_id)
    {
        $action['upload'] = route('admin.news.uploadImage');
        $action['delete'] = route('admin.news.deleteImage');
        return view('admin.news.image', [
            'action' => $action,
            'news_id'   => $news_id,
            'method' => 'POST',
            'data' => NewsImage::whereNewsId($news_id)->get()
        ]);
    }

    private function query()
    {
        return News::all();
    }

    private function datatables($query)
    {
        return datatables()->of($query)
        ->addColumn('action', function($model) {
            return $this->getActionButtons($model);
        })
        ->addIndexColumn()
        ->escapeColumns([])
	    ->make(true);
    }

    private function getActionButtons($value)
    {
    	$edits = route('admin.news.edit', $value->id);
    	$destroy = route('admin.news.destroy', $value->id);
        $image = route('admin.news.image', $value->id);
        
    	return view('include.datatables.action_buttons', compact('edits','destroy','image'))->render();
    }
}


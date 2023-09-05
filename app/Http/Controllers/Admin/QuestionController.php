<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.question.index');
    }

    private function query()
    {
        return Question::orderByDesc('created_at');
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
    	$reply = $value->phone;
        
    	return view('include.datatables.action_buttons', compact('reply'))->render();
    }
}

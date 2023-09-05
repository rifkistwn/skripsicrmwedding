<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.event.index');
    }

    public function edit(Event $event)
    {
        return $this->form($event);
    }

    public function store($event)
    {
        try {            
            $event['slug'] = Str::slug($event['title'], '-');
            Event::updateOrCreate(
                [
                    'transaction_detail_id' => $event['transaction_detail_id']
                ],
                $event
            );
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        } 
    }

    public function update(EventRequest $request, Event $event)
    {
        try {            
            $event->update(request()->all());
            return redirect()->route('admin.event.index')
            ->with('success', 'Data berhasil diupdate.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($event)
    {
        try {
            $event->delete();
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    protected function form(Event $event)
    {
        $exists = $event->exists;
        return view('admin.event.form', [
            'data' => $event,
            'action' => !$exists ? route('admin.event.store') : route('admin.event.update', $event),
            'method' => !$exists ? 'POST' : 'PUT',
        ]);
    }

    private function query()
    {
        return Event::select('events.*')->with('transaction','transaction.transaction.user:id,name', 'transaction.packet:id,name', 'transaction.venue:id,name')->orderByDesc('created_at');
    }

    public function findByTransactionDetailId($transaction_id)
    {
        return Event::whereIn('transaction_detail_id', $transaction_id);
    }

    private function datatables($query)
    {
        return datatables()->of($query)
        ->addColumn('action', function($model) {
            return $this->getActionButtons($model);
        })
        ->addColumn('datetime', function($query) {
            return date("d-m-Y H:i:s", strtotime($query->transaction->datetime));
        })
        ->editColumn('venue_name', function($query) {
            return $query->transaction->venue ? $query->transaction->venue->name : '-';
        })
        ->addIndexColumn()
        ->escapeColumns([])
	    ->make(true);
    }

    private function getActionButtons($value)
    {
    	$edit = route('admin.event.edit', $value->id);
        
    	return view('include.datatables.action_buttons', compact('edit'))->render();
    }
}

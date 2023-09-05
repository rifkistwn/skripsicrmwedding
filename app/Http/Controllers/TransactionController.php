<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\EventController;
use App\Http\Requests\TransactionEditRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.transaction.index');
    }
    public function create()
    {
        return $this->form(new Transaction);
    }

    public function edit(Transaction $transaction)
    {
        return $this->form($transaction);
    }

    public function store(TransactionRequest $request)
    {
        try {
            $data = request()->all();

            Transaction::create($data);
            return redirect()->route('admin.promo.index')
            ->with('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(Transaction $transaction)
    {
        try {
            $data = request()->all();
            $data['approved_by'] = auth()->user()->id;
            $transaction->update($data);
            if(request('status') == Transaction::PAID) {
                foreach ($data['title'] as $index => $value) {
                    $event['title'] = $value;
                    $event['transaction_detail_id'] = $data['transaction_detail_id'][$index];
                    (new EventController)->store($event);
                }

            }else {
                $check = (new EventController)->findByTransactionDetailId($transaction->details->pluck('id'));
                $check ? (new EventController)->destroy($check) : null;
            }

            return redirect()->route('admin.transaction.index')
            ->with('success', 'Data berhasil diupdate.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Transaction $transaction)
    {
        abort(404);
    }

    protected function form(Transaction $transaction)
    {
        $exists = $transaction->exists;
        return view('admin.transaction.form', [
            'data' => $transaction,
            'total_price' => $transaction->details->sum('price') + $transaction->unique_price_code,
            'action' => !$exists ? route('admin.transaction.store') : route('admin.transaction.update', $transaction),
            'method' => !$exists ? 'POST' : 'PUT',
        ]);
    }

    private function query()
    {
        return Transaction::select('transactions.*')->with('user')->orderByDesc('created_at');
    }

    private function datatables($query)
    {
        return datatables()->of($query)
        ->addColumn('action', function($model) {
            return $this->getActionButtons($model);
        })
        ->editColumn('datetime', function($query) {
            return date("d-m-Y H:i:s", strtotime($query->datetime));
        })
        ->editColumn('price', function($query) {
            return getPriceText($query->price);
        })
        ->editColumn('status', function($query) {
            switch ($query->status) {
                case 0:
                    return '<span class="text-success">Pending</span>';
                    break;
                case 1:
                    return '<span class="text-primary">Paid</span>';
                    break;
                case 2:
                    return '<span class="text-danger">Rejected</span>';
                    break;
                
                default:
                    # code...
                    break;
            }
        })
        ->editColumn('image', function($query) {
            $url = asset('storage/' . $query->image);
            return $query->image ? '<a href="' . $url .'" target="_blank">View</a>' : '-'; 
        })
        ->addIndexColumn()
        ->escapeColumns([])
	    ->make(true);
    }

    private function getActionButtons($value)
    {
    	$edit = route('admin.transaction.edit', $value->id);
        
    	return view('include.datatables.action_buttons', compact('edit'))->render();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transaction()
    {
        return view('admin.report.transaction.index');
    }

    public function exportTransaction()
    {
        $total = [
            'summaryPrice' => 0
        ];

        $data = Transaction::with('user:id,name', 'details', 'details.venue:id,name', 'details.promo', 'details.packet:id,name,price')
                ->whereBetween('created_at', [request('start_date'), request('end_date')])
                ->get();
        foreach($data as $value)
        {
            foreach($value->details as $detail)
            {
                $total['summaryPrice'] += $detail->price;
            }
        }
        $total['unique_price_code'] = $data->sum('unique_price_code');
        $total['all'] = $total['summaryPrice'] + $total['unique_price_code'];

        $request = request()->all();

        $data = $data->toArray();

        $pdf = PDF::loadView('admin.report.transaction.pdf', compact('data', 'request', 'total'));
        $pdf->setPaper('A4', 'landscape');

        // return view ('admin.report.transaction.pdf', compact('data', 'request'));
        // return $pdf->download;
        return $pdf->stream('Laporan Transaksi_' . request('start_date') . '_' . request('end_date') . '.pdf');
    }
}

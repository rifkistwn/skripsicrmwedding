<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            table{
                font-size: 11px;
                margin-bottom: 1px;
                margin-left: -180px;
                margin-right: -80px;
            }
            .table{
                width: 160%;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @php
                Carbon\Carbon::setLocale('id');
                $no = 1;
            @endphp
            <div>
                <div>
                    <div class="row">
                        <div class="col-12 mt-2 text-center">
                            <label for="">Laporan Transaksi </label>
                        </div>
                        <div class="col-12">
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <td>Dari</td>
                                    <td>: {{ Carbon\Carbon::parse($request['start_date'])->translatedFormat('l, d F Y h:i')}}</td>
                                </tr>
                                <tr>
                                    <td>Sampai</td>
                                    <td>: {{ Carbon\Carbon::parse($request['end_date'])->translatedFormat('l, d F Y h:i')}}</td>
                                </tr>
                            </table>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th>No.</th>
                                    <th>Client</th>
                                    <th>Packet</th>
                                    <th>Venue</th>
                                    <th>Tgl. Acara</th>
                                    <th>Status</th>
                                    <th>Tgl. Pemesanan</th>
                                    <th>Harga</th>
                                    <th>Disc. Harga (%)</th>
                                    <th>Potongan Harga</th>
                                    <th>Harga Pemesanan</th>
                                    <th>Unique Price Code</th>
                                </tr>
                                @foreach($data as $key => $value)
                                    <tr>
                                        {{-- <td rowspan="{{ count($value['details']) + 1}}">{{$no++ }}</td>
                                        <td rowspan="{{ count($value['details']) + 1}}">{{$value['user']['name']}}</td>
                                        <td rowspan="{{ count($value['details']) + 1}}">{{getPriceText($value['unique_price_code'])}}</td>
                                        <td colspan="9"></td>
                                    </tr> --}}
                                    @foreach($value['details'] as $index => $detail)
                                        <tr>
                                            <td >{{$no++ }}</td>
                                            <td >{{$value['user']['name']}}</td>
                                            <td>
                                                {{$detail['packet']['name']}}
                                            </td>
                                            <td>
                                                {{$detail['venue']['name'] ?? '-'}}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($detail['datetime'])->translatedFormat('l, d F Y')}}
                                            </td>
                                            <td>
                                                @if($value['status'] == 0)
                                                Menunggu Pembayaran
                                                @elseif($value['status'] == 1)
                                                Bayar
                                                @else
                                                Ditolak
                                                @endif
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($value['created_at'])->translatedFormat('l, d F Y')}}
                                            </td>
                                            <td>
                                                {{getPriceText($detail['packet']['price'])}}
                                            </td>
                                            <td>
                                                {{$detail['promo']['discount'] ?? '-'}}
                                            </td>
                                            <td>
                                                @if($detail['promo'])
                                                {{getPriceText($detail['packet']['price'] - $detail['price'])}}
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>
                                                {{getPriceText($detail['price'])}}
                                            </td>
                                            @if(count($value['details']) > 1 )
                                                @if($index == 0)
                                                    <td class="border-bottom-0">{{getPriceText($value['unique_price_code'])}}</td>
                                                @else
                                                    <td class="border-top-0"></td>
                                                @endif
                                            @else
                                                <td>{{getPriceText($value['unique_price_code'])}}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th width="80%">Total</th>
                                    <th>{{getPriceText($total['all'])}}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
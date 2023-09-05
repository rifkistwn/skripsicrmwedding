@extends('include.app')
@section('title', 'Promo')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('custom/datetimepicker/jquery.datetimepicker.css')}}">
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Transaksi</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                    @csrf
                    @method($method)
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">User</label>
                            <input class="form-control" type="text" value="{{ $data->user->name }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Status </label>
                            <select name="status" id="status-transaction" class="form-control" onchange="checkStatus()">
                                <option value="0"  @selected($data->status == 0)>PENDING</option>
                                <option value="1"  @selected($data->status == 1)>PAID</option>
                                <option value="2"  @selected($data->status == 2)>REJECTED</option>
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Image </label>
                            <p>
                                @if($data->image)
                                    <a href="{{asset('storage/' . $data->image)}}" target="_blank">View</a>
                                @else
                                    <label for="" class="text-danger">Image Not Found</label>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row" id="title">
                        @foreach ($data->details as $key => $detail)
                            <div class="mb-3 col-12">
                                <input type="hidden" value="{{ $detail->id }}" name="transaction_detail_id[]">
                                <label for="id" class="form-label">Title Event {{ ' ' . $detail->packet->name }}</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" id="title-input" name="title[]" value="{{ $detail->event->title ?? "" }}">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-sm btn-sm">{{ !$data->exists ? 'Simpan' : 'Update' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Transaksi</h4>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="mb-3 col-12">
                        <table class="table table-sm table-striped">
                            <tr>
                                <th>No.</th>
                                <th>Paket</th>
                                <th>Tempat Acara</th>
                                <th>Promo</th>
                                <th>Tanggal & Waktu</th>
                                <th>Harga</th>
                            </tr>
                            @foreach ($data->details as $key => $detail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $detail->packet->name }}</td>
                                    <td>{{ $detail->venue->name ?? "-" }}</td>
                                    <td>{{ $detail->promo->code ?? "-" }}</td>
                                    <td>{{ date('d-m-Y h:i:s', strtotime($detail->datetime)) }}</td>
                                    <td>{{ getPriceText($detail->price) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">Unique Price Code</td>
                                <td>{{ getPriceText($data->unique_price_code) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">Total</td>
                                <td>{{ getPriceText($total_price) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
@section('script')
<script src="{{asset('custom/datetimepicker/jquery.datetimepicker.js')}}"></script>

<script>
    $( document ).ready(function() {
        $('.datetimepicker').datetimepicker({
            autoclose : true
        });
        var status = $("#status-transaction").val()
        loadCheck(status)
        
    })

    function checkStatus()
    {
        var status = $("#status-transaction").val()
        loadCheck(status)
    }

    function loadCheck(status)
    {
        if(status == 1 ) {
            $('#title').show()
            $("#title-input").attr('required', true);
        } else {
            $('#title').hide()
            $("#title-input").attr('required', false);
        }
    }
</script>
@endsection
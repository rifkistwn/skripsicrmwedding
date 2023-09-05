@extends('include.app')
@section('title', ' - Dashboard')
@section('css')
    <link href="{{asset('custom/datepicker/bootstrap-datepicker.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <style>
        .btn-export {
            margin-top: 28px
        }
    </style>

@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="card-title">Laporan Transaksi</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.report.transaction.export') }}" enctype="multipart/form-data" method="POST" target="_blank"/>
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="id" class="form-label">Tanggal Awal</label>
                                <input class="form-control" type="date" name="start_date" required>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="id" class="form-label" >Tanggal Akhir</label>
                                <input class="form-control" type="date" name="end_date" required>
                            </div>
                            <div class="mb-3 col-3">
                                <button class="btn btn-primary btn-export" type="submit"><i class="fa fa-download"></i> Export</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>
@endsection
@section('script')
    <script src="{{asset('custom/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $('.datepicker').datepicker({
            autoclose : true
        });
    </script>
@endsection
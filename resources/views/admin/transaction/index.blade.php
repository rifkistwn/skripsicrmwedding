@extends('include.app')
@section('title', ' - Transaction')
@section('css')
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">List Transaksi</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="card-title">List Transaksi</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered dt-responsive nowrap w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        const url = "{{ route('admin.transaction.index') }}"

        var datatable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            aaSorting : [],
            ajax: url,
            scrollX : true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'user.name' },
                { data: 'status' },
                { data: 'image' },
                { data: 'action',orderable: false, searchable: false},
            ]
        })
    })
</script>
@endsection
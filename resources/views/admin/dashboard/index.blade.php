@extends('include.app')
@section('title', ' - Dashboard')
@section('css')
<style>
    .pic {
        color: pink;
        font-size: 50px
    }

    .icon-wrapper {
        padding: 15px;
        border-radius: 6px;
    }

    .icon-wrapper.pink {
        background: rgba(255, 192, 203, 0.203);
    }
    .icon-wrapper.green {
        background: rgba(95, 255, 78, 0.203);
    }
    .icon-wrapper.green i {
        color: #2ab57d;
    }
    .icon-wrapper.blue {
        background: rgba(81,86,190, 0.203);
    }
    .icon-wrapper.blue i {
        color: rgb(81,86,190);
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
                            <h4 class="card-title">Dashboard</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate"><a href="{{route('admin.user.index')}}">User</a></span>
                                            <h4 class="mb-3">
                                                <span class="text-primary counter-value" data-target="{{ $data['user'] }}"></span>
                                            </h4>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-end">
                                            <div class="icon-wrapper blue">
                                                <a href="{{route('admin.user.index')}}"><i class="fa fa-users text-right pic"></a></i>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate"><a href="{{route('admin.packet.index')}}">Paket Tersedia</a></span>
                                            <h4 class="mb-3">
                                                <span class="text-danger counter-value" data-target="{{ $data['packet'] }}"></span>
                                            </h4>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-end">
                                            <div class="icon-wrapper pink">
                                                <a href="{{route('admin.packet.index')}}"><i class="fab fa-stack-exchange text-right pic"></a></i>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <span class="text-muted text-grey mb-3 lh-1 d-block text-truncate"><a href="{{route('admin.transaction.index')}}">Semua Transaksi</a></span>
                                            <h4 class="mb-3">
                                                <span class="text-success counter-value" data-target="{{ $data['transaction'] }}"><a href="{{route('admin.transaction.index')}}"></a></span>
                                            </h4>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-end">
                                            <div class="icon-wrapper green">
                                                <a href="{{route('admin.transaction.index')}}"><i class="fa fa-exchange-alt text-right pic"></a></i>
                                            </div>
                                        </div>
                                    </div>
                
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Pending</span>
                                            <h4 class="mb-3">
                                                <span class="text-grey counter-value" data-target="{{ $data['pending'] }}"></span>
                                            </h4>
                                        </div>
                                    </div>
                                    
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Paid</span>
                                            <h4 class="mb-3">
                                                <span class="text-grey counter-value" data-target="{{ $data['paid'] }}"></span>
                                            </h4>
                                        </div>
                                    </div>
                                    
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Rejected</span>
                                            <h4 class="mb-3">
                                                <span class="text-grey counter-value" data-target="{{ $data['rejected'] }}"></span>
                                            </h4>
                                    </div>
                                    
                                </div><!-- end card body -->
                            </div><!-- end card -->
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
</script>
@endsection
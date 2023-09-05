
<div class="d-flex">
    <div class="dropdown d-none d-sm-inline-block">
        <button type="button" class="btn header-item" id="mode-setting-btn">
            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
        </button>
    </div>
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i data-feather="bell" class="icon-lg"></i>
            <span class="badge bg-danger rounded-pill">{{$transaction > 0 ? 1 : ''}}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0"> Notifikasi </h6>
                    </div>
                    <div class="col-auto">
                        {{-- <a href="#!" class="small text-reset text-decoration-underline"> Unread (3)</a> --}}
                    </div>
                </div>
            </div>
            <div data-simplebar style="max-height: 230px;">
                <a href="{{ route('admin.transaction.index') }}" class="text-reset notification-item">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-sm me-3">
                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                <i class="bx bx-cart"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{$transaction}} Transaksi terbaru hari ini</h6>
                            <div class="font-size-13 text-muted">
                                <p class="mb-1">Klik untuk melihat transaksi</p>
                                {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p> --}}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle header-profile-user" src="https://ui-avatars.com/api/?name={{auth()->user()->name}}&amp;background=00ADEF&amp;color=fff" alt="avatar" height="40" width="40" alt="Header Avatar">
            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{Auth::user()->name}}</span>
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            {{-- <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
            <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a> --}}
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</button>
            </form>
        </div>
    </div>
</div>
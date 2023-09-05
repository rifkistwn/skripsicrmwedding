<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('admin.dashboard.index')}}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="{{ (request()->segment(2) == 'promo') ? 'mm-active' : '' }}">
                    <a class="{{ (request()->segment(2) == 'promo') ? 'active' : '' }}" href="{{route('admin.promo.index')}}">
                        <i data-feather="percent"></i>
                        <span data-key="t-promo">Promo</span>
                    </a>
                </li>
                <li class="{{ (request()->segment(2) == 'event') ? 'mm-active' : '' }}">
                    <a class="{{ (request()->segment(2) == 'event') ? 'active' : '' }}" href="{{route('admin.event.index')}}">
                        <i data-feather="award"></i>
                        <span data-key="t-promo">Acara</span>
                    </a>
                </li>
                <li class="{{ (request()->segment(2) == 'gallery') ? 'mm-active' : '' }}">
                    <a class="{{ (request()->segment(2) == 'gallery') ? 'active' : '' }}" href="{{route('admin.gallery.index')}}">
                        <i data-feather="image"></i>
                        <span data-key="t-promo">Gallery</span>
                    </a>
                </li>
                <li class="{{ (request()->segment(2) == 'transaction') ? 'mm-active' : '' }}">
                    <a class="{{ (request()->segment(2) == 'transaction') ? 'active' : '' }}" href="{{route('admin.transaction.index')}}">
                        <i data-feather="dollar-sign"></i>
                        <span data-key="t-promo">Transaksi</span>
                    </a>
                </li>
                <li class="{{ (request()->segment(2) == 'user') ? 'mm-active' : '' }}">
                    <a class="{{ (request()->segment(2) == 'user') ? 'active' : '' }}" href="{{route('admin.user.index')}}">
                        <i data-feather="users"></i>
                        <span data-key="t-promo">User</span>
                    </a>
                </li>
                <li class="{{ (request()->segment(2) == 'question') ? 'mm-active' : '' }}">
                    <a class="{{ (request()->segment(2) == 'question') ? 'active' : '' }}" href="{{route('admin.question.index')}}">
                        <i data-feather="smile"></i>
                        <span data-key="t-promo">Pertanyaan</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="database"></i>
                        <span data-key="database">Laporan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ (request()->segment(2) == 'report') ? 'mm-active' : '' }}">
                            <a class="{{ (request()->segment(2) == 'report') ? 'active' : '' }}" href="{{route('admin.report.transaction')}}">
                                <span data-key="t-packet">Transaksi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title 
                {{ (request()->segment(2) == 'packet') || 
                (request()->segment(2) == 'venue') || 
                (request()->segment(2) == 'news') 
                ? 'mm-active' : '' }}" 
                data-key="t-menu" >Master</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ (request()->segment(2) == 'packet') ? 'mm-active' : '' }}">
                            <a class="{{ (request()->segment(2) == 'packet') ? 'active' : '' }}" href="{{route('admin.packet.index')}}">
                                <span data-key="t-packet">Paket</span>
                            </a>
                        </li>
                        <li class="{{ (request()->segment(2) == 'venue') ? 'mm-active' : '' }}">
                            <a class="{{ (request()->segment(2) == 'venue') ? 'active' : '' }}" href="{{route('admin.venue.index')}}">
                                <span data-key="t-venue">Tempat Acara</span>
                            </a>
                        </li>
                        <li class="{{ (request()->segment(2) == 'news') ? 'active' : '' }}">
                            <a class="{{ (request()->segment(2) == 'news') ? 'active' : '' }}" href="{{route('admin.news.index')}}">
                                <span data-key="t-news">Berita</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center p-3">

                    <h5 class="m-0 me-2">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0" />

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->
    </div>
</div>
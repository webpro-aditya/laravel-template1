@php
    $roleId = auth()->user()->roleId;
@endphp
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu mt-4 pt-3">
            <div class="nav">
                <a class="nav-link {{ Request::is('admin/dashboard') ? 'menu-active' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @if ($roleId == 1)
                    <a class="nav-link {{ Request::is('admin/customers') ? 'menu-active' : '' }}" href="">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Customer
                    </a>

                    <a class="nav-link collapsed {{ Request::is('admin/street-team') || Request::is('admin/street-team/add') ? 'menu-active' : '' }}"
                        href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                        Customers
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="">View</a>
                            <a class="nav-link" href="">Add</a>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>

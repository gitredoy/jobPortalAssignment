<div id="layoutSidenav">
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link {{request()->is('admin/home') ? 'active' : ''}}" href="{{route('admin.home')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link collapsed {{request()->is('admin/job*') ? 'active' : ''}}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Jobs
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{request()->is('admin/job-type-list') ? 'active' : ''}}" href="{{route('admin.job-type-list')}}">Job Type</a>
                        <a class="nav-link {{request()->is('admin/job-list') ? 'active' : ''}} " href="{{route('admin.job-list')}}">Job List</a>
                    </nav>
                </div>
                <a class="nav-link {{request()->is('admin/general-user') ? 'active' : ''}}" href="{{route('admin.user-list')}}" >
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    General User
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
           <span class="text-white"> {{ Auth::guard('admin')->user()->name }}</span>
        </div>
    </nav>
</div>
<div id="layoutSidenav_content">

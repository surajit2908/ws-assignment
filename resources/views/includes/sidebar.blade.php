<!-- ===================== Main Sidebar Section Start ===================== -->
<section class="main-sidebar full-menu" id="main-sidebar">

    <div class="main-sidebar-nav mCustomScrollbar">

        <ul>
            <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}"><a
                    href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            @if (Auth::user()->role_id == '0')
                <li class="{{ request()->is('admin/role*') ? 'active' : '' }}"><a href="{{ route('admin.role') }}"><i
                            class="fa fa-list"></i> <span>Role Management</span></a></li>
                <li class="{{ request()->is('admin/user*') ? 'active' : '' }}"><a href="{{ route('admin.user') }}"><i
                            class="fa fa-list"></i> <span>User Management</span></a></li>
            @endif
            <li class="{{ request()->is('admin/gallery*') ? 'active' : '' }}"><a
                    href="{{ route('admin.gallery') }}"><i class="fa fa-list"></i> <span>Gallery
                        Management</span></a></li>
        </ul>
    </div>





</section>



<!-- ===================== Main Sidebar Section End ===================== -->

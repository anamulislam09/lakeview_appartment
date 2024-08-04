@php
    use Illuminate\Support\Facades\DB;
    $privileges = DB::table('privileges')
        ->join('menus', function ($join) {
            $join->on('privileges.menu_id', '=', 'menus.id');
        })
        ->where('privileges.role_id', Auth::guard('admin')->user()->type)
        ->select('menus.menu_name')
        ->get()
        ->toArray();
    $privileges = array_column($privileges, 'menu_name');

@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-0 bg-dark">
    <a href="{{ url('admin/profile/update-admin-details') }}" class="brand-link bg-success">
        <span class="brand-text font-weight text-light">{{ Str::ucfirst(Auth::guard('admin')->user()->name) }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- Dashboard menu start here --}}
                @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Dashboard', $privileges))
                    <li class="nav-item {{ request()->is('admin/dashboard') ? 'menu-open' : '' }}">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif
                {{-- Dashboard menu ends here --}}
                {{-- Admin Manage menu start here --}}
                @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Admin', $privileges))
                    <li class="nav-item {{ request()->is('admin/admin*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/admin*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Admin
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Role Manage', $privileges))
                                <li class="nav-item">
                                    <a href="{{ url('admin/admin/roles') }}"
                                        class="nav-link {{ request()->is('admin/admin/roles*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Role Manage</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Admin Manage', $privileges))
                                <li class="nav-item">
                                    <a href="{{ url('admin/admin/admins') }}"
                                        class="nav-link {{ request()->is('admin/admin/admins*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admin Manage</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{-- Admin Manage menu ends here --}}
                {{-- Offices menu start here --}}
                @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Building Manage', $privileges))
                    <li
                        class="nav-item {{ Request::routeIs('building.index') || Request::routeIs('building.create') || Request::routeIs('building.edit') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/building/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Building Manage
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Building Manage, Add', $privileges))
                                <li class="nav-item">
                                    <a href="{{ route('building.create') }}"
                                        class="nav-link {{ request()->is('admin/building/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New </p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Building Manage, Building', $privileges))
                                <li class="nav-item">
                                    <a href="{{ route('building.index') }}"
                                        class="nav-link {{ request()->is('admin/building/all') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Buildings </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{-- Offices menu ends here --}}

                {{-- Brand menu start here --}}
                @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Appartment', $privileges))
                    <li
                        class="nav-item {{ Request::routeIs('appartment.index') || Request::routeIs('appartment.create') || Request::routeIs('appartment.edit') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/appartment/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Appartment Manage
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Appartment', $privileges))
                                <li class="nav-item">
                                    <a href="{{ route('appartment.index') }}"
                                        class="nav-link {{ Request::routeIs('appartment.index') || Request::routeIs('appartment.edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Appartment</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Appartment, Add', $privileges))
                                <li class="nav-item">
                                    <a href="{{ route('appartment.create') }}"
                                        class="nav-link {{ Request::routeIs('appartment.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                @endif
                {{-- Brand menu ends here --}}
                {{-- Category menu start here --}}
                @if (Auth::guard('admin')->user()->type == 'superadmin' || in_array('Members', $privileges))
                    <li
                        class="nav-item {{ Request::routeIs('member.index') || Request::routeIs('member.create') || Request::routeIs('member.edit') || Request::routeIs('member.show') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/member/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Member Manage
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::guard('admin')->user()->type == 'superadmin' ||
                                    in_array('Members', $privileges))
                                <li class="nav-item">
                                    <a href="{{ route('member.index') }}"
                                        class="nav-link {{ Request::routeIs('member.index') || Request::routeIs('member.edit') || Request::routeIs('member.show') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Member</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::guard('admin')->user()->type == 'superadmin' ||
                                    in_array('member', $privileges))
                                <li class="nav-item">
                                    <a href="{{ route('member.create') }}"
                                        class="nav-link {{ Request::routeIs('member.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{-- Category menu start here --}}
                {{-- @if (Auth::guard('admin')->user()->type == 'superadmin' ||
                        in_array('Family Member ', $privileges))
                    <li
                        class="nav-item {{ Request::routeIs('family-member.index') || Request::routeIs('family-member.create') || Request::routeIs('family-member.edit') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/family-member/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Family Member
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::guard('admin')->user()->type == 'superadmin' ||
                                    in_array('family-member', $privileges))
                                <li class="nav-item">
                                    <a href="{{ route('family-member.index') }}"
                                        class="nav-link {{ Request::routeIs('family-member.index') || Request::routeIs('family-member.edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Family Member</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::guard('admin')->user()->type == 'superadmin' ||
                                    in_array('family-member', $privileges))
                                <li class="nav-item">
                                    <a href="{{ route('family-member.create') }}"
                                        class="nav-link {{ Request::routeIs('family-member.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif --}}
                {{-- settings menu start here --}}
                @if (Auth::guard('admin')->user()->type == 'superadmin' ||
                        (Auth::guard('admin')->user()->office_id == '1' || in_array('Settings', $privileges)))
                    <li class="nav-item {{ request()->is('admin/profile/*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/profile/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::guard('admin')->user()->type == 'superadmin' ||
                                    (Auth::guard('admin')->user()->office_id == '1' || in_array('Update Password', $privileges)))
                                <li class="nav-item">
                                    <a href="{{ url('admin/profile/update-admin-password') }}"
                                        class="nav-link {{ request()->is('admin/profile/update-admin-password*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Update Password</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::guard('admin')->user()->type == 'superadmin' ||
                                    (Auth::guard('admin')->user()->office_id == '1' || in_array('Update Details', $privileges)))
                                <li class="nav-item">
                                    <a href="{{ url('admin/profile/update-admin-details') }}"
                                        class="nav-link {{ request()->is('admin/profile/update-admin-details*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Update Details</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{-- settings menu ends here --}}
            </ul>
        </nav>
    </div>
</aside>
<aside class="control-sidebar control-sidebar-dark"></aside>

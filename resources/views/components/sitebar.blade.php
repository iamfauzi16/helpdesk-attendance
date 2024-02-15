@php
    use App\Attendance;
    use App\Logo;
    $attendance = Attendance::first();

    $logos = Logo::get();
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        @foreach ($logos as $logo)
            <div class="bg-white rounded-lg">
                <img src="{{ url('/' . $logo->image) }}" style="max-width: 48px;" alt="Image">
            </div>
            
            <div class="sidebar-brand-text mx-3 text-left">{{ $logo->name }}</div>
        @endforeach

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    @auth
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAttendance"
                aria-expanded="true" aria-controls="collapseAttendance">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Attendance Menu</span>
            </a>
            <div id="collapseAttendance" class="collapse" aria-labelledby="headingAttendance" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    @if (Auth::user()->role->name_role == 'admin')
                        <a class="collapse-item {{ request()->is('administrator/shift-attendances') ? 'active' : '' }}"
                            href="{{ route('index.shift-attendance') }}"> <i
                                class="fas fa-fw fa-calendar mr-2"></i><span>Shift Attendance</span></a>
                                
                        <a class="collapse-item {{ request()->is('administrator/employee-schedules') ? 'active' : '' }}"
                            href="{{ route('index.employee-schedule') }}"> <i
                                class="fas fa-fw fa-calendar-day mr-2"></i><span>Employee Schedule</span></a>
                       
                        <a class="collapse-item {{ request()->is('administrator/attendances') ? 'active' : '' }}"
                            href="{{ route('administrator.index.attendance') }}"><i
                                class="fas fa-fw fa-inbox mr-2"></i><span>Attendance <span
                                    class="badge badge-primary">admin</span></span></a>
                    @else
                        <a class="collapse-item" href="{{ route('index.attendance') }}">Attendance</a>
                    @endif
                </div>
            </div>
        </li>
        @if (Auth::user()->role->name_role == 'admin')
            
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCutiApproval"
                aria-expanded="true" aria-controls="collapseCutiApproval">
                <i class="fas fa-fw fa-calendar-day"></i>
                <span>Cuti Approvel Menu</span>
            </a>
            <div id="collapseCutiApproval" class="collapse" aria-labelledby="headingCutiApproval" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item {{ request()->is('administrator/cuti-accepts') ? 'active' : '' }}"
                        href="{{ route('administrator.index.cuti-accept') }}"> <i
                            class="fas fa-fw fa-check mr-2"></i><span>Cuti Accept</span></a>
                </div>
            </div>
        </li>
              
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGeolocation"
                aria-expanded="true" aria-controls="collapseGeolocation">
                <i class="fas fa-fw fa-map"></i>
                <span>Geolocation</span>
            </a>
            <div id="collapseGeolocation" class="collapse" aria-labelledby="headingGeoLocation" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item {{ request()->is('administrator/locations') ? 'active' : '' }}"
                        href="{{ route('administrator.index.location') }}"> <i
                            class="fas fa-fw fa-check mr-2"></i><span>Set Location</span></a>
                </div>
            </div>
        </li>
        @else
           <!-- Nav Item - Charts -->
           <li class="nav-item {{ request()->is('cuti-forms') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('cuti-form.index') }}">
                <i class="fas fa-fw fa-calendar-times"></i>
                <span>Form Cuti</span>
            </a>
        </li>
        @endif
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider">
    @if (Auth()->user()->role->name_role == 'admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            User Management
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item {{ request()->is('administrator/roles') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('index.role') }}">
                <i class="fas fa-fw fa-flag"></i>
                <span>Role</span>
            </a>
        </li>



        <li class="nav-item {{ request()->is('administrator/user-managers') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('index.user-manager') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>User Account</span>
            </a>
        </li>
    @endif


    @if (Auth()->user()->role->name_role == 'admin')
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Dashboard Setting
        </div>

        <li class="nav-item {{ request()->is('administrator/logos') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('administrator.index.logo') }}">
                <i class="fas fa-fw fa-image"></i>
                <span>Logo</span>
            </a>
        </li>
    @endif


    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

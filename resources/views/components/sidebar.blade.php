<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/absensi">
        <div class="sidebar-brand-icon rotate-n-15 d-none d-sm-inline">
            AK
        </div>
        <div class="sidebar-brand-text mx-3">Absesnsi Karyawan</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (auth()->user()->hasRole('karyawan'))
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ $title == 'Absensi' ? 'active' : '' }}">
            <a class="nav-link" href="/absensi">
                <i class="fas fa-tasks"></i>
                <span>Absensi</span></a>
        </li>
    @elseif (auth()->user()->hasRole('admin'))
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ $title == 'Absensi' ? 'active' : '' }}">
            <a class="nav-link" href="/absensi">
                <i class="fas fa-tasks"></i>
                <span>Absensi</span></a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ $title == 'Data Absensi' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data_absensi') }}">
                <i class="fas fa-tasks"></i>
                <span>Data Absensi</span></a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li
            class="nav-item {{ $title == 'Data Karyawan' || $title == 'Edit Karyawan' || $title == 'Tambah Karyawan' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data_karyawan') }}">
                <i class="fas fa-users"></i>
                <span>Data Karyawan</span></a>
        </li>

        <li
            class="nav-item {{ $title == 'Data Admin' || $title == 'Edit Admin' || $title == 'Tambah Admin' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data_admin') }}">
                <i class="fas fa-users"></i>
                <span>Data Admin</span></a>
        </li>
    @endif

</ul>
<!-- End of Sidebar -->

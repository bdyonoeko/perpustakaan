<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text mx-3">Perpustakaan<sup>XYZ</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard*') ? 'active font-weight-bold' : '' }}">
        <a class="nav-link active" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Buku -->
    <li class="nav-item {{ Request::is('book*') ? 'active font-weight-bold' : '' }}">
        <a class="nav-link active" href="{{ route('book.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Buku</span></a>
    </li>

    <!-- Nav Item - Kategori -->
    <li class="nav-item {{ Request::is('category*') ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ route('category.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Kategori</span></a>
    </li>

    <!-- Nav Item - Mahasiswa -->
    <li class="nav-item {{ Request::is('user*') ? 'active font-weight-bold' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mahasiswa" aria-expanded="true"
            aria-controls="mahasiswa">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Mahasiswa</span>
        </a>
        <div id="mahasiswa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Mahasiswa:</h6>
                <a class="collapse-item" href="{{ route('user.index', $isConfirmation='0') }}">Butuh Konfirmasi</a>
                <a class="collapse-item" href="{{ route('user.index', $isConfirmation='1') }}">Daftar Mahasiswa</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Peminjaman -->
    <li class="nav-item {{ Request::is('borrow*') ? 'active font-weight-bold' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#peminjaman" aria-expanded="true"
            aria-controls="peminjaman">
            <i class="fas fa-fw fa-handshake"></i>
            <span>Peminjaman</span>
        </a>
        <div id="peminjaman" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Peminjaman:</h6>
                <a class="collapse-item" href="{{ route('borrow.confirm') }}">Konfirmasi Pinjaman</a>
                <a class="collapse-item" href="{{ route('borrow.index', $isFinish='0') }}">Dalam Pinjaman</a>
                <a class="collapse-item" href="{{ route('borrow.index', $isFinish='1') }}">Riwayat Pinjaman</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

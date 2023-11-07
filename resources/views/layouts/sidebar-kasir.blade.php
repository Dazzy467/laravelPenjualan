@section('sidebar')
    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar position-fixed z-1 container bg-primary overflow-y-auto">
        <div id="sidebarToggleDiv" class="d-flex justify-content-end pt-2">
            <button id="toggleSidebar" class="btn btn-primary toggle-button">
                <i class="fa-solid fa-bars text-white" style="font-size: 24px;"></i>
            </button>
        </div>

        <div class=" pt-2" id="sidebarCollapse">
            <!-- Title/logo -->
            <!-- <a role="button" class="d-flex justify-content-end" data-target="#sidebar" data-toggle="collapse" aria-controls="sidebar" aria-expanded="true" ><i class="fa-solid fa-bars text-white" style="font-size: 24px;"></i></a> -->
            <div>
                <div class="text-center text-white nav-label"><h1>Kasir</h1></div>
            </div>
            <!-- Nav link -->
            <ul id="navlink" class="container mt-5">
                <li class="row">
                    <a href="{{route('kasir.show')}}" class="btn btn-primary d-flex align-items-center" style="text-decoration: none;">
                        <span class="text-white col nav-label" style="text-align: start;font-weight: bolder; font-size:14px;">Dashboard</span>
                        <i class="fa-solid fa-table-columns text-white col-2 nav-icon" style="font-size: 32px;"></i>
                    </a>
                </li>
                <li class="row">
                    <a href="{{ route('kasir.cekRiwayatTrans')}}" class="btn btn-primary d-flex align-items-center mt-3" style="text-decoration: none;">
                        <span class="text-white col nav-label" style="text-align: start;font-weight: bolder; font-size:14px;">Riwayat Transaksi</span>
                        <i class="fa-regular fa-clipboard text-white col-2 nav-icon" style="font-size: 32px; padding-left: 2px;"></i>
                    </a>
                </li>
                <li class="row">
                    <a href="{{ route('kasir.cekStok') }}" class="btn btn-primary d-flex align-items-center mt-3" style="text-decoration: none;">
                        <span class="text-white col nav-label" style="text-align: start; font-weight: bolder; font-size:14px;">Cek Stok Barang</span>
                        <i class="fa-solid fa-box text-white col-2 nav-icon" style="font-size: 32px; padding-left: 4px;"></i>
                    </a>
                </li>
                <li class="row">
                    <a href="{{ route('logout') }}" class="btn btn-primary d-flex align-items-center mt-3" style="text-decoration: none;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="text-white col nav-label" style="text-align: start; font-weight: bolder; font-size:14px;">Logout</span>
                        <i class="fa-solid fa-power-off text-white col-2 nav-icon" style="font-size: 32px; padding-left: 4px;"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
@endsection
    
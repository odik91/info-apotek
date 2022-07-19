<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('apotek.index')}}" class="brand-link">
    <img src="{{asset('template/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SIM Apotek V1.0</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('template/dist/img/apotek.png')}}" class="img-circle elevation-2"
          alt="{{ucwords(auth()->user()['nama_apotek'])}}">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ucwords(auth()->user()['nama_apotek'])}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{route('apotek.index')}}" class="nav-link {{ ($title == 'Beranda') ? " active" : "" }}">
            <i class="fas fa-user-md nav-icon"></i>
            <p>Profile</p>
          </a>
        </li>
        <li class="nav-header">Kelola Obat</li>
        <li class="nav-item">
          <a href="{{route('manage-medichine.index')}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              List Semua Obat
            </p>
          </a>
        </li>
        <li class="nav-header">Kelola Alkes</li>
        <li class="nav-item">
          <a href="{{(route('medical-device.index'))}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              List Semua Alkes
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('medical-device.create') }}" class="nav-link">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>
              Tambah Alkes
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
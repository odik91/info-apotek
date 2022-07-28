<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white bg-teal">
  <div class="container">
    <a href="{{'search.index'}}" class="navbar-brand">
      <img src="{{asset('template/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">INFO Apotek</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="{{route('search.index')}}"
            class="nav-link {{ isset($title) && $title == 'Apotek' ? 'active' : ''}}">Apotek</a>
        </li>
        <li class="nav-item">
          <a href="{{route('search.obat')}}"
            class="nav-link {{ isset($title) && $title == 'Obat' ? 'active' : ''}}">Obat</a>
        </li>
        <li class="nav-item">
          <a href="{{route('search.alkes')}}"
            class="nav-link {{ isset($title) && $title == 'Alkes' ? 'active' : ''}}">Alat Kesehatan</a>
        </li>
      </ul>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="{{route('login')}}">
          Kelola Apotek <i class="fas fa-mortar-pestle"></i>
        </a>
      </li>
    </ul>
  </div>
</nav>
<!-- /.navbar -->
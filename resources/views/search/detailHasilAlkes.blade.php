@extends('search.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  {{-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Project Detail</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Project Detail</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section> --}}

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card mt-3">
      <div class="card-header">
        <h3 class="card-title">Detail Alkes {{ ucwords($medicalDevice->namaAlkes['nama']) }}</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            <div class="row">
              <div class="col-12">
                <h4>Detail Informasi Alkes</h4>
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{asset('template/dist/img/mei.png')}}"
                      alt="medicines image">
                    <span class="username">
                      <dd href="#">{{ ucwords($medicalDevice->namaAlkes['nama']) }}</dd>
                    </span>
                    <span class="description">
                      {{
                      ucwords($medicalDevice->namaAlkes->infoKelompokAlkes['nama_kelompok_alat_kesehatan']) }}
                    </span>
                  </div>
                  <span class="username">
                    <b class="d-block">Nama Komersial Alat Kesehatan</b>
                  </span>
                  <p>
                    {{ ucwords($medicalDevice->namaAlkes['nama']) }}
                  </p>
                  <span class="username">
                    <b class="d-block">Kelompok Alkes</b>
                  </span>
                  <p>
                    {{ ucwords($medicalDevice->namaAlkes->infoKelompokAlkes['nama_kelompok_alat_kesehatan']) }}
                  </p>
                  <span class="username">
                    <b class="d-block">Kategori Alkes</b>
                  </span>
                  <p>
                    {{ ucwords($medicalDevice->namaAlkes->infoKategoriAlkes['nama_kategori_alkes']) }}
                  </p>
                  <span class="username">
                    <b class="d-block">Kelas Alkes</b>
                  </span>
                  <p>
                    {{ ucwords($medicalDevice->namaAlkes->infoKelasAlkes['nama_kelas_alkes']) }}
                  </p>
                  <span class="username">
                    <b class="d-block">Kelas Resiko Alkes</b>
                  </span>
                  <p>
                    {{ ucwords($medicalDevice->namaAlkes->infoKelasResiko['nama_kelas_resiko_alkes']) }}
                  </p>
                  <span class="username">
                    <b class="d-block">Sifat Alkes</b>
                  </span>
                  <p>
                    {{ ucwords($medicalDevice->namaAlkes->infoSifatAlkes['nama_sifat_alkes']) }}

                  </p>
                  <span class="username">
                    <b class="d-block">Stok</b>
                  </span>
                  <p>
                    {{ ucwords($medicalDevice['status']) }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
            <h3 class="text-primary"><i class="fas fa-mortar-pestle"></i> {{
              ucwords($apotek['nama_apotek']) }}</h3>
            <div class="text-muted">
              <p class="text-sm">Email
                <b class="d-block">{{ $apotek['email'] }}</b>
              </p>
              <p class="text-sm">Nomor Telepon
                <b class="d-block">{{ (isset($apotek['no_telepon'])) ?
                  $apotek['no_telepon'] : "-" }}</b>
              </p>
              <p class="text-sm">Nomor Izin
                <b class="d-block">{{ $apotek['no_izin'] }}</b>
              </p>
              <p class="text-sm">Penanggung Jawab
                <b class="d-block">{{ ucwords($apotek['penanggung_jawab']) }}</b>
              </p>
              <p class="text-sm">Alamat
                <b class="d-block">{{ ucwords($apotek['alamat'] . " " .
                  $apotek->userDistrict->nama_kecamatan . " " .
                  $apotek->userCity->nama_kabupaten_kota . " " .
                  $apotek->userProvince->nama_provinsi) }}</b>
              </p>
            </div>
            <div class="text-center mt-5 mb-3">
              @php
              $query = str_replace(" ", "+", $apotek["nama_apotek"]);
              $pinpoint = str_replace(" ", "", $apotek['longlat']);
              @endphp

              @if ($apotek['longlat'])
              {!! "<a class='btn btn-sm btn-primary'
                href='https://www.google.com/maps/search/" . $query . "/@" . $pinpoint . ",18z/data=!3m1!4b1'" . ' class="
                btn btn-block btn-info"' . 'target="_blank">Lihat di Google Map</a>' !!} @else {!!'<button
                class="btn btn-sm btn-primary" id="pinpointWarning">Lihat di Google Map</button>'!!}
                @endif
                <a href="{{ route('search.showApotek', $apotek['id']) }}" class="btn btn-sm btn-warning">Detail
                  Apotek</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('addon-script')
{{-- sweetalert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('#pinpointWarning').on('click', (e) => {
    Swal.fire({
        icon: 'error',
        title: 'Maaf!',
        text: 'Pinpoint untuk apotek ini belum tersedia!',
        timer: 2000,
        timerProgressBar: true,
      })
  })
</script>
@endpush
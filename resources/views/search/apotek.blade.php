@extends('search.layouts.master')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{asset('template/dist/img/apotek.png')}}"
                alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ ucwords($apotek['nama_apotek']) }}</h3>

            <p class="text-muted text-center">Apotek</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{$apotek->email}}</a>
              </li>
              <li class="list-group-item">
                <b>Nomor Izin</b> <a class="float-right">
                  @if (isset($apotek['no_izin']))
                  {{ $apotek['no_izin'] }}
                  @else
                  {{ '-' }}
                  @endif
                </a>
              </li>
              <li class="list-group-item">
                <b>P.Jawab</b> <a class="float-right">
                  @if (isset($apotek['penanggung_jawab']))
                  {{ucwords($apotek['penanggung_jawab'])}}
                  @else
                  {{'-'}}
                  @endif
                </a>
              </li>
              <li class="list-group-item">
                <b>Nomor Telepon</b> <a class="float-right">
                  @if (isset($apotek['no_telepon']))
                  {{ $apotek['no_telepon'] }}
                  @else
                  {{'-'}}
                  @endif
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tentang Apotek</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

            <p class="text-muted">
              @if (isset($apotek['alamat']))
              {{ ucwords($apotek['alamat']) }}, {{ ucwords($apotek->userDistrict->nama_kecamatan) }},
              {{" " . ucwords($apotek->userCity->nama_kabupaten_kota)}},
              {{" " . ucwords($apotek->userProvince->nama_provinsi)}}
              @else
              {{ 'Mohon lengkapi alamat anda' }}
              @endif
            </p>

            <hr>
            <strong><i class="fas fa-map"></i> Lokasi G-Map</strong>

            <p class="text-muted">
              @if (isset($apotek['longlat']))
              {{ $apotek['longlat'] }}
              @else
              {{ 'Mohon maaf pinpoint belum tersedia' }}
              @endif
            </p>
            @php
            $query = str_replace(" ", "+", $apotek["nama_apotek"]);
            $pinpoint = str_replace(" ", "", $apotek['longlat']);
            @endphp
            {{-- <a href="https://www.google.com/maps/place/{{'@' . $pinpoint}},18z/data=!3m1!4b1"
              class="btn btn-block btn-info" target="_blank">Lihat di Google Map</a> --}}
            {{-- <a href="https://www.google.com/maps/search/{{$query}}/{{ '@' . $pinpoint }} ,18z/data=!3m1!4b1"
              class="btn btn-block btn-info" target="_blank">Lihat di Google Map</a> --}}
            @if ($apotek['longlat'])
            {!! "<a href='https://www.google.com/maps/place/$pinpoint'" . 
              ' class=" btn btn-block btn-info"' . 'target="_blank">Lihat di Google Map</a>' !!} @else {!!'<button
              class="btn btn-block btn-info" id="pinpointWarning">Lihat di Google Map</button>'!!}
              @endif

              <hr>

              <strong><i class="fas fa-pills"></i> Jumlah Jenis Obat Tersedia</strong>
              <p class="text-muted">
                <span class="tag tag-danger">{{ count($qtyMedichineStock) }}</span>
              </p>

              <hr>

              <strong><i class="fas fa-microscope"></i> Jumlah Jenis Alkes Tersedia</strong>

              <p class="text-muted">
                <span class="tag tag-danger">{{ count($medicalEquipmentStocks) }}</span>
              </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#obat" data-toggle="tab">List Obat
                  Tersedia</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">List Alkes Tersedia</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="obat">
                @if (count($medichine_stocks) > 0)
                <!-- datatable -->
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Obat</th>
                      <th>Kelas Obat</th>
                      <th>Subkelas Obat</th>
                      <th>Sediaan</th>
                      <th>Kekuatan</th>
                      <th>Satuan</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($medichine_stocks as $key => $medichine_stock)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ ucwords($medichine_stock->getMedichineName['nama_obat']) }}</td>
                      <td>{{ ucwords($medichine_stock->getMedichineName->getKelas['kelas_obat']) }}</td>
                      <td>{{ isset($medichine_stock->getMedichineName->getSubkelas->subkelas_obat) ?
                        ucwords($medichine_stock->getMedichineName->getSubkelas['subkelas_obat']) : "" }}</td>
                      <td>{{ ucwords($medichine_stock->getMedichineName->getSediaanObat['sediaan_obat']) }}
                      </td>
                      <td>{{ ucwords($medichine_stock->getMedichineName['kekuatan']) }}
                      </td>
                      <td>{{ ucwords($medichine_stock->getMedichineName['kekuatan']) }}</td>
                      <td>{{ $medichine_stock['status'] }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Obat</th>
                      <th>Kelas Obat</th>
                      <th>Subkelas Obat</th>
                      <th>Sediaan</th>
                      <th>Kekuatan</th>
                      <th>Satuan</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                </table>
                <!-- /.datatable -->
                @else
                <h1 class="text-center">Belum Ada Stok Obat</h1>
                @endif
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                @if (count($medicalEquipmentStocks) > 0)
                <table id="tabelAlkes" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Akles</th>
                      <th>Kelompok Alkes</th>
                      <th>Kategori Akles</th>
                      <th>Kelas Alkes</th>
                      <th>Kelas Resiko Alkes</th>
                      <th>Sifat Alkes</th>
                      <th>Tersedia</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($medicalEquipmentsStockList as $key => $medicalEquipmentsStockListed)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td class="text-wrap">{{ucwords($medicalEquipmentsStockListed->namaAlkes->nama)}}</td>
                      <td class="text-wrap">

                        {{ucwords($medicalEquipmentsStockListed->namaAlkes->infoKelompokAlkes->nama_kelompok_alat_kesehatan)}}

                      </td>
                      <td class="text-wrap">
                        {{ucwords($medicalEquipmentsStockListed->namaAlkes->infoKategoriAlkes->nama_kategori_alkes)}}
                      </td>

                      <td class="text-wrap">
                        {{ucwords($medicalEquipmentsStockListed->namaAlkes->infoKelasAlkes->nama_kelas_alkes)}}</td>
                      <td class="text-wrap">
                        {{$medicalEquipmentsStockListed->namaAlkes->infoKelasResiko->nama_kelas_resiko_alkes}}
                      </td>
                      <td class="text-wrap">
                        {{$medicalEquipmentsStockListed->namaAlkes->infoSifatAlkes->nama_sifat_alkes}}
                      </td>
                      <td class="text-wrap">
                        @php
                        $status = App\Models\MedicalEquipmentStock::where('apotek_id',
                        $medicalEquipmentsStockListed->namaAlkes->id)->where('alkes_id',
                        $medicalEquipmentsStockListed['id'])->first();
                        @endphp
                        @if (isset($status['status']))
                        {{ ucwords($status['status']) }}
                        @else
                        Tidak
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Akles</th>
                      <th>Kelompok Alkes</th>
                      <th>Kategori Akles</th>
                      <th>Kelas Alkes</th>
                      <th>Kelas Resiko Alkes</th>
                      <th>Sifat Alkes</th>
                      <th>Tersedia</th>
                    </tr>
                  </tfoot>
                </table>
                @else
                <h1 class="text-center">Belum Ada Stok Alkes</h1>
                @endif
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection

@push('addon-css')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@push('addon-script')
<!-- DataTables -->
<script src="{{asset('template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
{{-- sweetalert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "searching": true,
      "ordering": true,
    })
    $("#tabelAlkes").DataTable({
      "responsive": true,
      "autoWidth": false,
      "searching": true,
      "ordering": true,
    })
  })

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
@extends('search.layouts.master')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="py-2"></div>
  <div class="card card-solid">
    <div class="card-body mb-2">
      <form method="GET" action="{{route('search.searchObat')}}">
        <h3 class="text-center font-weight-bold text-teal">CARI OBAT</h3>
        <div class="form-row">
          <div class="form-group col-md">
            <label for="nama_obat">Obat</label>
            <input type="text" class="form-control rounded-pill border-primary" id="apotek" name="nama_obat"
              placeholder="Cari Obat">
          </div>
          <div class="form-group col-md">
            <label for="provinsi_id">Provinsi</label>
            <select name="provinsi_id" id="provinsi_id" class="form-control rounded-pill border-info">
              <option selected disabled>Pilih Provinsi</option>
              @foreach (App\Models\Province::orderBy('id', 'asc')->get() as $province)
              <option value="{{$province['id']}}">{{ ucwords($province['nama_provinsi']) }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md">
            <label for="kabupaten_id">Kabupaten Kota</label>
            <select name="kabupaten_id" id="kabupaten_id" class="form-control rounded-pill border-info">
              <option selected disabled>Pilih Kabupaten Kota</option>
            </select>
          </div>
          <div class="form-group col-md">
            <label for="kecamatan_id">Kecamatan</label>
            <select name="kecamatan_id" id="kecamatan_id" class="form-control rounded-pill border-info">
              <option selected disabled>Pilih Kecamatan</option>
            </select>
          </div>
        </div>
        <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-sm-center">
          <button type="reset" class="btn btn-outline-secondary px-5 mx-2 rounded-pill">RESET</button>
          <button type="submit" class="btn btn-outline-primary px-5 mx-2 rounded-pill">CARI</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-header">
      <h5 class="text-center">{{ ucwords($title) }} : {{ $searchCounts }} Data Ditemukan</h5>
    </div>
    <div class="card-body pb-0">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Kekuatan</th>
            <th>Sediaan</th>
            <th>Apotek</th>
            <th>Aalamat</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $key => $item)
          @php
          $apotek = App\Models\User::where('id', $item->apotek_id)->first(['nama_apotek', 'alamat', 'kecamatan_id',
          'kabupaten_id', 'provinsi_id']);
          @endphp
          <tr>
            <td>{{ ++$key }}</td>
            <td class="text-wrap">{{ ucwords($item->nama_obat) }}</td>
            <td class="text-wrap">
              {{ ucwords($item->kekuatan) . " " . $item->satuan }}
            </td>
            <td class="text-wrap">
              {{ App\Models\MedichinePreparation::where('id', $item->sediaan_obat_id)->first()->sediaan_obat }}
            </td>
            <td class="text-wrap">
              {{ ucwords($apotek['nama_apotek']) }}
            </td>
            <td class="text-wrap">
              {{ ucwords($apotek['alamat'] . " " . $apotek->userDistrict->nama_kecamatan . " " .
              $apotek->userCity->nama_kabupaten_kota . " " . $apotek->userProvince->nama_provinsi) }}
            </td>
            <td class="text-wrap">{{ ucwords($item->status) }}</td>
            <td><a href="#" class="btn-info btn-block rounded-pill text-center">Lihat</a></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Kekuatan</th>
            <th>Sediaan</th>
            <th>Apotek</th>
            <th>Aalamat</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

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

  capitalizeTheFirstLetterOfEachWord = (words) => {
    let separateWord = words.toLowerCase().split(' ');
    for (let i = 0; i < separateWord.length; i++) {
        separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
        separateWord[i].substring(1);
    }
    return separateWord.join(' ');
  }

  $(document).ready(() => {
    let province = "select[name='provinsi_id']"
    let provinceValue = $(province).val();
    
    if (provinceValue != null) {
      $.ajax({
        url: 'api/city/' + provinceValue,
        type: "get",
        dataType: 'json',
        success: (data) => {
          $("select[name='kabupaten_id']").empty()
          $("select[name='kabupaten_id']").append(`<option selected disabled>Pilih Kabupaten Kota</option>`)

          $.each(data, (key, value) => {
            $("select[name='kabupaten_id']").append(`<option value="${key}">${capitalizeTheFirstLetterOfEachWord(value)}</option>`)
          })
        }
      })
    }

    $(province).on('change', (e) => {
      let provinceValue2 = $(province).val();
      if (provinceValue2 != null) {
        $.ajax({
          url: 'api/city/' + provinceValue2,
          type: "get",
          dataType: 'json',
          success: (data) => {
            $("select[name='kabupaten_id']").empty()
            $("select[name='kabupaten_id']").append(`<option selected disabled>Pilih Kabupaten Kota</option>`)

            $.each(data, (key, value) => {
              $("select[name='kabupaten_id']").append(`<option value="${key}">${capitalizeTheFirstLetterOfEachWord(value)}</option>`)
            })
          }
        })
      }
    })

    let city = "select[name='kabupaten_id']"
    if ($(city).val() != null) {
      $.ajax({
        url: 'api/districts/' + $(city).val(),
        type: "get",
        dataType: 'json',
        success: (data) => {
          $("select[name='kecamatan_id']").empty()
          $("select[name='kecamatan_id']").append(`<option selected disabled>Pilih Kecamatan</option>`)

          $.each(data, (key, value) => {
            $("select[name='kecamatan_id']").append(`<option value="${key}">${capitalizeTheFirstLetterOfEachWord(value)}</option>`)
          })
        }
      })
    }

    $(city).on('change', (e) => {
      let cityValue = $(city).val();
      if (cityValue != "") {
        $.ajax({
          url: 'api/districts/' + cityValue,
          type: "get",
          dataType: 'json',
          success: (data) => {
            $("select[name='kecamatan_id']").empty()
            $("select[name='kecamatan_id']").append(`<option selected disabled>Pilih Kecamatan</option>`)

            $.each(data, (key, value) => {
              $("select[name='kecamatan_id']").append(`<option value="${key}">${capitalizeTheFirstLetterOfEachWord(value)}</option>`)
            })
          }
        })
      }
    })
  })
</script>
@endpush
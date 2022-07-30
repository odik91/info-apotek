@extends('search.layouts.master')
@section('content')
<!-- Main content -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <div class="card mt-3">
          <div class="card-body">
            <form method="GET" action="{{route('search.searchApotek')}}">
              <h3 class="text-center text-info"><b>Cari Apotek</b></h3>
              <div class="form-group">
                <input type="text" class="form-control rounded-pill border-primary" id="apotek" name="apotek"
                  placeholder="Cari Apotek">
              </div>
              <hr>
              <h5 class="text-center">Opsi Lanjutan</h5>
              <div class="form-row">
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
                    {{-- @foreach (App\Models\City::orderBy('id', 'asc')->get() as $city)
                    <option value="{{$city['id']}}">{{ ucwords($city['nama_kabupaten_kota']) }}</option>
                    @endforeach --}}
                  </select>
                </div>
                <div class="form-group col-md">
                  <label for="kecamatan_id">Kecamatan</label>
                  <select name="kecamatan_id" id="kecamatan_id" class="form-control rounded-pill border-info">
                    <option selected disabled>Pilih Kecamatan</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-outline-secondary px-5 mx-2 rounded-pill">RESET</button>
                <button type="submit" class="btn btn-outline-primary px-5 mx-2 rounded-pill">CARI</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('addon-script')
<script>
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
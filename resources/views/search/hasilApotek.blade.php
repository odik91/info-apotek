@extends('search.layouts.master')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="py-2"></div>
  <div class="card card-solid">
    <div class="card-body mb-2">
      <form method="GET" action="{{route('search.searchApotek')}}">
        <h3 class="text-center font-weight-bold text-teal">CARI APOTEK</h3>
        <div class="form-row">
          <div class="form-group col-md">
            <label for="provinsi_id">Apotek</label>
            <input type="text" class="form-control rounded-pill border-primary" id="apotek" name="apotek"
              placeholder="Cari Apotek">
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
      <div class="row d-flex align-items-stretch">
        @foreach ($results as $result)
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
          <div class="card bg-light w-100">
            <div class="card-header text-muted border-bottom-0">
              Apotek
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-7">
                  <h2 class="lead"><b>{{ ucwords($result['nama_apotek']) }}</b></h2>
                  <p class="text-muted text-sm"><b>Nomor Izin: </b>
                    {{ ucwords($result['no_izin']) }}
                  </p>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small pb-2"><span class="fa-li"><i class="fas fa-user-nurse"></i></span> {{
                      ucwords($result['penanggung_jawab']) }}
                    </li>
                    <li class="small pb-2"><span class="fa-li"><i class="fas fa-envelope"></i></span> {{
                      $result['email'] }}
                    </li>
                    <li class="small pb-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> {{
                      ucwords($result['alamat']) . " " . ucwords($result->userDistrict->nama_kecamatan) . ", " .
                      ucwords($result->userCity->nama_kabupaten_kota) . ", " .
                      ucwords($result->userProvince->nama_provinsi) }}
                    </li>
                    <li class="small pb-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>{{
                      isset($result['no_telepon']) ? $result['no_telepon'] : "-"}}</li>
                  </ul>
                </div>
                <div class="col-5 text-center">
                  <img src="{{asset('template/dist/img/apotek.png')}}" alt="" class="img-circle img-fluid">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-right">
                @php
                $query = str_replace(" ", "+", $result["nama_apotek"]);
                $pinpoint = str_replace(" ", "", $result['longlat']);
                @endphp
                @if (isset($result['longlat']))
                {!! "<a href='https://www.google.com/maps/search/" . $query . "/@" . $pinpoint . ",18z/data=!3m1!4b1'" . 
                ' class=" btn btn-sm bg-teal"'
                  . 'target="_blank"><i class="fas fa-map-marked-alt"></i> Lihat di GMAP</a>' !!} @else {!!'<button
                  class="btn btn-sm bg-teal" id="pinpointWarning">Lihat di Google Map</button>'!!}
                  @endif

                  <a href="{{ route('search.showApotek', $result['id']) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-mortar-pestle"></i> Lihat Detail
                  </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <nav aria-label="Contacts Page Navigation">
        <ul class="pagination justify-content-center m-0">
          {{ $results->withQueryString()->links('vendor.pagination.custom') }}
        </ul>
      </nav>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection
@push('addon-script')
{{-- sweetalert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $('#pinpointWarning').on('click', (e) => {
    Swal.fire({
    icon: 'error',
    title: 'Maaf!',
    text: 'Pinpoint sementara belum tersedia di apotek ini',
    timer: 2000,
    timerProgressBar: true,
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
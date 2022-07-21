@extends('users.layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@if(isset($title)) {{ $title }} @else {{ 'Beranda' }} @endif</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Obat</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  {{-- alter --}}
  @if (Session::has('message'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{!! Session::get('message') !!}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mb-2">Ditemukan <b>{{count($medichines)}}</b> hasil pencarian yang cocok</h3>
              <div class="float-right">
                <form class="form-inline" method="GET" action="{{route('manage-medichine.search')}}">
                  @csrf
                  <label class="sr-only" for="cari_obat">Cari Obat</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <input type="text" class="form-control" id="cari_obat" name="cari_obat" placeholder="Cari Obat">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              @if (count($medichines) > 0)
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kelas Obat</th>
                    <th>Subkelas Obat</th>
                    <th>Sediaan</th>
                    <th>Kekuatan</th>
                    <th>Satuan</th>
                    <th>Tersedia</th>
                  </tr>
                </thead>
                <tbody id="status">
                  @foreach ($medichines as $key => $medichine)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td class="text-wrap">{{ucwords($medichine['nama_obat'])}}</td>
                    <td class="text-wrap">{{ucwords($medichine->getKelas['kelas_obat'])}}</td>
                    <td class="text-wrap">{{ucwords($medichine->getSubkelas['subkelas_obat'])}}</td>
                    <td class="text-wrap">{{ucwords($medichine->getSediaanObat['sediaan_obat'])}}</td>
                    <td class="text-wrap">{{$medichine['kekuatan']}}</td>
                    <td class="text-wrap">{{$medichine['satuan']}}</td>
                    <td class="text-wrap">
                      @php
                      $status = App\Models\MedichineStock::where('apotek_id', auth()->user()->id)->where('obat_id',
                      $medichine['id'])->first();
                      @endphp
                      <select name="status[]">
                        <option value="{{$medichine['id'] . '+' . auth()->user()->id}}+0" {{(isset($status['status']) &&
                          ($status['status']=='tidak' ) ) ? 'selected' : '' }}>Tidak</option>
                        <option value="{{$medichine['id'] . '+' . auth()->user()->id}}+1" {{(isset($status['status']) &&
                          ($status['status']=='ada' ) ) ? 'selected' : '' }}>Ada</option>
                      </select>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
              <h1 class="text-center">Obat Tidak Ditemukan</h1>
              @endif
              <div class="container">
                <div class="row justify-content-center">
                  {{ $medichines->links('vendor.pagination.custom') }}
                </div>
              </div>
              @if (count($medichines) > 0)
              <div class="container">
                <div class="row align-items-end justify-content-center">
                  <a href="{{route('apotek.index')}}" class="btn btn-secondary mx-2 mb-5 px-5" id="batal">Batal</a>
                  <form action="{{route('manage-medichine.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="sendArr" id="sendArr" value="">
                    <button type="submit" class="btn btn-primary mx-2 mb-5 px-5" id="simpan">Simpan</button>
                  </form>
                </div>
              </div>
              @endif
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('addon-script')
<!-- jQuery -->
<script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('template/dist/js/demo.js')}}"></script>
<script>
  $(document).ready(() => {
    let selectElement = $('select[name="status[]"]')
    let selectOption = $("#status > tr > td > select")
    let setHiddenValue = document.getElementById("sendArr")
    let dataArr = [];
    for (let i = 0; i < selectElement.length; i++) {
      dataArr.push(selectOption.eq(i).val())
      setHiddenValue.value = dataArr.toString()

      selectOption.eq(i).on('change', (e) => {
        if (dataArr.length > 0) {
          console.log(selectOption.eq(i).val());

          let checkValue = (el) => el == selectOption.eq(i).val() //for index search
          let cariIndex = dataArr.findIndex(checkValue)
          console.log("hasil cari " + cariIndex);
          if (cariIndex == -1) {
            let selectValue =  selectOption.eq(i).val().split("+")
            console.log(selectValue);
            for (let j = 0; j < dataArr.length; j++) {
              if (dataArr[j].indexOf(selectValue[0]) >= 0) {
                // console.log("data found pada dataArray ke" + j)
                dataArr[j] = selectOption.eq(i).val()
                // console.log("data telah diganti");
                break;
              }
            }
          }
        } 
        setHiddenValue.value = dataArr.toString()
      })
    }        
  })
</script>
@endpush
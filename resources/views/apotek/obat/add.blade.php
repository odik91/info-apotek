@extends('apotek.master')
@section('content')
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
              <h3 class="card-title">Tambah Data Obat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <div class="container my-2">
                <form role="form" method="POST" action="{{route('obat.store')}}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="namaObat">Nama Obat</label>
                      <input type="text" name="nama_obat" class="form-control" id="nama_obat" placeholder="Nama Obat">
                    </div>
                    <div class="form-group">
                      <label for="kelas_obat_id">Kelas Obat</label>
                      <select class="form-control" name="kelas_obat_id" id="kelas_obat_id">
                        <option selected disabled>Pilih Kelas Obat</option>
                        @foreach (App\Models\MedichineClass::orderBy('id', 'asc')->get() as $MedichineClass)
                        <option value="{{$MedichineClass['id']}}">{{ $MedichineClass['kelas_obat'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="subkelas_obat_id">Subkelas Obat</label>
                      <select class="form-control" name="subkelas_obat_id" id="subkelas_obat_id">
                        <option selected disabled>Pilih Subkelas Obat</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="sediaan_obat_id">Sediaan Obat</label>
                      <select class="form-control" name="sediaan_obat_id" id="sediaan_obat_id">
                        <option selected disabled>Pilih Sediaan Obat</option>
                        @foreach (App\Models\MedichinePreparation::orderBy('id', 'asc')->get() as $MedichinePreparation)
                        <option value="{{$MedichinePreparation['id']}}">{{ $MedichinePreparation['sediaan_obat'] }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kekuatan">Kekuatan Obat</label>
                      <input type="text" name="kekuatan" id="kekuatan" class="form-control" placeholder="Kekuatan Obat">
                    </div>
                    <div class="form-group">
                      <label for="satuan">Satuan Obat</label>
                      <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan Obat">
                    </div>
                    <div class="form-group">
                      <label for="retriksi">Retriksi</label>
                      <textarea class="form-control" id="retriksi" name="retriksi" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="retriksi_obat">Retriksi Obat</label>
                      <textarea class="form-control" id="retriksi_obat" name="retriksi_obat" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="retriksi_sediaan">Retriksi Sediaan Obat</label>
                      <textarea class="form-control" id="retriksi_sediaan" name="retriksi_sediaan" rows="2"></textarea>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                  </div>
                </form>
              </div>
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
<script type="text/javascript">
  $(document).ready(() => {
    let elem = "select[name='kelas_obat_id']"
    $(elem).on('change', (e) => {
      let kelasObatId = $(elem).val()
      if (kelasObatId) {
        $.ajax({
          url: '/admin/tambah-obat/' + kelasObatId,
          type: 'GET',
          dataType: 'json',
          success: (data) => {
            // console.log(data);
            $("select[name='subkelas_obat_id']").empty()
            $("select[name='subkelas_obat_id']").append(`<option selected disabled>Pilih Subkelas Obat</option>`)
            $.each(data, (key, value) => {
              $("select[name='subkelas_obat_id']").append(`<option value="${key}">${value}</option>`)
            })
          }
        })
      }
    })
  })
</script>
@endpush
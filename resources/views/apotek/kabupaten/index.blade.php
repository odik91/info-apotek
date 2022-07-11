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
            <li class="breadcrumb-item active">Kabupaten</li>
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
              <h3 class="card-title">Data Kabupaten Kota</h3>

              <div class="card-tools">
                <button class="btn btn-info" data-toggle="modal" data-target="#addProvince">Tambah Kabupaten
                  Kota</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cities as $key=>$city)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ ucwords($city['nama_kabupaten_kota']) }}</td>
                    <td>{{ ucwords($city->province['nama_provinsi']) }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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

<!-- Modal -->
<div class="modal fade" id="addProvince" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="addProvinceLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProvinceLabel">Tambah Provinsi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('kabupaten.store')}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="input-group mb-3">
            <input type="text" id="nama_kabupaten_kota" name="nama_kabupaten_kota"
              class="form-control @error('nama_kabupaten_kota') is-invalid @enderror" placeholder="Nama kabupaten kota"
              value="{{ old('nama_kabupaten_kota') }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <select class="form-control" name="provinsi_id" id="provinsi_id">
              <option selected disabled>Pilih Provinsi</option>
              @foreach (App\Models\Province::orderBy('nama_provinsi', 'asc')->get() as $province)
              <option value="{{$province['id']}}">{{ $province['nama_provinsi'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
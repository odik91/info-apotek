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
            <li class="breadcrumb-item active">@if(isset($title)) {{ $title }} @else {{ 'Beranda' }} @endif</li>
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
              <h3 class="card-title">Data Kelas Resiko Alkes
              </h3>

              <div class="card-tools">
                <button class="btn btn-info" data-toggle="modal" data-target="#addProvince">Tambah Kelas Resiko
                  Alkes</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kelas Resiko</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medicalDeviceRiskClasses as $key => $medicalDeviceRiskClass)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td class="text-wrap">{{ ucwords($medicalDeviceRiskClass['nama_kelas_resiko_alkes']) }}</td>
                    <td class="text-wrap">{{ $medicalDeviceRiskClass['keterangan'] }}</td>
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
        <h5 class="modal-title" id="addProvinceLabel">Tambah Kelas Resiko Alkes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('kelas-resiko.store')}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="input-group mb-3">
            <input type="text" id="nama_kelas_resiko_alkes" name="nama_kelas_resiko_alkes"
              class="form-control @error('nama_kelas_resiko_alkes') is-invalid @enderror"
              placeholder="Kelas Resiko Alkes" value="{{ old('nama_kelas_resiko_alkes') }}" required>
            @error('nama_kelas_resiko_alkes')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="text" id="keterangan" name="keterangan"
              class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan"
              value="{{ old('keterangan') }}">
            @error('keterangan')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
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
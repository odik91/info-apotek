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
            <li class="breadcrumb-item active">Subkelas Obat</li>
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
              <h3 class="card-title">Data Subkelas Obat</h3>

              <div class="card-tools">
                <button class="btn btn-info" data-toggle="modal" data-target="#addProvince">Tambah Subkelas
                  Obat</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kelas Obat</th>
                    <th>Subkelas Obat</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medichineSubclasses as $key => $medichineSubclass)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td class="text-wrap">{{ ucwords($medichineSubclass->classMedichine['kelas_obat']) }}</td>
                    <td class="text-wrap">{{ ucwords($medichineSubclass['subkelas_obat']) }}</td>
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
      <form action="{{route('subkelas-obat.store')}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="input-group mb-3">
            <input type="text" id="subkelas_obat" name="subkelas_obat"
              class="form-control @error('subkelas_obat') is-invalid @enderror" placeholder="Subkelas Obat"
              value="{{ old('subkelas_obat') }}" autocomplete="off" required>
            @error('subkelas_obat')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <select class="form-control" name="kelas_id" id="kelas_id">
              <option selected disabled>Pilih Subkelas Obat</option>
              @foreach (App\Models\MedichineClass::orderBy('id', 'asc')->get() as $MedichineClass)
              <option value="{{$MedichineClass['id']}}">{{ $MedichineClass['kelas_obat'] }}</option>
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
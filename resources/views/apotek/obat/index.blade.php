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
              <h3 class="card-title">Data Obat</h3>

              <div class="card-tools">
                <a href="{{route('obat.create')}}" class="btn btn-info">Tambah Data Obat</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
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
                    <th>Retriksi</th>
                    <th>Retriksi Obat</th>
                    <th>Retriksi Sediaan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medichines as $key => $medichine)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td class="text-wrap">{{ucwords($medichine['nama_obat'])}}</td>
                    <td class="text-wrap">{{ucwords($medichine->getKelas['kelas_obat'])}}</td>
                    <td class="text-wrap">{{isset($medichine->getSubkelas['subkelas_obat']) ?
                      ucwords($medichine->getSubkelas['subkelas_obat']) : ""}}</td>
                    <td class="text-wrap">{{ucwords($medichine->getSediaanObat['sediaan_obat'])}}</td>
                    <td class="text-wrap">{{$medichine['kekuatan']}}</td>
                    <td class="text-wrap">{{$medichine['satuan']}}</td>
                    <td class="text-wrap">{{$medichine['retriksi']}}</td>
                    <td class="text-wrap">{{$medichine['retriksi_obat']}}</td>
                    <td class="text-wrap">{{$medichine['retriksi_sediaan']}}</td>
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
@endsection
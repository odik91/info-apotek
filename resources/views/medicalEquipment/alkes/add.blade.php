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
              <h3 class="card-title">Tambah Data Alkes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <div class="container my-2">
                <form role="form" method="POST" action="{{route('alkes.store')}}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="nama">Nama Alkes</label>
                      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        placeholder="Nama Alkes">
                      @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="kelompok_alkes_id">Kelompok Alkes</label>
                      <select class="form-control" name="kelompok_alkes_id" id="kelompok_alkes_id">
                        <option selected disabled>Pilih Kelompok Alkes</option>
                        @foreach (App\Models\MedicalDeviceGroup::orderBy('nama_kelompok_alat_kesehatan', 'asc')->get()
                        as $item)
                        <option value="{{$item['id']}}">
                          {{ $item['nama_kelompok_alat_kesehatan'] }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kategori_alkes_id">Kategori Alkes</label>
                      <select class="form-control" name="kategori_alkes_id" id="kategori_alkes_id">
                        <option selected disabled>Pilih Kategori Alkes</option>
                        @foreach (App\Models\MedicalDeviceCategory::orderBy('nama_kategori_alkes',
                        'asc')->get()
                        as $item)
                        <option value="{{$item['id']}}">
                          {{ $item['nama_kategori_alkes'] }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kelas_alkes_id">Kelas Alkes</label>
                      <select class="form-control" name="kelas_alkes_id" id="kelas_alkes_id">
                        <option selected disabled>Pilih Kelas Alkes</option>
                        @foreach (App\Models\MedicalDeviceClass::orderBy('id', 'asc')->get() as $medicalDeviceClass)
                        <option value="{{$medicalDeviceClass['id']}}">{{ $medicalDeviceClass['nama_kelas_alkes'] }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kelas_resiko_alkes_id">Kelas Resiko Alkes</label>
                      <select class="form-control" name="kelas_resiko_alkes_id" id="kelas_resiko_alkes_id">
                        <option selected disabled>Pilih Kelas Resiko Alkes</option>
                        @foreach (App\Models\MedicalDeviceRiskClass::orderBy('id', 'asc')->get() as
                        $MedicalDeviceRiskClass)
                        <option value="{{$MedicalDeviceRiskClass['id']}}">{{
                          $MedicalDeviceRiskClass['nama_kelas_resiko_alkes']
                          }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="sifat_alkes_id">Sifat Alkes</label>
                      <select class="form-control" name="sifat_alkes_id" id="sifat_alkes_id">
                        <option selected disabled>Pilih Sifat Alkes</option>
                        @foreach (App\Models\MedicalDeviceProperties::orderBy('id', 'asc')->get() as
                        $MedicalDeviceProperty)
                        <option value="{{$MedicalDeviceProperty['id']}}">{{
                          $MedicalDeviceProperty['nama_sifat_alkes']
                          }}
                        </option>
                        @endforeach
                      </select>
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
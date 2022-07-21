@extends('search.layouts.master')
@section('content')
<!-- Main content -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <div class="card">
          <div class="card-body">
            <form>
              <h3 class="text-center text-info"><b>Cari Apotek</b></h3>
              <div class="form-group">
                <input type="text" class="form-control rounded-pill border-primary" id="apotek"
                  placeholder="Cari Apotek">
              </div>
              <hr>
              <h5 class="text-center">Opsi Lanjutan</h5>
              <div class="form-row">
                <div class="form-group col-md">
                  <label for="provinsi_id">Provinsi</label>
                  <select name="provinsi_id" id="provinsi_id" class="form-control rounded-pill border-info">
                    <option selected disabled>Pilih Provinsi</option>
                  </select>
                </div>
                <div class="form-group col-md">
                  <label for="Kabupaten_id">Kabupaten Kota</label>
                  <select id="Kabupaten_id" class="form-control rounded-pill border-info">
                    <option selected disabled>Pilih Kabupaten Kota</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="form-group col-md">
                  <label for="kecamatan_id">Kecamatan</label>
                  <select name="kecamatan_id" id="kecamatan_id" class="form-control rounded-pill border-info">
                    <option selected disabled>Pilih Kecamatan</option>
                    <option>...</option>
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
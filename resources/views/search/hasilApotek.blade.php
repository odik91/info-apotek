@extends('search.layouts.master')
@section('content')

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row d-flex align-items-stretch">
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
          <div class="card bg-light w-100">
            <div class="card-header text-muted border-bottom-0">
              Apotek
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-7">
                  <h2 class="lead"><b>Syahira Farma</b></h2>
                  <p class="text-muted text-sm"><b>Nomor Izin: </b>
                    2127/BPT/SIA-02/2008
                  </p>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: Jl. Jend.
                      Sudirman Tanjung Batu, Kundur, Kabupaten Karimun, Kepulauan Riau </li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12
                      12 23 52</li>
                  </ul>
                </div>
                <div class="col-5 text-center">
                  <img src="{{asset('template/dist/img/apotek.png')}}" alt="" class="img-circle img-fluid">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-right">
                <a href="#" class="btn btn-sm bg-teal">
                  <i class="fas fa-map-marked-alt"></i> Lihat di GMAP
                </a>
                <a href="#" class="btn btn-sm btn-primary">
                  <i class="fas fa-mortar-pestle"></i> Lihat Detail
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <nav aria-label="Contacts Page Navigation">
        <ul class="pagination justify-content-center m-0">
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">4</a></li>
          <li class="page-item"><a class="page-link" href="#">5</a></li>
          <li class="page-item"><a class="page-link" href="#">6</a></li>
          <li class="page-item"><a class="page-link" href="#">7</a></li>
          <li class="page-item"><a class="page-link" href="#">8</a></li>
        </ul>
      </nav>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection
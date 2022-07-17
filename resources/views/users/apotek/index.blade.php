@extends('users.layouts.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('apotek.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Apotek Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{asset('template/dist/img/apotek.png')}}"
                  alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{$users['nama_apotek']}}</h3>

              <p class="text-muted text-center">Apotek</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{$users->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Nomor Izin</b> <a class="float-right">
                    @if (isset(auth()->user()->no_izin))
                    {{auth()->user()->no_izin}}
                    @else
                    {{'-'}}
                    @endif
                  </a>
                </li>
                <li class="list-group-item">
                  <b>P.Jawab</b> <a class="float-right">
                    @if (isset(auth()->user()->penanggung_jawab))
                    {{ucwords(auth()->user()->penanggung_jawab)}}
                    @else
                    {{'-'}}
                    @endif
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Nomor Telepon</b> <a class="float-right">
                    @if (isset(auth()->user()->no_telepon))
                    {{ucwords(auth()->user()->no_telepon)}}
                    @else
                    {{'-'}}
                    @endif
                  </a>
                </li>
              </ul>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Detail Info Apotek</b></a> --}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tentang Apotek</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

              <p class="text-muted">
                @if (isset(auth()->user()->alamat))
                {{auth()->user()->alamat}}, {{ucwords($users->userDistrict->nama_kecamatan)}},
                {{" " . ucwords($users->userCity->nama_kabupaten_kota)}},
                {{" " . ucwords($users->userProvince->nama_provinsi)}}
                @else
                {{ 'Mohon lengkapi alamat anda' }}
                @endif
              </p>

              <hr>
              <strong><i class="fas fa-map"></i> Lokasi G-Map</strong>

              <p class="text-muted">
                @if (isset(auth()->user()->longlat))
                {{auth()->user()->longlat}}
                @else
                {{ 'Mohon lengkapi pinpoin lokasi anda' }}
                @endif
              </p>
              @php
              $query = str_replace(" ", "+", $users["nama_apotek"]);
              $pinpoint = str_replace(" ", "", $users['longlat']);
              @endphp
              <a href="https://www.google.com/maps/place/{{'@' . $pinpoint}},18z/data=!3m1!4b1"
                class="btn btn-block btn-info" target="_blank">Lihat di Google Map</a>

              <hr>

              <strong><i class="fas fa-pills"></i> Jumlah Jenis Obat Tersedia</strong>
              <p class="text-muted">
                <span class="tag tag-danger">0</span>
              </p>

              <hr>

              <strong><i class="fas fa-microscope"></i> Jumlah Jenis Alkes Tersedia</strong>

              <p class="text-muted">
                <span class="tag tag-danger">0</span>
              </p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#obat" data-toggle="tab">List Obat
                    Tersedia</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">List Alkes Tersedia</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Pengaturan Akun</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="obat">
                  @if (count($medichine_stocks) > 0)
                  <!-- datatable -->
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Kelas Obat</th>
                        <th>Subkelas Obat</th>
                        <th>Sediaan</th>
                        <th>Kekuatan</th>
                        <th>Satuan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>12</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>13</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>14</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>15</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>16</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>17</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>18</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>19</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>20</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>21</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>22</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>23</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>24</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>25</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>26</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>27</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>28</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>29</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>30</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>31</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>32</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>33</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>34</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>35</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>36</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>37</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>38</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>39</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>40</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>41</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>42</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>43</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>44</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>45</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>46</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>47</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>48</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                      <tr>
                        <td>49</td>
                        <td>Fentanyl</td>
                        <td>Kelas Obat</td>
                        <td>Subkelas Obat</td>
                        <td>Sediaan</td>
                        <td>Kekuatan</td>
                        <td>Satuan</td>
                        <td>Status</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Fentanyl</th>
                        <th>Kelas Obat</th>
                        <th>Subkelas Obat</th>
                        <th>Sediaan</th>
                        <th>Kekuatan</th>
                        <th>Satuan</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                  </table>
                  <!-- /.datatable -->
                  @else
                  <h1 class="text-center">Belum Ada Stok Obat</h1>
                  <p class="text-center">
                    <a href="#" class="btn btn-info">Tambahkan Stok Sekarang</a>
                  </p>
                  @endif
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                  @if (count($medicalEquipmentStocks) > 0)
                  {{ count($medicalEquipmentStocks) }}
                  @else
                  <h1 class="text-center">Belum Ada Stok Alkes</h1>
                  <p class="text-center">
                    <a href="#" class="btn btn-info">Tambahkan Stok Alkes Sekarang</a>
                  </p>
                  @endif
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                  <h1 class="text-center">Kelola Profil Apotek</h1>
                  <form class="form-horizontal" method="POST" action="{{route('apotek.update', [auth()->user()->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                      <label for="no_izin" class="col-sm-2 col-form-label">Nomor izin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control @error('no_izin') is-invalid @enderror" id="no_izin"
                          name="no_izin" placeholder="Nomor izin">
                        @error('no_izin')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="penanggung_jawab" class="col-sm-2 col-form-label">Penanggung jawab</label>
                      <div class="col-sm-10">
                        <input type="text"
                          class="form-control form-control @error('penanggung_jawab') is-invalid @enderror"
                          id="penanggung_jawab" name="penanggung_jawab" placeholder="Penanggung jawab">
                        @error('penanggung_jawab')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                          name="alamat" placeholder="Alamat" value="{{auth()->user()->alamat}}">
                        @error('alamat')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="provinsi_id" class="col-sm-2 col-form-label">Provinsi</label>
                      <div class="col-sm-10">
                        <select name="provinsi_id" id="provinsi_id"
                          class="form-control @error('provinsi_id') is-invalid @enderror" required>
                          <option value="" selected>Pilih Provinsi</option>
                          @foreach (App\Models\Province::orderBy('id', 'asc')->get() as $province)
                          <option value="{{$province['id']}}">{{ $province['nama_provinsi'] }}
                          </option>
                          @endforeach
                        </select>
                        @error('provinsi_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="kabupaten_id" class="col-sm-2 col-form-label">Kabupaten Kota</label>
                      <div class="col-sm-10">
                        <select name="kabupaten_id" id="kabupaten_id"
                          class="form-control @error('kabupaten_id') is-invalid @enderror" required>
                          <option selected disabled>Pilih Kabupaten Kota</option>
                        </select>
                        @error('kabupaten_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="kecamatan_id" class="col-sm-2 col-form-label">Kecamatan</label>
                      <div class="col-sm-10">
                        <select name="kecamatan_id" id="kecamatan_id"
                          class="form-control @error('kecamatan_id') is-invalid @enderror">
                          <option selected disabled>Pilih Kecamatan</option>
                        </select>
                        @error('kecamatan_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_telepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                          id="no_telepon" name="no_telepon" placeholder="Nomor Telepon"
                          value="{{auth()->user()->no_telepon}}">
                        @error('no_telepon')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="longlat" class="col-sm-2 col-form-label">Pinpont Lokasi</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control @error('longlat') is-invalid @enderror" id="longlat"
                          name="longlat" placeholder="Pinpoint Lokasi ex:-6.227403,106.806142"
                          value="{{auth()->user()->longlat}}">
                        @error('longlat')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@push('addon-css')
<link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@push('addon-script')
<!-- jQuery -->
<script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('template/dist/js/demo.js')}}"></script>
<!-- page script -->
<script>
  capitalizeTheFirstLetterOfEachWord = (words) => {
    var separateWord = words.toLowerCase().split(' ');
    for (var i = 0; i < separateWord.length; i++) {
        separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
        separateWord[i].substring(1);
    }
    return separateWord.join(' ');
  }

  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "searching": true,
      "ordering": true,
    })
  })

  $(document).ready(() => {
    let province = "select[name='provinsi_id']"
    $(province).on('change', (e) => {
      let provinceValue = $(province).val();
      if (provinceValue != "") {
        $.ajax({
          url: 'apotek-city/' + provinceValue,
          type: 'GET',
          dataType: 'json',
          success: (data) => {
            // console.log(data);
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
    $(city).on('change', (e) => {
      let cityValue = $(city).val();
      if (cityValue != "") {
        $.ajax({
          url: 'apotek-distric/' + cityValue,
          type: 'GET',
          dataType: 'json',
          success: (data) => {
            // console.log(data);
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
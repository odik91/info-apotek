@extends('layouts.authLayout')
@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>SIM</b> Apotek</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg"><b>Daftar</b></p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" id="nama_apotek" name="nama_apotek"
                        class="form-control @error('nama_apotek') is-invalid @enderror" placeholder="Nama Apotek"
                        value="{{ old('nama_apotek') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                        value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password-confirm" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Konfirmasi password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree"
                                class="form-control @error('terms') is-invalid @enderror">
                            <label for="agreeTerms">
                                Saya setuju dengan <a href="#" data-toggle="modal" data-target="#syarat">S & K</a>
                            </label>
                        </div>
                        @error('terms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="container mt-2">
                <div class="d-flex justify-content-between">
                    <div class="col-sm"><a href="{{route('login')}}">Punya Akun? Masuk</a></div>
                    <div class="col-sm text-right"><a href="#">Lupa Password</a></div>
                </div>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

{{-- modal --}}
<!-- Modal -->
<div class="modal fade" id="syarat" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Syarat dan Ketentuan Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam id tortor quam. Cras egestas
                    ultricies purus
                    quis tristique. Mauris convallis gravida metus, vel cursus erat semper a. In vehicula libero ac
                    elementum
                    vehicula. Etiam ornare, ex at auctor tristique, eros nisl maximus nibh, at feugiat diam enim nec
                    risus. Orci
                    varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent quam
                    elit,
                    consequat et vehicula at, tincidunt at arcu. Nullam id ex eget diam facilisis cursus eu quis tellus.
                    Donec non
                    tristique tortor. Aliquam vitae sem aliquam, tincidunt est a, hendrerit diam. Aliquam erat volutpat.
                    Lorem
                    ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempus bibendum elementum. Ut ac est quis
                    ipsum
                    molestie rhoncus id sit amet diam.</p>

                <p>Fusce lorem dui, porta quis ipsum ac, tempus ornare libero. Suspendisse et nisl non enim varius
                    facilisis
                    convallis et tellus. Ut nec egestas ante. Suspendisse sollicitudin sem a elit iaculis pulvinar.
                    Curabitur
                    cursus, felis ut lobortis venenatis, justo metus feugiat mi, non ultrices lacus erat vitae turpis.
                    Morbi
                    ultrices orci eu mi tincidunt, ac sodales neque gravida. Morbi non ligula eu tellus lobortis
                    placerat a et
                    ligula. Etiam porttitor nunc non nibh rhoncus rutrum.</p>

                <p>Etiam purus lacus, imperdiet in nulla quis, suscipit finibus sapien. Donec nec rutrum felis. Sed odio
                    arcu,
                    pretium eu maximus id, imperdiet finibus velit. Pellentesque bibendum bibendum eros a commodo. Duis
                    porttitor,
                    sapien non tincidunt pellentesque, metus urna tincidunt mauris, a hendrerit urna augue in odio.
                    Vestibulum
                    ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas laoreet
                    aliquet mi, ut
                    volutpat diam posuere venenatis.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
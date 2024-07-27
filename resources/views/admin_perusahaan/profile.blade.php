@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('perusahaan.profile.update', Auth::user()->id) }}" method="post">
                            @csrf
                            <p class="text-uppercase text-sm">Information Pribadi</p>
                            @if (session('success'))
                                <div class="alert-success alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_depan" for="nama_depan" class="form-control-label">Nama
                                            Perusahaan</label>
                                        <input class="form-control @error('nama_depan') is-invalid @enderror "
                                            name="nama_depan" id="nama_depan" type="text"
                                            value="{{ old('nama_depan', $user->nama_depan ?? '') }}" required>
                                        @error('nama_depan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
                                            required>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_hp" class="form-group-label">No Hp</label>
                                        <input class="form-control @error('no_hp') is-invalid @enderror" type="number"
                                            name="no_hp" id="no_hp"
                                            value="{{ old('no_hp', $user->profile->no_hp ?? '') }}" required>
                                        @error('no_hp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Kontak Pribadi</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="provinsi" class="form-control-label">Provinsi</label>
                                        <input class="form-control @error('provinsi') is-invalid @enderror" type="text"
                                            id="provinsi" name="provinsi"
                                            value="{{ old('provinsi', $user->alamat->provinsi ?? '') }}" required>
                                        @error('provinsi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kab_kot" class="form-control-label">Kabupaten / Kota</label>
                                        <input class="form-control @error('kab_kot') is-invalid @enderror" type="text"
                                            name="kab_kot" id="kab_kot"
                                            value="{{ old('kab_kot', $user->alamat->kab_kot ?? '') }}" required>
                                        @error('kab_kot')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kecamatan" class="form-control-label">Kecamatan</label>
                                        <input class="form-control @error('kecamatan') is-invalid @enderror" type="text"
                                            id="kecamatan" name="kecamatan"
                                            value="{{ old('kecamatan', $user->alamat->kecamatan ?? '') }}" >
                                        @error('kecamatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="desa" class="form-control-label">Desa</label>
                                        <input type="text" name="desa" id="desa"
                                            class="form-control @error('desa') is-invalid @enderror"
                                            value="{{ old('desa', $user->alamat->desa ?? '') }}" >
                                        @error('desa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kode_pos" class="form-control-group">Kode Pos</label>
                                        <input type="number" name="kode_pos" id="kode_pos"
                                            class="form-control @error('kode_pos') is-invalid @enderror"
                                            value="{{ old('kode_pos', $user->alamat->kode_pos ?? '') }}" required>
                                        @error('kode_pos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat" class="form-control-label">Alamat</label>
                                        <input class="form-control @error('alamat') is-invalid @enderror" type="text"
                                            id="alamat" name="alamat"
                                            value="{{ old('alamat', $user->alamat->alamat ?? '') }}" required>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Sosial Media</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="linkedin" class="form-control-label">Linkedin</label>
                                        <input type="text" name="linkedin" id="linkedin"
                                            class="form-control @error('linkedin') is-invalid @enderror"
                                            value="{{ old('linkedin', $user->sosmed->linkedin ?? '') }}"
                                            placeholder="Username Linkedin">
                                        @error('linkedin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="twiter" class="form-control-label">Twiter</label>
                                        <input type="text" name="twiter" id="twiter"
                                            class="form-control @error('twiter') is-invalid @enderror"
                                            value="{{ old('twiter', $user->sosmed->twiter ?? '') }}"
                                            placeholder="Username Twiter">
                                        @error('twiter')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website" class="form-control-label">Website</label>
                                        <input type="text" name="website" id="website"
                                            class="form-control @error('website') is-invalid @enderror"
                                            value="{{ old('website', $user->sosmed->website ?? '') }}"
                                            placeholder="www.simami.com">
                                        @error('website')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="instagram" class="form-control-label">Instagram</label>
                                        <input type="text" name="instagram" id="instagram"
                                            class="form-control @error('instagram') is-invalid @enderror"
                                            value="{{ old('instagram', $user->sosmed->instagram ?? '') }}"
                                            placeholder="Username Instagram">
                                        @error('instagram')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="facebook" class="form-control-label">Facebook</label>
                                        <input type="text" name="facebook" id="facebook"
                                            class="form-control @error('facebook') is-invalid @enderror"
                                            value="{{ old('facebook', $user->sosmed->facebook ?? '') }}"
                                            placeholder="Username Facebook">
                                        @error('facebook')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tiktok" class="form-control-label">Tiktok</label>
                                        <input type="text" name="tiktok" id="tiktok"
                                            class="form-control @error('tiktok') is-invalid @enderror"
                                            value="{{ old('tiktok', $user->sosmed->tiktok ?? '') }}"
                                            placeholder="Username Tiktok">
                                        @error('tiktok')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mx-3 mb-4">Update</button>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-sm-3 ">
                <div class="card card-profile">
                    @if (session('uploadSuccess'))
                        <div class="alert alert-success">
                            {{ session('uploadSuccess') }}
                        </div>
                    @endif
                    <form action="{{ route('perusahaan.foto.update', Auth::user()->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- Input image baru --}}
                        <input type="file" name="img" id="img" class="d-none" accept="image/*"
                            onchange="previewImage(event)">

                        @if ($user->profile && $user->profile->img)
                            <label for="img" class="cursor-pointer">
                                <img src="{{ asset('img/profile/' . $user->profile->img) }}" alt="Image placeholder"
                                    class="card-img-top rounded rounded-circle" id="image-preview">
                            </label>
                        @else
                            <label for="img" class="cursor-pointer">
                                <img id="image-preview" src="{{ asset('img/profile/profile-default.jpg') }}"
                                    alt="Image placeholder" class="card-img-top rounded rounded-circle">
                            </label>
                        @endif
                        @error('img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row justify-content-center">
                            <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="text-center mt-1">
                                <button type="submit" class="btn btn-primary mt-1">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                // output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection

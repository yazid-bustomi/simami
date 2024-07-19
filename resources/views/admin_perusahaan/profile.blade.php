@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
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
                                        Kampus</label>
                                    <input class="form-control @error('nama_depan') is-invalid @enderror " name="nama_depan"
                                        id="nama_depan" type="text"
                                        value="{{ old('nama_depan', $mahasiswa->nama_depan ?? '') }}" required>
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
                                        name="email" id="email" value="{{ old('email', $mahasiswa->email ?? '') }}"
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
                                        value="{{ old('no_hp', $mahasiswa->mahasiswaProfile->no_hp ?? '') }}" required>
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
                                        value="{{ old('provinsi', $mahasiswa->alamat->provinsi ?? '') }}" required>
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
                                        value="{{ old('kab_kot', $mahasiswa->alamat->kab_kot ?? '') }}" required>
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
                                        value="{{ old('kecamatan', $mahasiswa->alamat->kecamatan ?? '') }}" required>
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
                                        value="{{ old('desa', $mahasiswa->alamat->desa ?? '') }}" required>
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
                                        value="{{ old('kode_pos', $mahasiswa->alamat->kode_pos ?? '') }}" required>
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
                                        value="{{ old('alamat', $mahasiswa->alamat->alamat ?? '') }}" required>
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
                                        value="{{ old('linkedin', $mahasiswa->sosmed->linkedin ?? '') }}"
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
                                        value="{{ old('twiter', $mahasiswa->sosmed->twiter ?? '') }}"
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
                                        value="{{ old('website', $mahasiswa->sosmed->website ?? '') }}"
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
                                        value="{{ old('instagram', $mahasiswa->sosmed->instagram ?? '') }}"
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
                                        value="{{ old('facebook', $mahasiswa->sosmed->facebook ?? '') }}"
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
                                        value="{{ old('tiktok', $mahasiswa->sosmed->tiktok ?? '') }}"
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
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-sm-3 ">
                <div class="card card-profile">
                    {{-- Input image baru --}}
                    <input type="file" name="img" id="img" class="d-none" accept="image/*"
                        onchange="previewImage(event)">

                    {{-- @if ($mahasiswa->mahasiswaProfile && $mahasiswa->mahasiswaProfile->img)
                    <label for="img" class="cursor-pointer">
                        <img src="{{ asset('img/profile/' . $mahasiswa->mahasiswaProfile->img) }}"
                            alt="Image placeholder" class="card-img-top rounded rounded-circle" id="image-preview">
                    </label>
                @else --}}
                    <label for="img" class="cursor-pointer">
                        <img id="image-preview" src="{{ asset('img/profile/profile-default.jpg') }}"
                            alt="Image placeholder" class="card-img-top rounded rounded-circle">
                    </label>
                    {{-- @endif
                @error('img')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-4">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid text-center mx-4">
                                        <span class="text-lg font-weight-bolder mx-2">22</span>
                                        <span class="text-sm opacity-8">Mahasiswa</span>
                                    </div>
                                    <div class="d-grid text-center mx-4">
                                        <span class="text-lg font-weight-bolder mx-2">89</span>
                                        <span class="text-sm opacity-8">Magang</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            {{-- <h5>{{ $mahasiswa->nama_depan }} {{ $mahasiswa->nama_belakang }}<span class="font-weight-light">,
                                20</span>
                        </h5>
                        <div class="h6 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{ $mahasiswa->akademikProfile->adminKampus->nama_depan }}
                            {{ $mahasiswa->akademikProfile->adminKampus->nama_belakang }}
                        </div>
                        <div class="h6 mt-4">
                            <i
                                class="ni business_briefcase-24 mr-2"></i>{{ $mahasiswa->akademikProfile->jurusanKampus->nama_jurusan }}
                        </div> --}}

                            <button type="submit" class="btn btn-primary mt-4">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

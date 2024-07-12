@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase text-sm">Input Lowongan Magang</h5>
                    <form action="{{ route('lowongan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="judul" class="form-control-label">Judul Magang</label>
                                    <input class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" type="text" value="{{ old('judul') }}" required>
                                    @error('judul')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pemagang" class="form-control-label">Jumlah Magang</label>
                                    <input class="form-control @error('pemagang') is-invalid @enderror" id="pemagang" name="pemagang" type="number" value="{{ old('pemagang') }}" required>
                                    @error('pemagang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-control-label">Deskripsi Magang</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="durasi_magang" class="form-control-label">Durasi Magang (bulan)</label>
                                    <input class="form-control @error('durasi_magang') is-invalid @enderror" id="durasi_magang" name="durasi_magang" type="number" value="{{ old('durasi_magang') }}" required>
                                    @error('durasi_magang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="open_lowongan" class="form-control-label">Open Lowongan</label>
                                    <input class="form-control @error('open_lowongan') is-invalid @enderror" name="open_lowongan" type="date" value="{{ old('open_lowongan') }}" required>
                                    @error('open_lowongan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="close_lowongan" class="form-control-label">Close Lowongan</label>
                                    <input class="form-control @error('close_lowongan') is-invalid @enderror" name="close_lowongan" type="date" value="{{ old('close_lowongan') }}" required>
                                    @error('close_lowongan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="img" class="form-control-label">Upload Gambar</label>
                                    <input class="form-control @error('img') is-invalid @enderror" id="img" name="img" type="file" accept="image/*" onchange="previewImage(event)">
                                    @error('img')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <img id="image-preview" src="#" alt="Preview Gambar" style="display: none; max-height: 200px;" class="img-fluid mt-3" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection

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
                                    <input class="form-control" id="judul" name="judul" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pemagang" class="form-control-label">Jumlah Magang</label>
                                    <input class="form-control" id="pemagang" name="pemagang" type="number" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-control-label">Deskripsi Magang</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="durasi_magang" class="form-control-label">Durasi Magang (bulan)</label>
                                    <input class="form-control" id="durasi_magang" name="durasi_magang" type="number" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="open_lowongan" class="form-control-label">Open Lowongan</label>
                                    <input class="form-control" name="open_lowongan" type="date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="close_lowongan" class="form-control-label">Close Lowongan</label>
                                    <input class="form-control" name="close_lowongan" type="date" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="img" class="form-control-label">Upload Gambar</label>
                                    <input class="form-control" id="img" name="img" type="file" accept="image/*" onchange="previewImage(event)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <img id="image-preview" src="#" alt="Preview Gambar" style="display: none; max-height: 200px;" class="img-fluid mt-3"/>
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
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
@endsection


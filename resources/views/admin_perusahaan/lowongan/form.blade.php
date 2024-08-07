<form action="{{ isset($lowongan) ? route('lowongan.update', $lowongan->id) : route('lowongan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($lowongan))
        @method('PUT')
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="judul" class="form-control-label">Posisi Magang</label>
                <input class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                    type="text" value="{{ old('judul', $lowongan->judul ?? '') }}" required>
                @error('judul')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="pemagang" class="form-control-label">Jumlah Kebutuhan Peserta</label>
                <input class="form-control @error('pemagang') is-invalid @enderror" id="pemagang" name="pemagang"
                    type="number" value="{{ old('pemagang', $lowongan->pemagang ?? '') }}" required>
                @error('pemagang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="kriteria" class="form-control-label">Kriteria Peserta</label>
                <textarea class="form-control @error('kriteria') is-invalid @enderror" id="kriteria" name="kriteria" rows="10"
                    required>{{ old('kriteria', $lowongan->kriteria ?? '') }}</textarea>
                @error('kriteria')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="rincian" class="form-control-label">Rincian Kegiatan Magang</label>
                <textarea class="form-control @error('rincian') is-invalid @enderror" id="rincian" name="rincian" rows="10"
                    required>{{ old('rincian', $lowongan->rincian ?? '') }}</textarea>
                @error('rincian')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="durasi_magang" class="form-control-label">Durasi Magang (bulan)</label>
                <input class="form-control @error('durasi_magang') is-invalid @enderror" id="durasi_magang"
                    name="durasi_magang" type="number" value="{{ old('durasi_magang', $lowongan->durasi_magang ?? '') }}" required>
                @error('durasi_magang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="close_lowongan" class="form-control-label">Batas Pendaftaran</label>
                <input class="form-control @error('close_lowongan') is-invalid @enderror" name="close_lowongan"
                    type="date" value="{{ old('close_lowongan', $lowongan->close_lowongan ?? '') }}" required>
                @error('close_lowongan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="img" class="form-control-label">Upload Flyer (Jika ada)</label>
                <input class="form-control @error('img') is-invalid @enderror" id="img" name="img"
                    type="file" accept="image/*" onchange="previewImage(event)">
                @error('img')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <img id="image-preview" src="{{ isset($lowongan) && $lowongan->img ? asset('img/post/' . $lowongan->img) : '#' }}" alt="Preview Gambar" style="{{ isset($lowongan) && $lowongan->img ? 'display: block;' : 'display: none;' }}  max-height: 200px;"
                    class="img-fluid mt-3" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">{{ isset($lowongan) ? 'Update' : 'Submit' }}</button>
        </div>
    </div>
</form>

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

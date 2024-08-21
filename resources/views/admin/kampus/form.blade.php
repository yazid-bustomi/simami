<form action="{{ isset($kampuses) ? route('kampus.update', $kampuses->id) : route('kampus.store') }}" method="post">
    @csrf
    @if (isset($kampuses))
        @method('PUT')
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="nama_depan" class="form-control-label ">Nama Kampus</label>
                <input class="form-control @error('nama_depan') is-invalid @enderror" name="nama_depan" id="nama_depan" type="text"
                     onfocusout="defocused(this)"
                    value="{{ old('nama_depan', $kampuses->nama_depan ?? '') }}">

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
                <input class="form-control @error('email') is-invalid @enderror" name="email"
                    id="email" type="email" onfocusout="defocused(this)"
                    value="{{ old('email', $kampuses->email ?? '') }}">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="password" class="form-control-label">Password</label>
                <div class="input-group">
                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                        id="password" type="password" onfocusout="defocused(this)" autocomplete="current-password"
                        value="{{ old('password') }}">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword()">
                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                        </span>

                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center mt-3">
            <a href="{{ route('kampus.index') }}" class="btn btn-danger mx-4">Back</a>
            @if (isset($kampuses))
                <button type="submit" class="btn btn-primary mx-4">Update</button>
            @else
                <button type="submit" class="btn btn-primary mx-4">Tambah</button>
            @endif
        </div>
    </div>
</form>

<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var toggleIcon = document.getElementById("togglePasswordIcon");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

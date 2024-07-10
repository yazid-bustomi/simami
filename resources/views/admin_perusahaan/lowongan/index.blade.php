@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Lowongan Magang</h5>
            @if (Auth::user()->role == 'perusahaan')
            <a href="#" class="btn btn-primary btn-sm mr-4">
                <i class="fas fa-plus-circle fa-sm fa-fw mr-2"></i> Tambah Lowongan
            </a>
            @else

            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Pemagang</th>
                            <th>Durasi</th>
                            <th>Open Informasi</th>
                            <th>Pendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach ($lowongans as $lowongan)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $lowongan->judul }}</td>
                                <td>{{ $lowongan->pemagang }}</td>
                                <td>{{ $lowongan->durasi_magang }}</td>
                                <td>{{ $lowongan->close_lowongan }}</td>
                                <td>{{ $lowongan->pendaftar()->count() }}</td>
                                {{-- <td>
                                    <button class="badge bg-primary text-white rounded-pill"
                                        onclick="confirmAction('{{ $lowongan->id }}', '{{ $lowongan->judul }}', 'terima')">Terima</button>

                                    <button class="badge bg-danger text-white rounded-pill"
                                        onclick="confirmAction('{{ $lowongan->id }}', '{{ $lowongan->judul }}', 'tolak')">Tolak</button>

                                    <a href="#"
                                        class="badge bg-info text-white rounded-pill">Detail</a>

                                    <form id="action-form-{{ $lowongan->id }}" action="" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </td> --}}
                            </tr>
                            @php $no++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <script>
        function confirmAction(id, name, action) {
            let actionText = action === 'terima' ? 'menerima' : 'menolak';
            let route = action === 'terima' ? '{{ route("pendaftar.edit", ":id") }}' : '{{ route("pendaftar.edit", ":id") }}';
            route = route.replace(':id', id);

            Swal.fire({
                title: `Apakah yakin ${actionText} ${name}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ' + actionText,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById('action-form-' + id);
                    form.action = route;
                    form.submit();
                }
            });
        }
    </script> --}}

@endsection

@section('script')
    <!-- Page level plugins -->
    <script src={{ asset('vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('js/demo/datatables-demo.js') }}></script>
@endsection

@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Pelamar Lowongan Magang</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Posisi Magang</th>
                            <th>Nama</th>
                            <th>No Hp</th>
                            @if (Auth::user()->role == 'perusahaan')
                                <th>Instansi</th>
                                <th>Jurusan</th>
                            @endif
                            <th>Semester</th>
                            <th>Ipk</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $role = Auth::user()->role;
                            $no = 1;
                        @endphp
                        @foreach ($pendaftars as $pendaftar)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $pendaftar->lowongan->judul }}</td>
                                <td>{{ $pendaftar->user->nama_depan }} {{ $pendaftar->user->nama_belakang }}</td>
                                <td>{{ $pendaftar->user->mahasiswaProfile->no_hp ?? '-' }}</td>
                                @if (Auth::user()->role == 'perusahaan')
                                    <td>{{ $pendaftar->user->akademikProfile->adminKampus->nama_depan ?? '-' }}</td>
                                    <td>{{ $pendaftar->user->akademikProfile->jurusanKampus->nama_jurusan ?? '-' }}</td>
                                @endif
                                <td>{{ $pendaftar->user->akademikProfile->semester ?? '-' }}</td>
                                <td>{{ $pendaftar->user->akademikProfile->ipk ?? '-' }}</td>
                                <td>
                                    @if ($pendaftar->status == 'pending')
                                        <div class="text-info">Seleksi Kampus</div>
                                    @elseif ($pendaftar->status == 'approve')
                                        <div class="text-primary"> Seleksi Perusahaan </div>
                                    @elseif ($pendaftar->status == 'select')
                                        <div class="text-success">Diterima Magang</div>
                                    @elseif ($pendaftar->status == 'rejected_kampus')
                                        <div class="text-danger">Ditolak Kampus</div>
                                    @else
                                        <div class="text-danger">Ditolak Perusahaan</div>
                                    @endif
                                </td>
                                <td>
                                    {{-- jika kampus dan status pending maka approve di lakukan oleh kampus terlebih dahulu --}}
                                    @if ($role == 'kampus' && $pendaftar->status == 'pending')
                                        <button class="badge bg-primary text-white rounded-pill"
                                            onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'approve')">Terima</button>
                                        <button class="badge bg-danger text-white rounded-pill"
                                            onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'rejected_kampus')">Tolak</button>

                                        {{-- Jika sudah di approve kampus maka di proses perusahaan apakah di terima atau di tolak --}}
                                    @elseif ($role == 'perusahaan' && $pendaftar->status == 'approve')
                                        <button class="badge bg-primary text-white rounded-pill"
                                            onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'select')">Terima</button>
                                        <button class="badge bg-danger text-white rounded-pill"
                                            onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'rejected_perusahaan')">Tolak</button>
                                    @endif
                                    <button class="badge bg-info text-white rounded-pill"
                                        onclick="showDetail({{ $pendaftar->user }})">Detail</button>

                                    <form id="action-form-{{ $pendaftar->id }}"
                                        action="{{ route('pendaftar.update', ['pendaftar' => $pendaftar->id]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="lowongan_id" value="{{ $pendaftar->lowongan_id }}"
                                            hidden>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmAction(id, name, action) {
            let actionText = '';
            let status = '';

            if (action === 'approve') {
                actionText = 'mengajukan magang';
                status = 'approve';
            } else if (action === 'select') {
                actionText = 'menerima mahasiswa';
                status = 'select';
            } else if (action === 'rejected_kampus') {
                actionText = 'menolak';
                status = 'rejected_kampus';
            } else if (action === 'rejected_perusahaan') {
                actionText = 'menolak';
                status = 'rejected_perusahaan';
            }


            let route = '{{ route('pendaftar.update', ':id') }}';
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

                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'status';
                    input.value = status;
                    form.appendChild(input);
                    form.submit();
                }
            });
        }

        function showDetail(user) {
            const socialMediaLinks = [{
                platform: 'LinkedIn',
                url: user.sosmed?.linkedin,
                icon: 'fab fa-linkedin'
            }, {
                platform: 'Twitter',
                url: user.sosmed?.twiter,
                icon: 'fab fa-twitter'
            }, {
                platform: 'Instagram',
                url: user.sosmed?.instagram,
                icon: 'fab fa-instagram'
            }, {
                platform: 'TikTok',
                url: user.sosmed?.tiktok,
                icon: 'fab fa-tiktok'
            }, {
                platform: 'Facebook',
                url: user.sosmed?.facebook,
                icon: 'fab fa-facebook'
            }, {
                platform: 'Website',
                url: user.sosmed?.website,
                icon: 'fab fa-globe'
            }];

            const socialMediaHtml = socialMediaLinks
                .filter(link => link.url)
                .map(link => `
                        <a href="${link.url}" class="card-link" target="_blank">
                        <i class="${link.icon} mb-3"></i> ${link.platform}
                        </a>`).join('');


            Swal.fire({
                title: `${user.nama_depan} ${user.nama_belakang}`,
                imageUrl: `/public/profile/${user.profile.img || 'profile-default.jpg'}`,
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Foto Profile",
                html: `
                <div class="card-body">
                    <p class="card-text">Dusun Kedungwaru Lor Rt.01 Rw.03 Jawa Timur Kabupaten Pasuruan Kecamatan Winongan Desa Sidepan 57182</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>No Hp:</strong> ${user.profile.no_hp || ''}</li>
                    <li class="list-group-item"><strong>Email:</strong> ${user.email}</li>
                    <li class="list-group-item"><strong>Jenis Kelamin:</strong> ${user.profile.jenis_kelamin || ''}</li>
                    <li class="list-group-item"><strong>Tempat, Tanggal Lahir:</strong> ${user.profile.tempat_lahir || ''}, ${user.profile.tanggal_lahir || ''}</li>
                    <li class="list-group-item"><strong>Agama:</strong> ${user.profile.agama || ''}</li>
                    <li class="list-group-item"><strong>Kampus:</strong> ${user.akademik_profile.admin_kampus.nama_depan || ''}</li>
                    <li class="list-group-item"><strong>Jurusan:</strong> ${user.akademik_profile.jurusan_kampus.nama_jurusan || ''}</li>
                    <li class="list-group-item"><strong>NIM:</strong> ${user.akademik_profile.nim || ''}</li>
                    <li class="list-group-item"><strong>IPK:</strong> ${user.akademik_profile.ipk !== null ? user.akademik_profile.ipk : '-'}</li>
                </ul>
                <div class="card-body">
                    ${socialMediaHtml}
            `,
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'Close',
            });
        }
        // <p><strong>Nama:</strong> ${user.nama_depan} ${user.nama_belakang}</p>
        //         <p><strong>Alamat:</strong> ${user.alamat.alamat} ${user.alamat.provinsi} ${user.alamat.kab_kot} ${user.alamat.kecamatan} ${user.alamat.desa} ${user.alamat.kode_pos}</p>
        //         <p><strong>Email:</strong> ${user.email}</p>
        //         <p><strong>Telepon:</strong> ${user.profile.no_hp}</p>
        //         <p><strong>Social Media:</strong></p>
        //         <ul>
        //         <li><strong><Website :/strong><a href="http://${user.sosmed.website} target="_blank">${user.sosmed.website}</a></li>
        // <li><strong>Linkedin :</strong><a href="https://www.linkedin.com/company/${user.sosmed.linkedin} target="_blank">${user.sosmed.linkedin}</a></li>
        //  <li><strong>Twitter :</strong><a href="https://twitter.com/${user.sosmed.twiter} target="_blank">${user.sosmed.twiter}</a></li>
        // <li><strong>Instagram :</strong><a href="https://www.instagram.com/${user.sosmed.instagram} target="_blank">${user.sosmed.instagram}</a></li>
        // <li><strong>Facebook :</strong><a href="https://www.facebook.com/${user.sosmed.facebook} target="_blank">${user.sosmed.facebook}</a></li>
        //                 </ul>
    </script>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src={{ asset('vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('js/demo/datatables-demo.js') }}></script>
@endsection

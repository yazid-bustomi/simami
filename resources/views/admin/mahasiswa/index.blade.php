@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Mahasiswa</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nim</th>
                            <th>Email</th>
                            <th>Kampus</th>
                            <th>Jurusan</th>
                            <th>No Hp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp

                        @foreach ($mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $mahasiswa->nama_depan }} {{ $mahasiswa->nama_belakang ?? '' }}</td>
                                <td>{{ $mahasiswa->akademikProfile->nim ?? '-' }}</td>
                                <td>{{ $mahasiswa->email ?? '' }}</td>
                                <td>{{ $mahasiswa->akademikProfile->adminKampus->nama_depan ?? '' }}</td>
                                <td>{{ $mahasiswa->akademikProfile->jurusanKampus->nama_jurusan ?? '-' }}</td>
                                <td>{{ $mahasiswa->profile->no_hp ?? '-' }}</td>
                                <td>
                                    <button class="badge bg-info text-white rounded-pill"
                                    onclick="showDetail({{ $mahasiswa }})">Detail</button>
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
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src={{ asset('vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('js/demo/datatables-demo.js') }}></script>

    <script>
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


            const $items = [{
                    nameItem: 'Email :',
                    name: user.email,
                },
                {
                    nameItem: 'No Hp:',
                    name: user.profile?.no_hp,
                },
                {
                    nameItem: 'Jenis Kelamin :',
                    name: user.profile?.jenis_kelamin
                },
                {
                    nameItem: 'Tempat, Tanggal Lahir :',
                    name: user.profile?.tempat_lahir,
                },
                {
                    nameItem: 'Agama :',
                    name: user.profile?.agama,
                },
                {
                    nameItem: 'Kampus :',
                    name: user.akademik_profile?.admin_kampus.nama_depan,
                },
                {
                    nameItem: 'Jurusan :',
                    name: user.akademik_profile?.jurusan_kampus.nama_jurusan,
                },
                {
                    nameItem: 'NIM :',
                    name: user.akademik_profile?.nim,
                },
                {
                    nameItem: 'IPK :',
                    name: user.akademik_profile?.ipk,
                },
            ];

            const $itemHtml = $items
                .filter(data => data.name)
                .map(data => `<li class="list-group-item"><strong>${data.nameItem}</strong> ${data.name}</li>`).join('');

            Swal.fire({
                title: `${user.nama_depan || ''} ${user.nama_belakang || ''}`,
                imageUrl: `/img/profile/${user.profile?.img || 'profile-default.jpg'}`,
                imageAlt: "Foto Profile",
                html: `
                <ul class="list-group list-group-flush">
                    ${$itemHtml}
                </ul>
                <div class="card-body">
                    ${socialMediaHtml}
            `,
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'Close',
            });
        }
    </script>
@endsection

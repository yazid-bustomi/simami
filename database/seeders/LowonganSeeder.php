<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('lowongans')->insert([
            [
                'user_id' => 4,
                'judul' => 'Web Developer Intern',
                'rincian' => 'Membantu dalam pengembangan dan pemeliharaan situs web perusahaan.
                Berkolaborasi dengan tim untuk merancang, mengembangkan, dan menguji fitur baru.
                Menganalisis dan memperbaiki bug yang ditemukan.
                Menyediakan dokumentasi teknis untuk kode yang dikembangkan.',
                'kriteria' => 'Mahasiswa jurusan Teknik Informatika, Ilmu Komputer, atau jurusan terkait.
                Menguasai HTML, CSS, JavaScript, dan framework seperti Laravel atau React.
                Memiliki pengalaman dengan version control system (Git).
                Mampu bekerja dalam tim dan berkomunikasi dengan baik.
                Kreatif dan memiliki kemampuan problem-solving yang baik.',
                'pemagang' => '2',
                'durasi_magang' => '3',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 5,
                'judul' => 'Digital Marketing',
                'rincian' => 'Mengelola akun media sosial perusahaan dan konten blog.
                Membuat dan mengimplementasikan strategi pemasaran digital.
                Menganalisis kinerja kampanye digital dan memberikan laporan.
                Berkontribusi dalam brainstorming ide-ide kampanye pemasaran.',
                'kriteria' => 'Mahasiswa jurusan Pemasaran, Komunikasi, atau jurusan terkait.
                Memahami dasar-dasar pemasaran digital, SEO, dan SEM.
                Familiar dengan media sosial dan alat analitik (Google Analytics).
                Memiliki kemampuan menulis konten yang menarik.
                Kreatif dan mampu bekerja dengan pengawasan minimal.
                ',
                'pemagang' => 5,
                'durasi_magang' => '2',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],

        ]);
    }
}

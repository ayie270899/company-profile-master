<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $pages = [
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => 'Kami adalah perusahaan teknologi yang berdedikasi untuk memberikan solusi digital terbaik. Berdiri sejak tahun 2015, kami telah membantu ratusan klien dari berbagai industri untuk bertransformasi secara digital. Tim kami terdiri dari para profesional berpengalaman di bidang pengembangan web, mobile, dan cloud computing.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Visi & Misi',
                'slug' => 'visi-misi',
                'content' => 'Visi: Menjadi perusahaan teknologi terdepan di Indonesia yang menghadirkan inovasi digital untuk kemajuan bisnis. Misi: 1) Menyediakan layanan teknologi berkualitas tinggi, 2) Membangun hubungan jangka panjang dengan klien, 3) Mengembangkan talenta digital terbaik.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Syarat & Ketentuan',
                'slug' => 'syarat-ketentuan',
                'content' => 'Dengan menggunakan layanan kami, Anda menyetujui syarat dan ketentuan berikut. Semua konten yang ditampilkan di website ini adalah milik perusahaan dan dilindungi oleh hak cipta. Penggunaan tanpa izin dilarang keras.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Kebijakan Privasi',
                'slug' => 'kebijakan-privasi',
                'content' => 'Kami menghargai privasi Anda. Data pribadi yang dikumpulkan akan digunakan hanya untuk keperluan layanan kami. Kami tidak akan membagikan data Anda kepada pihak ketiga tanpa persetujuan Anda.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'FAQ',
                'slug' => 'faq',
                'content' => 'Q: Bagaimana cara menghubungi kami? A: Anda dapat menggunakan form contact di halaman kontak. Q: Berapa lama waktu pengerjaan proyek? A: Tergantung pada kompleksitas proyek, umumnya 2-8 minggu. Q: Apakah tersedia layanan support? A: Ya, kami menyediakan support 24/7 untuk semua klien.',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}

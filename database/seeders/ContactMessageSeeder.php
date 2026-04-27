<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'subject' => 'Pertanyaan tentang layanan Web Development',
                'message' => 'Halo, saya tertarik dengan layanan web development yang ditawarkan. Apakah bisa dibuatkan website e-commerce? Berapa estimasi biaya dan waktu pengerjaannya? Terima kasih.',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@email.com',
                'subject' => 'Request Demo Aplikasi Manajemen',
                'message' => 'Selamat pagi, saya dari PT Sejahtera Abadi. Kami sedang mencari solusi aplikasi manajemen untuk kantor kami. Apakah bisa dijadwalkan demo? Kami memiliki sekitar 50 karyawan.',
            ],
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@email.com',
                'subject' => 'Kerjasama Mobile App Development',
                'message' => 'Assalamualaikum, saya ingin mendiskusikan kerjasama pembuatan aplikasi mobile untuk startup kami di bidang food delivery. Mohon info lebih lanjut mengenai proses dan timeline pengerjaan.',
            ],
            [
                'name' => 'Dewi Kartika',
                'email' => 'dewi.kartika@email.com',
                'subject' => 'Konsultasi UI/UX Design',
                'message' => 'Hai tim, kami memiliki website yang sudah berjalan tapi tampilan dan UX-nya perlu di-revamp. Apakah tersedia layanan redesign saja tanpa pengembangan ulang dari nol?',
            ],
            [
                'name' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@email.com',
                'subject' => 'Migrasi Cloud Server',
                'message' => 'Selamat siang, perusahaan kami ingin memigrasikan server on-premise ke cloud. Saat ini kami menggunakan 3 server fisik. Apakah tim Anda bisa membantu proses migrasi ini?',
            ],
            [
                'name' => 'Rina Amelia',
                'email' => 'rina.amelia@email.com',
                'subject' => 'Penawaran Digital Marketing',
                'message' => 'Halo, saya pemilik toko online fashion. Saya tertarik dengan layanan digital marketing untuk meningkatkan penjualan. Mohon dikirimkan proposal dan price list-nya. Terima kasih.',
            ],
            [
                'name' => 'Hendra Wijaya',
                'email' => 'hendra.wijaya@email.com',
                'subject' => 'Bug Report Website',
                'message' => 'Saya menemukan masalah pada halaman portfolio. Gambar tidak muncul saat dibuka di browser Safari. Mohon segera diperbaiki.',
            ],
            [
                'name' => 'Linda Permata',
                'email' => 'linda.permata@email.com',
                'subject' => 'Lowongan Kerja Developer',
                'message' => 'Selamat sore, apakah saat ini perusahaan membuka lowongan untuk posisi Full Stack Developer? Saya memiliki pengalaman 3 tahun menggunakan Laravel dan React. Mohon info lebih lanjut.',
            ],
            [
                'name' => 'Agus Prabowo',
                'email' => 'agus.prabowo@email.com',
                'subject' => 'Maintenance Website Bulanan',
                'message' => 'Kami membutuhkan jasa maintenance website bulanan meliputi update konten, backup data, dan monitoring keamanan. Berapa biaya per bulannya?',
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya.sari@email.com',
                'subject' => 'Ucapan Terima Kasih',
                'message' => 'Terima kasih banyak atas website yang sudah jadi! Hasilnya sangat memuaskan dan sesuai dengan ekspektasi kami. Tim kami sangat senang dengan tampilan dan fitur-fiturnya. Semoga bisa bekerjasama lagi di proyek berikutnya.',
            ],
        ];

        foreach ($messages as $message) {
            ContactMessage::create($message);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $portfolios = [
            [
                'title' => 'E-Commerce Platform Tokoku',
                'slug' => 'e-commerce-platform-tokoku',
                'short_desc' => 'Platform e-commerce lengkap untuk UMKM Indonesia.',
                'detail_content' => 'Tokoku adalah platform e-commerce yang kami bangun untuk membantu para pelaku UMKM di Indonesia menjual produk mereka secara online. Dibangun menggunakan Laravel dan Vue.js dengan integrasi payment gateway Midtrans, logistik RajaOngkir, dan dashboard analytics real-time. Platform ini telah melayani lebih dari 500 merchant aktif.',
                'project_date' => '2025-06-15',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Aplikasi Manajemen Klinik SehatPlus',
                'slug' => 'aplikasi-manajemen-klinik-sehatplus',
                'short_desc' => 'Sistem informasi manajemen klinik terintegrasi.',
                'detail_content' => 'SehatPlus adalah aplikasi manajemen klinik yang mencakup pendaftaran pasien, rekam medis elektronik, manajemen jadwal dokter, pengelolaan stok obat, dan sistem billing. Aplikasi ini dibangun dengan Laravel, Livewire dan terintegrasi dengan BPJS Kesehatan API. Saat ini digunakan oleh 12 klinik di Jabodetabek.',
                'project_date' => '2025-09-20',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Company Profile PT Maju Bersama',
                'slug' => 'company-profile-pt-maju-bersama',
                'short_desc' => 'Website company profile modern dan responsif.',
                'detail_content' => 'Website company profile untuk PT Maju Bersama yang bergerak di bidang konstruksi. Didesain dengan tampilan modern, animasi smooth, dan fully responsive. Dilengkapi dengan halaman project showcase, team profile, dan form kontak terintegrasi WhatsApp. Dibangun menggunakan Next.js dan Tailwind CSS.',
                'project_date' => '2025-12-10',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Mobile App GoFitness',
                'slug' => 'mobile-app-gofitness',
                'short_desc' => 'Aplikasi fitness tracking dan personal trainer.',
                'detail_content' => 'GoFitness adalah aplikasi mobile untuk tracking aktivitas fitness dan koneksi dengan personal trainer. Fitur utama meliputi workout planner, calorie tracker, progress photo journal, dan video call dengan trainer. Dibangun menggunakan Flutter dengan backend Firebase dan custom API Laravel. Tersedia di Google Play Store dan App Store dengan rating 4.7 bintang.',
                'project_date' => '2026-02-28',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}

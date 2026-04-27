<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $services = [
            [
                'title' => 'Web Development',
                'slug' => 'web-development',
                'short_desc' => 'Pengembangan website profesional dengan teknologi modern.',
                'description' => 'Kami menyediakan layanan pengembangan website dari awal hingga deployment. Menggunakan teknologi terkini seperti Laravel, React, Vue.js, dan Next.js. Setiap website yang kami buat dirancang responsif, cepat, dan SEO-friendly. Tim developer kami berpengalaman menangani proyek skala kecil hingga enterprise.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'short_desc' => 'Pembuatan aplikasi mobile untuk iOS dan Android.',
                'description' => 'Layanan pembuatan aplikasi mobile native maupun cross-platform menggunakan Flutter, React Native, dan Swift. Kami memastikan aplikasi yang dibangun memiliki performa tinggi, UI/UX yang menarik, dan terintegrasi dengan berbagai API dan layanan pihak ketiga.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'short_desc' => 'Desain antarmuka pengguna yang intuitif dan menarik.',
                'description' => 'Tim desainer kami akan merancang tampilan yang modern, user-friendly, dan sesuai dengan identitas brand Anda. Proses desain kami meliputi riset pengguna, wireframing, prototyping, hingga final design menggunakan Figma dan Adobe Creative Suite.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Cloud Hosting & DevOps',
                'slug' => 'cloud-hosting-devops',
                'short_desc' => 'Layanan cloud hosting dan otomasi infrastruktur.',
                'description' => 'Kami menyediakan layanan cloud hosting menggunakan AWS, Google Cloud, dan DigitalOcean. Dilengkapi dengan konfigurasi CI/CD pipeline, monitoring, auto-scaling, dan disaster recovery untuk menjamin uptime 99.9% bagi aplikasi Anda.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Digital Marketing',
                'slug' => 'digital-marketing',
                'short_desc' => 'Strategi pemasaran digital untuk pertumbuhan bisnis.',
                'description' => 'Meningkatkan visibilitas online bisnis Anda melalui SEO, SEM, Social Media Marketing, dan Content Marketing. Tim marketing kami akan menyusun strategi yang terukur dan efektif untuk meningkatkan traffic dan konversi bisnis Anda.',
                'created_by' => $admin->id,
            ],
            [
                'title' => 'IT Consulting',
                'slug' => 'it-consulting',
                'short_desc' => 'Konsultasi teknologi informasi untuk bisnis Anda.',
                'description' => 'Layanan konsultasi IT untuk membantu perusahaan Anda memilih solusi teknologi yang tepat. Kami memberikan rekomendasi arsitektur sistem, pemilihan teknologi, assessment keamanan, dan roadmap transformasi digital.',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

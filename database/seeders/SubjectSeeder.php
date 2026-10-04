<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // =========================
            // AGAMA & KEIMANAN
            // =========================
            [
                'code' => 'PAI',
                'name' => 'Pendidikan Agama Islam dan Budi Pekerti',
            ],
            [
                'code' => 'PABP-KATOLIK',
                'name' => 'Pendidikan Agama Katolik dan Budi Pekerti',
            ],
            [
                'code' => 'PABP-KRISTEN',
                'name' => 'Pendidikan Agama Kristen dan Budi Pekerti',
            ],
            [
                'code' => 'PABP-HINDU',
                'name' => 'Pendidikan Agama Hindu dan Budi Pekerti',
            ],
            [
                'code' => 'PABP-BUDDHA',
                'name' => 'Pendidikan Agama Buddha dan Budi Pekerti',
            ],
            [
                'code' => 'PABP-KONGHUCU',
                'name' => 'Pendidikan Agama Khonghucu dan Budi Pekerti',
            ],

            // =========================
            // PENDIDIKAN DASAR & UMUM
            // =========================
            [
                'code' => 'PANCASILA',
                'name' => 'Pendidikan Pancasila',
            ],
            [
                'code' => 'BIND',
                'name' => 'Bahasa Indonesia',
            ],
            [
                'code' => 'BING',
                'name' => 'Bahasa Inggris',
            ],
            [
                'code' => 'MAT',
                'name' => 'Matematika',
            ],
            [
                'code' => 'IPA',
                'name' => 'Ilmu Pengetahuan Alam',
            ],
            [
                'code' => 'IPS',
                'name' => 'Ilmu Pengetahuan Sosial',
            ],
            [
                'code' => 'IPAS',
                'name' => 'Ilmu Pengetahuan Alam dan Sosial',
            ],
            [
                'code' => 'SEJARAH',
                'name' => 'Sejarah',
            ],
            [
                'code' => 'GEOGRAFI',
                'name' => 'Geografi',
            ],
            [
                'code' => 'EKONOMI',
                'name' => 'Ekonomi',
            ],
            [
                'code' => 'SOSIOLOGI',
                'name' => 'Sosiologi',
            ],
            [
                'code' => 'ANTROPOLOGI',
                'name' => 'Antropologi',
            ],

            // =========================
            // SENI & OLAHRAGA
            // =========================
            [
                'code' => 'SENI',
                'name' => 'Seni Budaya',
            ],
            [
                'code' => 'SENI-MUSIK',
                'name' => 'Seni Musik',
            ],
            [
                'code' => 'SENI-RUPA',
                'name' => 'Seni Rupa',
            ],
            [
                'code' => 'SENI-TARI',
                'name' => 'Seni Tari',
            ],
            [
                'code' => 'SENI-TEATER',
                'name' => 'Seni Teater',
            ],
            [
                'code' => 'PJOK',
                'name' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan',
            ],

            // =========================
            // TEKNOLOGI
            // =========================
            [
                'code' => 'INFORMATIKA',
                'name' => 'Informatika',
            ],
            [
                'code' => 'KODING-AI',
                'name' => 'Koding dan Kecerdasan Artifisial',
            ],
            [
                'code' => 'PRAKARYA',
                'name' => 'Prakarya',
            ],
            [
                'code' => 'TIK',
                'name' => 'Teknologi Informasi dan Komunikasi',
            ],

            // =========================
            // BAHASA & SASTRA
            // =========================
            [
                'code' => 'BIND-LANJUT',
                'name' => 'Bahasa Indonesia Tingkat Lanjut',
            ],
            [
                'code' => 'BING-LANJUT',
                'name' => 'Bahasa Inggris Tingkat Lanjut',
            ],
            [
                'code' => 'BAHASA-ARAB',
                'name' => 'Bahasa Arab',
            ],
            [
                'code' => 'BAHASA-JEPANG',
                'name' => 'Bahasa Jepang',
            ],
            [
                'code' => 'BAHASA-MANDARIN',
                'name' => 'Bahasa Mandarin',
            ],
            [
                'code' => 'BAHASA-JERMAN',
                'name' => 'Bahasa Jerman',
            ],
            [
                'code' => 'BAHASA-KOREA',
                'name' => 'Bahasa Korea',
            ],
            [
                'code' => 'BAHASA-PRANCIS',
                'name' => 'Bahasa Prancis',
            ],

            // =========================
            // MUATAN LOKAL
            // =========================
            [
                'code' => 'B-JAWA',
                'name' => 'Bahasa Jawa',
            ],
            [
                'code' => 'B-SUNDA',
                'name' => 'Bahasa Sunda',
            ],
            [
                'code' => 'B-MADURA',
                'name' => 'Bahasa Madura',
            ],
            [
                'code' => 'B-BALI',
                'name' => 'Bahasa Bali',
            ],
            [
                'code' => 'B-BUGIS',
                'name' => 'Bahasa Bugis',
            ],
            [
                'code' => 'B-MINANG',
                'name' => 'Bahasa Minangkabau',
            ],
            [
                'code' => 'MULOK',
                'name' => 'Muatan Lokal',
            ],

            // =========================
            // SMA/MA - PEMINATAN / PILIHAN
            // =========================
            [
                'code' => 'FISIKA',
                'name' => 'Fisika',
            ],
            [
                'code' => 'KIMIA',
                'name' => 'Kimia',
            ],
            [
                'code' => 'BIOLOGI',
                'name' => 'Biologi',
            ],

            // =========================
            // SMK - KELOMPOK KEJURUAN
            // =========================
            [
                'code' => 'DASAR-PROGRAM-KEAHLIAN',
                'name' => 'Dasar-Dasar Program Keahlian',
            ],
            [
                'code' => 'KOMPETENSI-KEAHLIAN',
                'name' => 'Konsentrasi Keahlian',
            ],
            [
                'code' => 'PROJEK-KREATIF',
                'name' => 'Projek Kreatif dan Kewirausahaan',
            ],
            [
                'code' => 'PKK',
                'name' => 'Produk Kreatif dan Kewirausahaan',
            ],
            [
                'code' => 'PKL',
                'name' => 'Praktik Kerja Lapangan',
            ],

            // =========================
            // BIMBINGAN & PENGEMBANGAN
            // =========================
            [
                'code' => 'BK',
                'name' => 'Bimbingan dan Konseling',
            ],
            [
                'code' => 'KEWIRAUSAHAAN',
                'name' => 'Kewirausahaan',
            ],

            // =========================
            // KOKURIKULER / PROJEK
            // =========================
            [
                'code' => 'KOKURIKULER',
                'name' => 'Kegiatan Kokurikuler',
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(
                ['code' => $subject['code']],
                ['name' => $subject['name']]
            );
        }
    }
}

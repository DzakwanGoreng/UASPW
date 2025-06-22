<?php
// database/seeders/OrganisasiSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organisasi;

class OrganisasiSeeder extends Seeder
{
    public function run()
    {
        $organisasi = [
            ['nama_organisasi' => 'BEM Universitas', 'jenis' => 'Eksekutif'],
            ['nama_organisasi' => 'HIMA Teknik Informatika', 'jenis' => 'Himpunan'],
            ['nama_organisasi' => 'HIMA Sistem Informasi', 'jenis' => 'Himpunan'],
            ['nama_organisasi' => 'UKM Basket', 'jenis' => 'Olahraga'],
            ['nama_organisasi' => 'UKM Musik', 'jenis' => 'Seni'],
        ];

        foreach ($organisasi as $org) {
            Organisasi::create($org);
        }
    }
}

// database/seeders/LokasiSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run()
    {
        $lokasi = [
            ['nama_lokasi' => 'Aula Utama', 'alamat' => 'Gedung Rektorat Lantai 3'],
            ['nama_lokasi' => 'Ruang Lab Komputer', 'alamat' => 'Gedung Fakultas Teknik Lantai 2'],
            ['nama_lokasi' => 'Lapangan Basket', 'alamat' => 'Area Olahraga Kampus'],
            ['nama_lokasi' => 'Ruang Seminar', 'alamat' => 'Gedung Pascasarjana Lantai 1'],
            ['nama_lokasi' => 'Auditorium', 'alamat' => 'Gedung Pusat Kegiatan Mahasiswa'],
        ];

        foreach ($lokasi as $lok) {
            Lokasi::create($lok);
        }
    }
}

// database/seeders/AnggotaSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $anggota = [
            ['nama' => 'Ahmad Rizki', 'nim' => '2021001', 'organisasi_id' => 1],
            ['nama' => 'Siti Nurhaliza', 'nim' => '2021002', 'organisasi_id' => 1],
            ['nama' => 'Budi Santoso', 'nim' => '2021003', 'organisasi_id' => 2],
            ['nama' => 'Dewi Lestari', 'nim' => '2021004', 'organisasi_id' => 2],
            ['nama' => 'Eko Prasetyo', 'nim' => '2021005', 'organisasi_id' => 3],
            ['nama' => 'Fitri Handayani', 'nim' => '2021006', 'organisasi_id' => 3],
            ['nama' => 'Gilang Ramadhan', 'nim' => '2021007', 'organisasi_id' => 4],
            ['nama' => 'Hani Wijaya', 'nim' => '2021008', 'organisasi_id' => 4],
            ['nama' => 'Indra Kusuma', 'nim' => '2021009', 'organisasi_id' => 5],
            ['nama' => 'Joko Widodo', 'nim' => '2021010', 'organisasi_id' => 5],
        ];

        foreach ($anggota as $ang) {
            Anggota::create($ang);
        }
    }
}

// database/seeders/KegiatanSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;

class KegiatanSeeder extends Seeder
{
    public function run()
    {
        $kegiatan = [
            [
                'nama' => 'Seminar Nasional IT',
                'tgl_pelaksanaan' => '2024-03-15',
                'organisasi_id' => 2,
                'lokasi_id' => 1
            ],
            [
                'nama' => 'Workshop Programming',
                'tgl_pelaksanaan' => '2024-03-20',
                'organisasi_id' => 2,
                'lokasi_id' => 2
            ],
            [
                'nama' => 'Turnamen Basket',
                'tgl_pelaksanaan' => '2024-04-01',
                'organisasi_id' => 4,
                'lokasi_id' => 3
            ],
            [
                'nama' => 'Konser Musik Kampus',
                'tgl_pelaksanaan' => '2024-04-15',
                'organisasi_id' => 5,
                'lokasi_id' => 5
            ],
            [
                'nama' => 'Rapat Kerja BEM',
                'tgl_pelaksanaan' => '2024-05-01',
                'organisasi_id' => 1,
                'lokasi_id' => 4
            ],
        ];

        foreach ($kegiatan as $keg) {
            Kegiatan::create($keg);
        }
    }
}

// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            OrganisasiSeeder::class,
            LokasiSeeder::class,
            AnggotaSeeder::class,
            KegiatanSeeder::class,
        ]);
    }
}
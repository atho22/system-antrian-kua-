<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            ['code' => 'N', 'name' => 'Daftar Nikah'],
            ['code' => 'L', 'name' => 'Legalisir Buku Nikah'],
            ['code' => 'S', 'name' => 'Surat Keterangan Belum Menikah'],
            ['code' => 'P', 'name' => 'Pelimpahan Nikah'],
            ['code' => 'W', 'name' => 'Pengurusan Wakaf'],
            ['code' => 'K', 'name' => 'Konsultasi Nikah'],
            ['code' => 'O', 'name' => 'Lainnya'],
        ]);
    }
} 
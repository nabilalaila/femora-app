<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('program')->insert([
            [
                'nama_program' => 'Program Sehat Haid',
                'tanggal_pelaksanaan' => Carbon::now()->addDays(10),
                'tanggal_buka'=> Carbon::now()->addDays(9),
                'tanggal_tutup'=> Carbon::now()->addDay(),
                'is_online' => true,
                'is_delete'=> false,
                'deskripsi_program' => 'Panduan menjaga kesehatan saat haid.',
                'info_peserta' => '',
                'created_by' => 1,
                'foto_header' => 'https://asset-2.tstatic.net/newsmaker/foto/bank/images/fakta-kim-seon-ho-aktor-dalam-drama-start-up.jpg',
                'max_peserta' => 50,
                'harga_program' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_program' => 'Cek Kesehatan Rutin',
                'tanggal_pelaksanaan' => Carbon::now()->addDays(20),
                'tanggal_buka'=> Carbon::now()->addDays(9),
                'tanggal_tutup'=> Carbon::now()->addDay(),
                'is_online' => false,
                'is_delete'=> false,
                'deskripsi_program' => 'Kegiatan pemeriksaan rutin bulanan.',
                'info_peserta' => 'Silahkan join zoom di www.zoom.com',
                'created_by' => 1,
                'foto_header' => 'https://cdn.antaranews.com/cache/1200x800/2021/10/19/instagram-kim.jpg',
                'max_peserta' => 30,
                'harga_program' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_program' => 'Sadar Masa Subur',
                'tanggal_pelaksanaan' => Carbon::now()->addDays(30),
                'tanggal_buka'=> Carbon::now()->addDays(9),
                'tanggal_tutup'=> Carbon::now()->addDay(),
                'is_online' => true,
                'is_delete'=> false,
                'deskripsi_program' => 'Kelas online mengenali masa subur.',
                'info_peserta' => 'Kataku sih ayo cepet join grup wa biar nggak ketinggalan infonya',
                'created_by' => 1,
                'foto_header' => 'https://akcdn.detik.net.id/visual/2021/10/28/kim-seon-ho-2_169.jpeg?w=400&q=90',
                'max_peserta' => 100,
                'harga_program' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

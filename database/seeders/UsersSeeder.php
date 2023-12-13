<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Haikal Sucipto',
            'JAD' => 'Lektor',
            'Prodi' => 'S1 Teknik Industri',
            'KK' => 'CYBERNET',
            'NIP' => '12030001', //NIP as Username
            'email' => 'yasser20@gmail.com',
            'KK' => 'CYBERNET',
            'level' => 'dekan',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'nama' => 'Rafa Alvito',
            'JAD' => 'Lektor',
            'Prodi' => 'S2 Teknik Industri',
            'KK' => 'EINS',
            'NIP' => '12030002', //NIP as Username
            'email' => 'rafa1gmail.com',
            'level' => 'sekretariat',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'nama' => 'Raya',
            'JAD' => 'Lektor',
            'Prodi' => 'S1 Sistem Informasi',
            'KK' => 'ENGINEERING MANAGEMENT',
            'NIP' => '12030003', //NIP as Username
            'email' => 'raya@gmail.com',
            'level' => 'sekretariat',
            'password' => bcrypt('123'),
        ]);


        User::create([
            'nama' => 'Yasser Sumarno',
            'JAD' => 'Asisten Ahli',
            'Prodi' => 'S2 Sistem Informasi',
            'KK' => 'CYBERNET',
            'NIP' => '12030004', //NIP as Username
            'email' => 'yasser10@gmail.com',
            'level' => 'dosen',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'nama' => 'Diky',
            'JAD' => 'Asisten Ahli',
            'Prodi' => 'S1 Digital Supply Chain',
            'KK' => 'PROMASYS',
            'NIP' => '12030005', //NIP as Username
            'email' => 'diky@gmail.com',
            'level' => 'sekretariat2',
            'password' => bcrypt('123'),
        ]);

    }
}
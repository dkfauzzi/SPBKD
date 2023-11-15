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
            'KK' => 'CYBERNET',
            'NIP' => '162019016', //NIP as Username
            'email' => 'yasser20@gmail.com',
            'KK' => 'CYBERNET',
            'level' => 'dekan',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'nama' => 'Rafa Alvito',
            'JAD' => 'Lektor',
            'KK' => 'CYBERNET',
            'NIP' => '162019018', //NIP as Username
            'email' => 'rafa1gmail.com',
            'level' => 'sekretariat',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'nama' => 'Raya',
            'JAD' => 'Lektor',
            'KK' => 'CYBERNET',
            'NIP' => '162019019', //NIP as Username
            'email' => 'raya@gmail.com',
            'level' => 'sekretariat',
            'password' => bcrypt('123'),
        ]);


        User::create([
            'nama' => 'Yasser Sumarno',
            'JAD' => 'Asisten Ahli',
            'KK' => 'CYBERNET',
            'NIP' => '162019017', //NIP as Username
            'email' => 'yasser10@gmail.com',
            'level' => 'dosen',
            'password' => bcrypt('123'),
        ]);

    }
}
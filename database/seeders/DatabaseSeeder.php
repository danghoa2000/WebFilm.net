<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $film = new Film();
            $film->img = 'sdsaa';
            $film->img_background = 'asdasd';
            $film->name =  'sdasd';
            $film->nam_sx = '1111';
            $film->mota =  'asfasd';
            $film->quoc_gia = 'asdfas';
        $film->save();
    }
}

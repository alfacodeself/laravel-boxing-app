<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::create([
            'hari' => 'minggu'
        ]);
        Day::create([
            'hari' => 'senin'
        ]);
        Day::create([
            'hari' => 'selasa'
        ]);
        Day::create([
            'hari' => 'rabu'
        ]);
        Day::create([
            'hari' => 'kamis'
        ]);
        Day::create([
            'hari' => 'jumat'
        ]);
        Day::create([
            'hari' => 'sabtu'
        ]);
    }
}

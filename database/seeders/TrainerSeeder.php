<?php

namespace Database\Seeders;

use App\Models\ProgramClassHasTrainer;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Trainer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('level', 'trainer')->first();
        $trainer = Trainer::create([
            'user_id' => $user->id,
            'uuid' => Str::uuid(),
            'foto' => 'no-foto',
            'nama' => 'Trainer Testing',
            'tempat_lahir' => 'Pontianak',
            'tanggal_lahir' => Carbon::now(),
            'nomor_hp' => 6285158151151,
            'alamat' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus, dolor.',
            'foto_ktp' => 'no-foto-ktp',
            'cv' => 'no-cv',
        ]);
    }
}

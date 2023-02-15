<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\MemberHasWeightClass;
use App\Models\WeightClass;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('level', 'member')->first();
        $weight = WeightClass::create([
            'uuid' => Str::uuid(),
            'kelas_berat' => 'Kelas A',
            'minimal_berat' => 25.0,
            'maksimal_berat' => 30.0
        ]);
        $member = Member::create([
            'user_id' => $user->id,
            'uuid' => Str::uuid(),
            'foto' => 'no-foto',
            'nama' => 'Member Testing',
            'tempat_lahir' => 'Pontianak',
            'tanggal_lahir' => Carbon::now(),
            'nomor_hp' => 6285158151151,
            'alamat' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus, dolor.'
        ]);
        MemberHasWeightClass::create([
            'uuid' => Str::uuid(),
            'member_id' => $member->id,
            'weight_class_id' => $weight->id,
            'tinggi_badan' => 170.3,
            'berat_badan' => 28.4,
            'keterangan' => 'Awal Mendaftar',
            'tanggal_ukur' => Carbon::now()
        ]);
    }
}

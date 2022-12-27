<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::truncate();
        Device::insert([
            [
                'id' => 'A001',
                'user_id' => 2,
            ],
            [
                'id' => 'A002',
                'user_id' => null,
            ]
        ]);
    }
}

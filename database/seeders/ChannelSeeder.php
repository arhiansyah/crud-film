<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Netflix',
                'logo' => 'channel/netflix-logo.jpg'
            ],
            [
                'name' => 'Viu',
                'logo' => 'channel/viu-logo.jpg'
            ],
            [
                'name' => 'Youtube',
                'logo' => 'channel/yt-logo.jpg'
            ],
            [
                'name' => 'Cruchyroll',
                'logo' => 'channel/croll-logo.jpg'
            ],
        ])->each(function ($data) {
            Channel::create($data);
        });
    }
}

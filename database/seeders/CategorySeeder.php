<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'name' => 'Series',
            ],
            [
                'name' => 'Movies',
            ],
            [
                'name' => 'TV/Film',
            ],
        ])->each(function ($data) {
            Category::create($data);
        });
    }
}

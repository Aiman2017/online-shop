<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sizes = ['small', 'medium', 'large', 'x-large', 'xx-large', 'x-small', 'xx-small', 'x-md', 'xx-md'];
        foreach ($sizes as $size) {
            if (!empty($size)) {
                Size::where('name', $size)->delete();
            }
            Size::create(['name' => $size]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Src\Domain\Product\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         Product::factory(100)->create();
    }
}

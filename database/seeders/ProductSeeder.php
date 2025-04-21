<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 products using the factory
        Product::factory()
            ->count(10)
            ->create();
        
        // Optional: Output confirmation message
        $this->command->info('10 products created!');
    }
}
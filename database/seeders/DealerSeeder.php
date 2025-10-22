<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dealer;

class DealerSeeder extends Seeder
{
    public function run(): void
    {
        Dealer::factory()->count(5)->create();
    }
}

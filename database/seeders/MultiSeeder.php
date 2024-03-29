<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MultiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_accounts')->insert([
            ['name' => 'Asset', 'parent_id' => 0],
            ['name' => 'Liability', 'parent_id' => 0],
            ['name' => 'Income', 'parent_id' => 0],
            ['name' => 'Expense', 'parent_id' => 0],
            ['name' => 'Capital', 'parent_id' => 0],
            ['name' => 'Investment', 'parent_id' => 0],
        
        ]);

        DB::table('months')->insert([
            ['name' => 'January'],
            ['name' => 'February'],
            ['name' => 'March'],
            ['name' => 'April'],
            ['name' => 'May'],
            ['name' => 'June'],
            ['name' => 'July'],
            ['name' => 'August'],
            ['name' => 'September'],
            ['name' => 'October'],
            ['name' => 'November'],
            ['name' => 'December']
        
        ]);
    }
}

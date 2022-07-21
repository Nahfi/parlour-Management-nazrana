<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(21,40) as $index) {
            ExpenseCategory::create([
                'name' => 'category'.$index,
                'status' => 'DeActive',
                'created_by' => '1'
            ]);
        }
    }

    
}

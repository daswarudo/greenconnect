<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllergiesTableSeeder extends Seeder
{
    public function run()
    {
        $allergies = [
            ['allergy_id' => 1, 'allergy_type' => 'Wheat', 'allergy_source' => 'Grain'],
            ['allergy_id' => 2, 'allergy_type' => 'Milk', 'allergy_source' => 'Dairy'],
            ['allergy_id' => 3, 'allergy_type' => 'Egg', 'allergy_source' => 'Protein'],
            ['allergy_id' => 4, 'allergy_type' => 'Peanut', 'allergy_source' => 'Nut'],
            ['allergy_id' => 5, 'allergy_type' => 'Soy', 'allergy_source' => 'Legume'],
            ['allergy_id' => 6, 'allergy_type' => 'Fish', 'allergy_source' => 'Seafood'],
            ['allergy_id' => 7, 'allergy_type' => 'Shellfish', 'allergy_source' => 'Seafood'],
            ['allergy_id' => 8, 'allergy_type' => 'Tree Nuts', 'allergy_source' => 'Nut'],
            ['allergy_id' => 9, 'allergy_type' => 'Sesame', 'allergy_source' => 'Seed'],
            ['allergy_id' => 10, 'allergy_type' => 'Corn', 'allergy_source' => 'Grain'],
            ['allergy_id' => 11, 'allergy_type' => 'Chicken', 'allergy_source' => 'Meat'],
            ['allergy_id' => 12, 'allergy_type' => 'Beef', 'allergy_source' => 'Meat'],
            ['allergy_id' => 13, 'allergy_type' => 'Pork', 'allergy_source' => 'Meat'],
            ['allergy_id' => 14, 'allergy_type' => 'Lamb', 'allergy_source' => 'Meat'],
            ['allergy_id' => 15, 'allergy_type' => 'Gluten', 'allergy_source' => 'Grain'],
        ];

        DB::table('allergies')->insert($allergies);
    }
}

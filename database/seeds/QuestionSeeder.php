<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
    	
    	foreach (range(1,50) as $index) {
	        DB::table('questions')->insert([
	            'question' => $faker->text,
	            'points' => $faker->randomDigit,
	            'category_id' => App\QuestionCategory::all()->random()->id,
	            'exam_id' => App\Exam::all()->random()->id,
	        ]);
        }
    }
}

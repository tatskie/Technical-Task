<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$questions = App\Question::all();
    	$faker = Faker\Factory::create();

    	foreach ($questions as $question) {
            DB::table('options')->insert([
                'option' => $faker->text,
                'is_correct' => 1,
                'question_id' => $question->id,
            ]);

            DB::table('options')->insert([
                'option' => $faker->text,
                'is_correct' => 0,
                'question_id' => $question->id,
            ]);

            DB::table('options')->insert([
                'option' => $faker->text,
                'is_correct' => 0,
                'question_id' => $question->id,
            ]);

            DB::table('options')->insert([
                'option' => $faker->text,
                'is_correct' => 0,
                'question_id' => $question->id,
            ]);
    	}
            
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_categories')->insert([
            'category' => 'Technical',
        ]);

        DB::table('question_categories')->insert([
            'category' => 'Aptitude',
        ]);

        DB::table('question_categories')->insert([
            'category' => 'Logical',
        ]);
    }
}

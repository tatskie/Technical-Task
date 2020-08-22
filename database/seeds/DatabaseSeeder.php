<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(QuestionCategorySeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(OptionSeeder::class);
    }
}

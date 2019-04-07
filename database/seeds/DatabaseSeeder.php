<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeed::class);
        $this->call(ExaminerSeed::class);
        $this->call(UserSeed::class);
        $this->call(questionAnswerSeed::class);
        $this->call(courseSeed::class);
        $this->call(questionSeed::class);
    }
}

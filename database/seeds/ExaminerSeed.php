<?php

use App\Examiner;
use Illuminate\Database\Seeder;

class ExaminerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new Examiner)->getTable())->truncate();
        
                Examiner::insert([
                    [
                        'id'             => 1,
                        'name'           => 'Examiner 01',
                        'email'          => 'examiner@qiz.com',
                        'password'       => '$2y$10$asJAAnfDQezRhzS7132FCO49PHOriqevUTF7qSGr47WtQbt/x1sBm',
                        'remember_token' => '',
                    ],
                ]);
    }
}

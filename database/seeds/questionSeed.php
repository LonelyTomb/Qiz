<?php

use App\question;
use Illuminate\Database\Seeder;

class questionSeed extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table((new question)->getTable())->truncate();

		question::insert([
			[
				'id' => 1,
				'course_id' => '1',
				'question' => 'Define an industry',
			],
		]);

		question::insert([
			[
				'id' => 2,
				'course_id' => '1',
				'question' => 'List 4 types of costs(answer separated in commas)',
			],
		]);
		question::insert([
			[
				'id' => 3,
				'course_id' => '2',
				'question' => 'Define Supply',
			],
		]);
		question::insert([
			[
				'id' => 4,
				'course_id' => '2',
				'question' => 'Explain change in supply',
			],
		]);
	}
}

<?php

use App\course;
use Illuminate\Database\Seeder;

class courseSeed extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table((new course)->getTable())->truncate();

		course::insert([
			[

				'id' => 1,
				'examiner_id' => '1',
				'title' => 'Test 01',
				'number' => '2',
				'time' => '5',
			],
		]);
		course::insert([
			[

				'id' => 2,
				'examiner_id' => '1',
				'title' => 'Test 02',
				'number' => '2',
				'time' => '5',
			],
		]);
	}
}

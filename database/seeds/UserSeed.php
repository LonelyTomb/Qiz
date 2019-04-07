<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table((new User)->getTable())->truncate();

		User::insert([
			[
				'id' => 1,
				'name' => 'User',
				'email' => 'user@qiz.com',
				'password' => '$2y$10$asJAAnfDQezRhzS7132FCO49PHOriqevUTF7qSGr47WtQbt/x1sBm',
				'remember_token' => '',
			],
		]);
		User::insert([
			[
				'id' => 2,
				'name' => 'User 02',
				'email' => 'user02@qiz.com',
				'password' => '$2y$10$asJAAnfDQezRhzS7132FCO49PHOriqevUTF7qSGr47WtQbt/x1sBm',
				'remember_token' => '',
			],
		]);
	}
}

<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table((new Admin())->getTable())->truncate();

	    Admin::insert([
		    [
			    'id'             => 1,
			    'name'           => 'Admin',
			    'email'          => 'admin@qiz.com',
			    'password'       => '$2y$10$asJAAnfDQezRhzS7132FCO49PHOriqevUTF7qSGr47WtQbt/x1sBm',
			    'remember_token' => '',
		    ],
	    ]);
    }
}

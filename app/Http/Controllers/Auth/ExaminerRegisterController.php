<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Examiner;

class ExaminerRegisterController extends Controller
{
	public function index()
	{
		return view('examiner.register');
	}

	/**
	 * Get a validator for an incoming registration request.
	 * @param  Request $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]);
	}


	protected function create(Request $data)
	{
		if ($this->validator($data->all())) {
			Examiner::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => bcrypt($data['password']),
			]);
			return view('auth.examiner-login');
		}
		return view('examiner.register');
	}
}
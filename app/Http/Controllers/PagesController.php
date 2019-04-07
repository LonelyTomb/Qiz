<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function index()
	{
		return view('welcome');
	}

	public function register()
	{
		return view('welcome');
	}

	public function logIn()
	{
		$this->middleware('guest', ['except' => ['logout', 'userLogout']]);
		return view('auth.login');
	}
}

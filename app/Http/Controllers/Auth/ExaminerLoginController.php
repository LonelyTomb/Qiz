<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ExaminerLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:examiner', ['except' => ['logout']]);
	}

	public function showLoginForm()
	{
		return view('auth.examiner-login');
	}

	public function login(Request $request)
	{
		// Validate the form data
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);

		// Attempt to log the user in
		if (Auth::guard('examiner')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
			$examiner = DB::table('examiners')->where('email',$request->email)->first();
			session(['email' => $request->email]);
			session(['homeUrl'=>'/examiner']);
			session(['id'=>$examiner->id]);

			// if successful, then redirect to their intended location
			return redirect()->intended(route('examiner.home'));
		}

		// if unsuccessful, then redirect back to the login with the form data
		return redirect()->back()->withInput($request->only('email', 'remember'));
	}

	public function logout()
	{
		Auth::guard('examiner')->logout();
		return redirect('/');
	}
}

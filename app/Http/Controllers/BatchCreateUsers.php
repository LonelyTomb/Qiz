<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use App\User;

class BatchCreateUsers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:examiner');
    }

    public function index()
    {
        $template = Storage::url('public/users.xlsx');
        return view('examiner.uploadUsers',compact('template'));
    }

    public function usersTemplate()
    {
        return Storage::url('public/users.xlsx');
    }

    public function uploadUsers(Request $file)
    {
        $users = $this->parseFile($file);
        foreach ($users['collection'] as $key => $users) {
            DB::table('users')->insert(
                [
                    'name' => $users['name'],
                    'email' => $users['email'],
                    'password' => bcrypt($users['password'])
                ]
            );
        }
        return view('examiner.home');
    }

    public function exportUsers(){

		$users = DB::table('user')->get();

        (new FastExcel($users))->download('users.xlsx', function ($user) {
            return [
                'Name' => $user->name,
                'Email' => $user->email,
            ];
        });
    }
    /**
     * Process Uploaded Excel Sheet
     * @param Request $request
     * @return array
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
     */
    public function parseFile(Request $request)
    {
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $path = $request->file('file')->getRealPath();
                $collection = (new FastExcel)->import($path);
                // $pagination = new LengthAwarePaginator($collection,$collection->count(),5);
                return ['collection' => $collection];
            }
        }
    }
}

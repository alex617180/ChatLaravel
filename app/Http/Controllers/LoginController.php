<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public $account;
    public function __construct(Account $account)
	{
		$this->account = $account;
    }

    public function index()
    {
        return view('page.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],            
        ]);
        if(Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ])) return redirect('/');

        return redirect()->back()->with('status', 'Неправильный логин или пароль');
    }
}

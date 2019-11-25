<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public $user;
    public function __construct(Account $user)
	{
		$this->user = $user;		
	}

	public function index()
    {
        return view('profile');
    }

    public function edit(Request $request)
    {
        $name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$image = $_FILES['image'];
		
        if (!empty($name) || !empty($email) || !empty($image['name'])) {
            if (!empty($name) && $name != Auth::user()->name) {                
                $this->validate($request, [
                    'name' => ['required', 'string', 'max:20', 'min:3'],            
                ]);
                $this->user->updateNew(Auth::user()->id, ['name' => $name]);                           
                $request->session()->flash('status', 'Имя успешно обновлено');
            }
            if (!empty($email) && ($email != Auth::user()->email)) {
                $this->validate($request, [
                    'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],            
                ]);
                $this->user->updateNew(Auth::user()->id, ['email' => $email]);                
                $request->session()->flash('status', 'E-mail успешно изменён');
            }
            if (!empty($image['name'])) {
                $this->validate($request, [
                    'image' => ['image', 'max:2024'],            
                ]);                
                $imageName = $this->user->editImage($request, Auth::user()->image);                         
                $this->user->updateNew(Auth::user()->id, ['image' => $imageName]);
                $request->session()->flash('status', 'Картинка успешно обновлена');
            }
            return redirect('/profile'); 
        }
        return redirect('/profile');
    }

    public function editPassword(Request $request)
    {
        $password_current = trim($_POST['password_current']);
		$password = trim($_POST['password']);
        $password_confirmation = trim($_POST['password_confirmation']);
                
        if (!empty($password_current) && !empty($password) && !empty($password_confirmation)) {            
            if(Hash::check($password_current, Auth::user()->password)){
            $this->validate($request, [               
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'password_confirmation' => ['required', 'string'],
            ]);
            $this->user->updateNew(Auth::user()->id, ['password' => Hash::make($password)]);
            $request->session()->flash('status', 'Пароль успешно обновлен');
            }else{
            $request->session()->flash('status', 'Неверно указан старый пароль');
            return redirect('/profile');
            }
        }
        return redirect('/profile');
    }

	public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

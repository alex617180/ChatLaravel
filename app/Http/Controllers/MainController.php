<?php

namespace App\Http\Controllers;

use App\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public $main;
    public function __construct(Main $main)
    {
        $this->main = $main;
    }
    public function index()
    {       
        $comments = $this->main
            ->leftJoin('comments', 'comments.user_id', '=', 'users.id')
            ->where('skip', '=', 1)
            ->orderBy('comments.id', 'desc')
            ->paginate(5);
        return view('main', ['comments' => $comments]);
    }

    public function addComment(Request $request)
    {
        $this->validate($request, [
            'text' => ['required', 'string', 'max:200'],
        ]);
        $this->main->addComment(['text' => $_POST['text'], 'user_id' => Auth::user()->id, 'date' => date('Y-m-d')]);
        return redirect('/')->with('status', 'Комментарий успешно добавлен');
    }
}

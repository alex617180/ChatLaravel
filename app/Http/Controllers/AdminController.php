<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public $admin;
	public function __construct(Admin $admin)
	{
		$this->admin = $admin;
	}
	public function index()
	{
		$comments = $this->admin
			->leftJoin('comments', 'comments.user_id', '=', 'users.id')
			->orderBy('comments.id', 'desc')
			->paginate(5);
		return view('admin', ['comments' => $comments]);
	}
	public function edit()
	{
		if ($_POST) {
			if (isset($_POST['show']))
				$this->admin->showComment($_POST['show']);
			if (isset($_POST['skip']))
				$this->admin->skipComment($_POST['skip']);
			if (isset($_POST['del']))
				$this->admin->deleteComment($_POST['del']);
		}
		return redirect('/admin');
	}
}

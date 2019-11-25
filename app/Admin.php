<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    protected $table = 'users';
    
    public function showComment($id)
    {
        DB::table('comments')
        ->where('id', $id)
        ->update(['skip' => 0]);
    }

    public function skipComment($id)
    {
        DB::table('comments')
        ->where('id', $id)
        ->update(['skip' => 1]);
    }
    
    public function deleteComment($id)
    {
        DB::table('comments')->where('id', '=', $id)->delete();
    }
}

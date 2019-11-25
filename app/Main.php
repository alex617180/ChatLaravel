<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Main extends Model
{
    protected $fillable = ['text', 'date', 'user_id'];
    protected $table = 'users';

    public function author()
    {
        return $this->hasOne(Account::class);
    }

    public static function addComment($fields)
    {
        $comment = new static;
        $comment->table = 'comments';        
        $comment->fill($fields); 
        $comment->save();        
    }
}

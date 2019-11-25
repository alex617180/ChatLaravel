<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $table = 'users';

    public function editImage($request, $image)
    {
        if ($image != 'no-user.jpg')
        Storage::delete($image);

        $imageName = $request->image->store('/');
        return $imageName;
    }

    public function updateNew($id, $data)
    {
        DB::table('users')
              ->where('id', $id)
              ->update($data);
    }    
}

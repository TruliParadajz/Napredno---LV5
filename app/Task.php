<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function creator()
    {
        $user = DB::table('users')->where('id', $this->creator_id)->first();
        return $user;
    }



}






























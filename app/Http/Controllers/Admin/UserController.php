<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
       public function index(){
    	$users = User::where(['role' => User::USER])->get();
    	return view('admin.user.index',compact('users'));
    }
}
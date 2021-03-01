<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function index(){
    	$users = User::where(['role' => User::USER])->get();
    	return view('admin.user.index',compact('users'));
    }   

    public function block($id){
    	$user = User::find($id);
    	$user -> block = User::BLOCK;
    	$user -> save();
    	toastr()->success('usery arden block arvac e');
    	return Redirect::to(route('admin.user'));
    }

    public function unblock($id){
    	$user = User::find($id);
    	$user -> block = User::UNBLOCK;
    	$user -> save();
    	toastr()->success('usery arden unblock arvac e');
    	return Redirect::to(route('admin.user'));
    }
}
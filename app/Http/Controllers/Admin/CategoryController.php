<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;                                                                   


class CategoryController extends Controller
{
	public function index() {
		$categories = Category::all();
		return view('admin.category.index',compact('categories'));
    }	

    public function delete($id) {

    }	
    
    public function update() {
		// return view('admin.category.index',compact('categories'));
    }

   public function create() {
		return view('admin.category.create',);
    }   

    public function store(Request $request) {
    	
    }
}

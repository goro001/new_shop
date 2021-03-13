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
        $category = Category::find($id);
        $category ->delete();
         toastr()->success('jnjvec');
            return Redirect::to(route('admin.categories'));

    }	
    
    public function update($id) {
        $category = Category::find($id);
		return view('admin.category.edit',compact('category'));

    }

    public function create() {
		return view('admin.category.create',);
    }   

    public function store(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories',
        ]);
        if ($validator->fails())
        {
            toastr()->error('sxal');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $category = new Category();
            $category->name = $request->input('name');
            $category->save();
            toastr()->success('stexcvec');
            return Redirect::to(route('admin.categories'));
        }
    }

    public function edit(Request $request, $id){

    $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,'.$id,
        ]);
        if ($validator->fails())
        {
            toastr()->error('sxal');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $category = Category::find($id);
            $category->name = $request->input('name');
            $category->save();
            toastr()->success('tarmacvec');
            return Redirect::to(route('admin.categories'));
        }
    }
}

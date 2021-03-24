<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
	public function index(){
    	$products = Product::where('user_id', '<>', Auth::user()->id)->get();
        return view('user.home',compact('products'));
    }
    public function myshop(){
    	$id=Auth::id();
    	$products = Shop::where(['user_id' => $id])->get();
        return view('user.my_shop',compact('products'));
    }
    public function create(){
    	$categories = Category::all();
        return view('user.create',compact('categories'));
    }   

	public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string:max:255',
            'image' => 'required|file|mimes:jpeg,jpg,png,gif|max:10000',
            'category' => 'required|exists:categories,id',
            'price' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);
        if ($validator->fails())
        {
            toastr()->error('sxal');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $image = $request->file('image');
            $user_id = Auth::id();
            $product = new Product();
            $product->name = $request->input('name');
            $product->image = Storage::disk('public')->put('shop', $image);
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            $product->category_id = $request->input('category');
            $product->user_id = $user_id;
            $product->save();
            toastr()->success('stexcvec');
            return Redirect::to(route('my_product'));
        }
    }
    public function my_product(){
    	$id=Auth::id();
    	$products = Product::where(['user_id' => $id])->get();
        return view('user.my_product',compact('products'));
    }


    public function edit($id){
    	$user_id=Auth::id();
    	$product = Product::where(['user_id' => $user_id, 'id' =>$id])->first();
        $categories = Category::all();
        return view('user.edit',compact('product','categories'));

    	
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string:max:255',
            'image' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:10000',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1',
            'description' => 'required|string',
        ]);
        if ($validator->fails())
        {
            toastr()->error('sxal');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user_id = Auth::id();
            $product = Product::where(['user_id' => $user_id,'id' => $id])->first();
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            $product->category_id = $request->input('category');
            $product->user_id = $user_id;
            if ($request->has('image')) {
                $image = $request->file('image');
                $product->image = Storage::disk('public')->put('shop', $image);
            }
            $product->save();
            toastr()->success('tarmacvec');
            return Redirect::to(route('my-product'));
        }

    }

}
@extends('layouts.admin')

@section('content')
<style>
	.cat_ynd{
		background-color: red;
		border-radius: 10%;
	}
</style>

<div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-md-10">
    <div class="card">
     <div class="card-header d-flex ">
      category
     </div>
     <br>
		<a href="{{ route('admin.category.create') }}" class="btn btn-outline-primary ml-4">Create</a>
      @foreach($categories as $category)
       <div class="col-md-4 p-2">
        <div class="border rounded">
         {{$category->name}}
         <div >

           <a href="{{ route('admin.categories.delete',$category->id) }}" class="btn btn-outline-danger">delete</a>

           <a href="{{ route('admin.categories.update',$category->id) }}" class="btn btn-outline-warning">update</a>

         </div>
        </div>
       </div>
      @endforeach
     </div>
    </div>
   </div>
  </div>
 </div>
@endsection












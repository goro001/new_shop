@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-md-10">
    <div class="card">
     <div class="card-header d-flex ">
      User
     </div>
     <div class="card-body row">
      @foreach($users as $user)
       <div class="col-md-4 p-2">
        <div class="border rounded">
         {{$user->name}}
         <div >
          @if($user->block == \App\Models\User::BLOCK)
           <a href="{{ route('admin.user.unblock',$user->id) }}" class="btn btn-outline-success">UnBlock</a>
          @else
           <a href="{{ route('admin.user.block',$user->id) }}" class="btn btn-outline-danger">Block</a>
          @endif
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
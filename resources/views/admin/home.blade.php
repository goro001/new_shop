@extends('layouts.admin')

@section('content')
 <div class="container">
  <div class="row justify-content-center">
   <div class="col-md-8">
    <div class="card">
     <div class="card-header">{{ __('Dashboard') }}</div>
     <div class="card-body row">
      <div class="col-md-4 ">
       <span class="badge badge-success">USERS <a href="{{route('admin.user')}}">{{$users}}</a></span>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
@endsection

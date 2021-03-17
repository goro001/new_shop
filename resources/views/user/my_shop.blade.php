@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex ">
                        Shop
                    </div>
                    <div class="card-body row">
                        @foreach($products as $product)
                            <div class="col-md-3 p-2">
                                <div class="border rounded  p-2" >
                                    <div class="text-center">
                                        <img class="m-2" src="{{asset('storage/'.$product->image)}}" alt="" >
                                    </div>
                                    <h3 class="text-center">{{$product->product->name}}</h3>
                                    <p >Price {{$product->product->price}} Usd</p>
                                    <p >{{$product->product->description}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
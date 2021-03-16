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
                                    <h3 class="text-center">{{$product->name}}</h3>
                                    <p >Price {{$product->price}} Usd</p>
                                    <p >{{$product->description}}</p>
                                    <p ><button class="btn btn-outline-primary buyShop" data-id="{{ $product->id }}">Shop</button></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        $('.buyShop').click(function() {
            let id= $(this).data('id');
            var stripe = Stripe('pk_test_51IVckTGKtYPBIToUVDJ70turWLfDE7jK3swc4Hlax5qiC7kVzzLderkGVliXrnMR8Q8YKyU1bSk6UrVr2CEW6Nv5001Nd07ofU');
            $.ajax({
                url: '/payment',
                type: 'post',
                data:{id:id},
                headers: {
                    "X-CSRF-Token": $('meta[name=csrf-token]').attr('content')
                },
                success:function (r) {
                    if (r.status) {
                        return stripe.redirectToCheckout({ sessionId: r.id });
                    } else {
                        alert(r.data.id[0])
                    }
                }
            })
        });
    </script>

@endsection

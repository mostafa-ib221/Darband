@extends('layouts.home.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('home/css/confirmation.css') }}" />
@endsection

@section('content')
    <section class="order-section">
        <div class="container-fluid">
            <div class="row">
                <img src="{{ asset('home/img/confirmation.png') }}" alt="" class="d-table mx-auto resonsive-image">
                <div class="col-md-12">
                    <p class="order-title text-center pt-5">Order Confirmation</p>
                </div>
                <div class="col-md-12">
                    <p class="order-desc text-center">Your order has been placed successfully.</p>
                </div>
                <div class="col-md-12">
                    <p class="order-desc text-center">Your order number is <span class="order-span">{{ $order_no }}</span> </p>
                </div>
            </div>
        </div>
    </section>
@endsection

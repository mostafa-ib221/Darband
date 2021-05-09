@php($contacts = App\Models\Contact::getAllInArray())
@php($title = 'Not Found')
@php($headerBlack = true)
@extends('layouts.home.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('home/css/404.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/black_header.css') }}" />
@endsection

@section('content')
    <div class="container-fluid pt-style">
        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('home/img/404.png') }}" alt="" class="d-table mx-auto img-res">
            </div>
            <div class="col-md-12">
                <p class="title">Lorem Ipsum is simply dummy text</p>
                <p class="desc">Lorem Ipsum is simply dummy text of the printing andLorem Ipsum is simply dummy text of the printing and</p>
            </div>
        </div>
    </div>
@endsection

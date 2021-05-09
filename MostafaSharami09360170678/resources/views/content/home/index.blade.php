<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/font.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/index.css?catch=' . md5(date('H:m:i'))) }}" />
    <link rel="stylesheet" href="{{ asset('home/css/swiper.min.css') }}" />
    <script src="{{ asset('home/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
    <title>Darband Restaurant: Home Page</title>
</head>

<body>

<!-- SECTION1---------------------------------------------- -->
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12 padding-style">
                <div class="col-md-2 mx-auto"><img src="{{ asset('home/img/header/logo1.png') }}" alt="logo" width="100%" class="respons-logo"></div>

            </div>
            <div class="col-12 col-md-4 text-right text-section">
                <a href="{{ url('menu') }}" class="text-section1">Menu</a>
            </div>
            <div class="col-12 col-md-4 text-center pl-section text-section">
                <a href="{{ url('explore') }}" class="text-section1 ">Explore</a>
            </div>
            <div class="col-12 col-md-4 text-center text-section">
                <a href="{{ url('order') }}" class="text-section1 ">Pre Order Kale Pache</a>
            </div>
            {{--<div class="col-12 col-md-4 text-section">
                <a href="{{ url('catering') }}" class="text-section1">Catering</a>
            </div>--}}
            <div class="col-md-12 padding-style1">
                <div class="row rw-respons">
                    <div class="col-2 col-md-3">
                        <img src="{{ asset('home/img/Icon material-location-on.png') }}" alt="location" width="7%" class="d-table ml-auto location">
                    </div>
                    <div class="col-10 col-md-9">
                        <p class="p-section1">{{ $contacts['address'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pb-3">
                <div class="row justify-content-center ">
                    <div class="col-7 col-md-6 ">
                        <div class="row justify-content-center">
                            <div class="col-3 col-md-7">
                                <img src="{{ asset('home/img/date.svg') }}" alt="date" width="10%" class="d-table ml-auto date">
                            </div>
                            <div class=" col-7 col-md-5 px-0">
                                <p class="p-section1">{{ $contacts['open_day_from'] }} to {{ $contacts['open_day_to'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-6 pl-0">
                        <p class="p-section1">{{ $contacts['open_time_from'] }} <span class="span-text">-</span> {{ $contacts['open_time_to'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ./SECTION1--------------------------------------------- -->
</body>

</html>

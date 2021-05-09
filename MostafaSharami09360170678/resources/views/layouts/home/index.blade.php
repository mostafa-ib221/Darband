<!DOCTYPE html>home/css/font.css
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('home/css/font.css') }}" />

        @php($isBlack = isset($headerBlack) && $headerBlack)
        {{--@php($headerCss = $isBlack ? 'header_black.css' : 'header.css')
        <link rel="stylesheet" href="{{ asset('home/css/' . $headerCss . '?catch=' . md5(date('H:m:i'))) }}">--}}
        <link rel="stylesheet" href="{{ asset('home/css/header.css?catch=' . md5(date('H:m:i'))) }}">
      @if($isBlack)
        <link rel="stylesheet" href="{{ asset('home/css/black_header.css?catch=' . md5(date('H:m:i'))) }}">
      @endif
        <link rel="stylesheet" href="{{ asset('home/css/footer.css?catch=' . md5(date('H:m:i'))) }}">

        <style>
            .hidden {display: none !important;}
            .basket-close-item {cursor: pointer;}
            .hand {cursor: pointer !important;}
        </style>
        @yield('css')
        @yield('js_head')

        <link rel="stylesheet" href="{{ asset('home/css/swiper.min.css?catch=' . md5(date('H:m:i'))) }}" />

        @php($pageTitle = isset($title) ? ': '.$title : '')
        <title>Darband Restaurant{{ $pageTitle }}</title>
    </head>

    <body>
    <!-- header-------------------------------------------------------------------- -->
    <!-- respons menu-------------------------------------------------------------- -->
    <div class="menu-collapsed head-main d-block d-sm-block d-md-block d-lg-none header-respons-style background-style" id="menu-toggle-responsive ">
        <div class="col-12 ">
                <div class="col-3 menu-icon mt-3 " onclick="console.log('menu')">
                    <div class=" bar mt-1  "></div>
                </div>

                <div class="col-5 logo-style ml-auto">
                    <a href="{{ url('/') }}"><img src="{{ asset('home/img/header/logo.png') }}" alt="" width="50%" class="d-table ml-auto logo-menu pl-2"></a>
                </div>


        </div>

        <nav>
            <ul>
                <li class="li-responsive-menu">
                    <a href="{{ url('/') }}"><img src="{{ asset('home/img/header/logo1.png') }}" alt="" width="20%" class="d-table mx-auto logo-menu"></a>
                </li>
                <li><a href="{{ url('/explore') }}">Explore</a></li>
                <li><a href="{{ url('/menu') }}">Menu</a></li>
                <li><a href="{{ url('/order') }}">Order Kale Pache</a></li>
                <li><a href="{{ url('/catering') }}">Catering</a></li>
                {{--<li><a href="{{ url('/checkout') }}">Basket</a></li>--}}
                <div class="col-12 pt-5">
                    <div class="row">
                        <div class="col-2 col-md-3">
                            <img src="{{ asset('home/img/header/Icon material-location-on.png') }}" alt=" " width="60% " class="d-table ml-auto location">
                        </div>
                        <div class="col-10 col-md-8">
                            <p class="address-text ">879 York Mills Rd, North York, ON M3B 1Y5, Canada</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pb-5">
                    <div class="row justify-content-center ">
                        <div class="col-7 col-md-6 ">
                            <div class="row justify-content-center">
                                <div class="col-3 col-md-7">
                                    <img src="http://www.darband.ca/MostafaSharami09360170678/resources/assets/home/img/date.svg" alt="date" width="100%" class="d-table ml-auto date">
                                </div>
                                <div class=" col-7 col-md-5 px-0">
                                    <p class="p-section1">Monday to Sunday</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-md-6 pl-0">
                            <p class="p-section1">11 AM <span class="span-text">-</span> 10 PM</p>
                        </div>
                    </div>

                </div>
            </ul>
        </nav>

    </div>
    <div class="d-block d-sm-block d-md-block d-lg-none">
      @if(!isset($checkout))
        <div class="col-3" id="image-badge">
            <img src="{{ asset('home/img/header/Icon ionic-md-cart.png') }}" alt="" width="50%" class="image-badge">
            <span class="badge basket-count-all"></span>
        </div>
      @endif
        <div class="row rw rw-hide">
            <hr class="my-0">
            <div class="col-md-12">
                <div class="menu-border-sub border-menu">
                    <div class="border-style-basket" id="basket-rows-mobil">
                        <div class="col-md-12 border-bottom-style-basket">
                            <div class="row row-close-menu">
                                <div class="col-3 col-md-3">
                                    <img src="{{ asset('home/img/header/headerimage.png') }}" alt="" class="header-image">
                                </div>
                                <div class="col-3 col-md-3 d-table my-auto px-0">
                                    <p class="basket-title">kale pache</p>
                                </div>
                                <div class="col-1 col-md-2 d-table my-auto">
                                    <p class="basket-desc">X2</p>
                                </div>
                                <div class="col-3 col-md-3 d-table my-auto">
                                    <p class="number-style-header">$19.99s</p>
                                </div>
                                <div class="col-1 col-md-1 d-table my-auto" id="close-menu">
                                    <img src="{{ asset('home/img/header/Icon ionic-ios-close-circle-outline.png') }}" alt="" width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 border-bottom-style-basket">
                            <div class="row">
                                <div class="col-3 col-md-3 d-table my-auto">
                                    <img src="{{ asset('home/img/header/headerimage.png') }}" alt="" class="header-image">
                                </div>
                                <div class="col-3 col-md-3 d-table my-auto px-0">
                                    <p class="basket-title">kale pache</p>
                                </div>
                                <div class="col-1 col-md-2 d-table my-auto">
                                    <p class="basket-desc">X2</p>
                                </div>
                                <div class="col-3 col-md-3 d-table my-auto">
                                    <p class="number-style-header">$19.99s</p>
                                </div>
                                <div class="col-1 col-md-1 d-table my-auto">
                                    <img src="{{ asset('home/img/header/Icon ionic-ios-close-circle-outline.png') }}" alt="" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-12">
                            <textarea id="w3review1" class="comment-mobil" name="w3review" rows="3" cols="50" placeholder="Add a note"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 px-0">
                        <a href="#" class="a-style-menu" onclick="GoToCheckout('mobil')">
                            <div class="check1">
                                <div class="row px-3">
                                    <div class="col-3 col-md-2 d-table my-auto">
                                        <p class="number-food basket-count-all"></p>
                                    </div>
                                    <div class=" col-4 col-md-6 d-table my-auto">
                                        <p class="check-basket">Checkout </p>
                                    </div>
                                    <div class="col-4 col-md-4  d-table my-auto">
                                        <p class="price-basket basket-price-all"></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ./responsive menu----------------------------------------------------------- -->
    <!-- desktop-menu---------------------------------------------------------------- -->
    <nav class="col-md-12 head-main navbar navbar-expand-lg navbar-light bg-light d-none d-sm-none d-md-none d-lg-block">
        <div class="row @if(!$isBlack) header-respons-style @endif">
            <div class="col-md-2 ">
                <a class="navbar-brand" href="#"><img src="{{ asset('home/img/header/'. ($isBlack ? 'logo_white.png' : 'logo.png')) }}" alt="" width="35%" class="d-table mx-auto"></a>
            </div>
            <div class="col-md-10 collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active pr-3">
                        <a class="nav-link" href="{{ url('explore') }}">Explore <span class="sr-only">(current)</span></a>
                    </li>
                    {{--<li class="nav-item pr-3" data-title="{{ $title }}">
                        @php($url = ($title !== 'Explore') ? url('/explore') : '#about')
                        <a class="nav-link" href="{{ $url }}">About Us</a>
                    </li>--}}
                    <li class="nav-item pr-3">
                        <a class="nav-link" href="{{ url('/menu') }}">Menu</a>
                    </li>
                    <li class="nav-item pr-3">
                        <a class="nav-link" href="{{ url('/order') }}">Order Kale Pache</a>
                    </li>
                    <li class="nav-item pr-3">
                        <a class="nav-link" href="{{url('/catering') }}">Catering</a>
                    </li>
                  @if(!isset($checkout))
                    <li class="col-md-5 nav-item pr-3 dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a class="nav-link basket-li" href="#">
                            <img src="{{ asset('home/img/' . ($isBlack ? 'basket_white.png' : 'basket_black.png')) }}" alt="" width="5%" class="image-badge">
                            <span class="badge basket-count-all"></span>
                        </a>
                        <div class="col-md-12 dropdown-menu" aria-labelledby="dropdownMenu2">
                            <div class="menu-border-sub border-menu">
                                <div class="border-style-basket" id="basket-rows-desktop">
                                    <div class="col-md-12 border-bottom-style-basket">
                                        <div class="row">
                                            <div class="col-md-3 d-table my-auto">
                                                <img src="{{ asset('home/img/header/headerimage.png') }}" alt="" class="header-image"  width="100%">
                                            </div>
                                            <div class="col-md-3 d-table my-auto">
                                                <p class="basket-title">kale pache</p>
                                            </div>
                                            <div class="col-md-1 d-table my-auto">
                                                <p class="basket-desc">X2</p>
                                            </div>
                                            <div class="col-md-3 d-table my-auto">
                                                <p class="number-style-header">$19.99s</p>
                                            </div>
                                            <div class="col-md-2 d-table my-auto">
                                                <img src="{{ asset('home/img/header/Icon ionic-ios-close-circle-outline.png') }}" alt="" width="60%" class="d-table mx-auto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom-style-basket basket-item-358">
                                        <div class="row row-close-menu">
                                            <div class="col-md-3">
                                                <img src="{{ asset('home/img/header/headerimage.png') }}" alt="" class="header-image" width="100%">
                                            </div>
                                            <div class="col-md-3 d-table my-auto">
                                                <p class="basket-title">kale pache</p>
                                            </div>
                                            <div class="col-md-1 d-table my-auto">
                                                <p class="basket-desc">X2</p>
                                            </div>
                                            <div class="col-md-3 d-table my-auto">
                                                <p class="number-style-header">$19.99s</p>
                                            </div>
                                            <div class="col-md-2 d-table my-auto basket-close-item" data-number="358">
                                                <img src="{{ asset('home/img/header/Icon ionic-ios-close-circle-outline.png') }}" alt="" width="60%" class="d-table mx-auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <textarea id="w3review1" class="comment-desktop" name="w3review" rows="3" cols="50" placeholder="Add a note"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 px-0">
                                    <a href="#" class="a-style-menu sajjad" onclick="GoToCheckout('desktop')">
                                        <div class="check1">
                                            <div class="row px-3">
                                                <div class="col-md-2 d-table my-auto">
                                                    <p class="number-food basket-count-all"></p>
                                                </div>
                                                <div class="col-md-6 d-table my-auto">
                                                    <p class="check-basket">Checkout </p>
                                                </div>
                                                <di class="col-md-4  d-table my-auto">
                                                    <p class="price-basket basket-price-all"></p>
                                                </di>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                  @endif
                </ul>

            </div>

        </div>

    </nav>
    <!-- ./desktop-menu---------------------------------------------------------------- -->
    <!-- ./header------------------------------------------------------------------ -->
        @yield('content')
        <!-- footer------------------------------------------------------------------- -->
        <section class="footer-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-7">
                        <img src="{{ asset('home/img/footer/logo.png') }}" alt="logo" width="13%" class="pl-4 logo-1">
                    </div>
                    <div class=" col-12 col-md-6  col-lg-4 padding-responsive">
                        <div class="contact">
                            <div class="col-md-12">
                                <div class="row pb-2">
                                    <div class="col-2 col-md-2 px-0"><img src="{{ asset('home/img/footer/blue-address.png') }}" alt=" " width="20% " class="d-table ml-auto location"></div>
                                    <div class="col-9 col-md-10 ">
                                        <p class="address-text ">879 York Mills Rd, North York, ON M3B 1Y5, Canada</p>
                                    </div>
                                </div>
                                <div class="row  respons-padding ">
                                    <div class="col-2 col-md-2 px-0 d-table my-auto"><img src="{{ asset('home/img/footer/Icon awesome-phone-alt.png') }}" alt=" " width="20% " class="d-table ml-auto phone"></div>
                                    <div class="col-9 col-md-10 ">
                                        <p class="address-text pt-2">+1 416-445-1777</p>
                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <div class="col-md-12 px-5">
                                            <p class="title-input">
                                                Newsletter
                                                <strong id="NewsLetterMsg" class="text-success pl-3 hidden" style="font-size: 0.7em;">Invalid email, please check another one!</strong>
                                            </p>
                                        </div>
                                        <form id="SendNewsLetter" class="input-group mb-3 px-5">
                                            <input type="email" id="NewsLetter" class="form-control input-style footer-email" placeholder="Email Address" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <img src="{{ asset('home/img/footer/noun_Email_1298932.png') }}" alt="" class="img-input" width="10%">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit" {{--onclick="SendNewsLetter()"--}}><img src="{{ asset('home/img/footer/arrowicon.png') }}" alt="" width="50%"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-8 col-12 col-repons-padding pl-5">
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3 col-3 px-2">
                                                    <a href="#" class="image-a"> <img src="{{ asset('home/img/footer/instagaram.png') }}" alt="" width="80%" class="d-table mx-auto"></a>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-3 px-2">
                                                    <a href="#" class="image-a"> <img src="{{ asset('home/img/footer/facebok.png') }}" alt="" width="80%" class="d-table mx-auto"></a>
                                                </div>
                                                <div class="col-md-3 col-lg-3  col-3  px-2">
                                                    <a href="#" class="image-a"><img src="{{ asset('home/img/footer/twitter.png') }}" alt="" width="80%" class="d-table mx-auto"></a>
                                                </div>
                                                <div class="col-md-3 col-lg-3  col-3  px-2">
                                                    <a href="#" class="image-a"><img src="{{ asset('home/img/footer/youtube.png') }}" alt="" width="80%" class="d-table mx-auto"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="copy-right-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <p class="copy-right pt-3">© 2020 Darband. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./footer------------------------------------------------------------------ -->
        <script src="{{ asset('home/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('home/js/swiper.min.js') }}"></script>
        {{--<script src="{{ asset('home/js/menu.js') }}"></script>--}}
        <script src="{{ asset('home/js/header.js?catch=' . md5(date('H:m:i'))) }}"></script>
        @yield('js')
        @yield('modal')

        <div class="hidden" id="basket-rows-sample">
            <div id="basket-row-desktop-sample">
                <div class="col-md-12 border-bottom-style-basket basket-item-BID">
                    <div class="row row-close-menu">
                        <div class="col-md-3">
                            <img src="BPIC" alt="" class="header-image" width="100%">
                        </div>
                        <div class="col-md-3 d-table my-auto">
                            <p class="basket-title">BNAME</p>
                        </div>
                        <div class="col-md-1 d-table my-auto">
                            <p class="basket-desc">XBNO</p>
                        </div>
                        <div class="col-md-3 d-table my-auto">
                            <p class="number-style-header">$BPRICE</p>
                        </div>
                        <div class="col-md-2 d-table my-auto basket-close-item" data-number="BID" data-pass="">
                            <img src="{{ asset('home/img/header/Icon ionic-ios-close-circle-outline.png') }}" alt="" width="60%" class="d-table mx-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div id="basket-row-mobil-sample">
                <div class="col-md-12 border-bottom-style-basket basket-item-BID-mobil">
                    <div class="row row-close-menu">
                        <div class="col-3 col-md-3">
                            <img src="BPIC" alt="" class="header-image">
                        </div>
                        <div class="col-3 col-md-3 d-table my-auto px-0">
                            <p class="basket-title">BNAME</p>
                        </div>
                        <div class="col-1 col-md-2 d-table my-auto">
                            <p class="basket-desc">XBNO</p>
                        </div>
                        <div class="col-3 col-md-3 d-table my-auto">
                            <p class="number-style-header">$BPRICE</p>
                        </div>
                        <div class="col-1 col-md-1 d-table my-auto basket-close-item px-0" data-number="BID" data-pass="-mobil">
                            <img src="{{ asset('home/img/header/Icon ionic-ios-close-circle-outline.png') }}" alt="" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
      {{--@if(!isset($checkout))--}}
        <script>
            var url = "{{ url('/basket') }}/";
            $(document).ready(function() {
                $.ajax({
                    type: 'POST',
                    url: url + "get",
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    dataType: "json",
                    success: function(res) {
                        console.log(res);
                        if(res.status) fillBasket(res.data);
                    }
                });
            });

            function fillBasket(data) {
                var rowsMobil = '';
                var rowsDesktop = '';
                $(".order-no").attr("placeholder", 0);
                if(data !== null) {
                    $(".basket-count-all").html(data.no);
                    var priceAll = parseFloat(data.priceAll);
                    $(".basket-price-all").html("$" + priceAll.toFixed(2));

                    $.each(data.items, function (id, val) {
                        // console.log('id: ' + id + ' | val: ' + JSON.stringify(val));
                        var dRow = $("#basket-row-desktop-sample").html();
                        dRow = dRow.split("BID").join(id);
                        dRow = dRow.replace("BPIC", val.pic);
                        dRow = dRow.replace("BNAME", val.name);
                        dRow = dRow.replace("BNO", val.no);
                        dRow = dRow.replace("BPRICE", parseFloat(val.price).toFixed(2));
                        rowsDesktop += dRow;

                        var mRow = $("#basket-row-mobil-sample").html();
                        mRow = mRow.split("BID").join(id);
                        mRow = mRow.replace("BPIC", val.pic);
                        mRow = mRow.replace("BNAME", val.name);
                        mRow = mRow.replace("BNO", val.no);
                        mRow = mRow.replace("BPRICE", parseFloat(val.price).toFixed(2));
                        rowsMobil += mRow;

                        var OrderNo = $("#order-no-" + id);
                        if (OrderNo.attr("placeholder") !== undefined) OrderNo.attr("placeholder", val.no);
                        OrderNo = $("#order-no-" + id + "p");
                        if (OrderNo.attr("placeholder") !== undefined) OrderNo.attr("placeholder", val.no);
                        OrderNo = $("#order-no-" + id + "m");
                        if (OrderNo.attr("placeholder") !== undefined) OrderNo.attr("placeholder", val.no);
                        OrderNo = $(".kp-no");
                        if (OrderNo.attr("placeholder") !== undefined) OrderNo.attr("placeholder", val.no);
                        // $("#order-no-8").attr("placeholder");
                    });
                    $.each(data.options.items, function (id, val) {
                        var dRow = $("#basket-row-desktop-sample").html();
                        dRow = dRow.split("BID").join(id + "_opt");
                        dRow = dRow.replace("BPIC", val.pic);
                        dRow = dRow.replace("BNAME", val.name);
                        dRow = dRow.replace("BNO", val.no);
                        dRow = dRow.replace("BPRICE", parseFloat(val.price).toFixed(2));
                        rowsDesktop += dRow;

                        var mRow = $("#basket-row-mobil-sample").html();
                        mRow = mRow.split("BID").join(id + "_opt");
                        mRow = mRow.replace("BPIC", val.pic);
                        mRow = mRow.replace("BNAME", val.name);
                        mRow = mRow.replace("BNO", val.no);
                        mRow = mRow.replace("BPRICE", parseFloat(val.price).toFixed(2));
                        rowsMobil += mRow;
                    });
                } else {
                    $(".basket-count-all").html(0);
                    $(".basket-price-all").html("$0");
                }
                $("#basket-rows-desktop").html(rowsDesktop);
                $("#basket-rows-mobil").html(rowsMobil);
                if(data !== null) {
                    console.log(data.hasOwnProperty('comment'));
                    console.log(data.comment);
                    $(".comment-mobil").val(data.comment);
                    $(".comment-desktop").val(data.comment);
                }
                console.log("\n\nEND FILL\n=======================================\n\n");
            }


            $(".basket-close-item").on("click", function() {basketCloseItem($(this).data('number'), $(this).data('pass'));});
            $('div#basket-rows-desktop').delegate('div.basket-close-item', 'click', function() {basketCloseItem($(this).data('number'), $(this).data('pass'));});
            $('div#basket-rows-mobil').delegate('div.basket-close-item', 'click', function() {basketCloseItem($(this).data('number'), $(this).data('pass'));});
            function basketCloseItem(no, pass) {
                $.ajax({
                    type: 'POST',
                    url: url + "del",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        id: no
                    },
                    dataType: "json",
                    success: function(res) {
                        console.log(res);
                        var item = $(".basket-item-" + no + pass);
                        item.remove();
                        if(res.status) fillBasket(res.data.basket);
                        /*console.log("=============================");
                        console.log(no);
                        console.log(typeof no);*/
                        //console.log("basket_items: " + $("#basket_items").html());
                        var basket_items = $("#basket_items").html();
                        /*console.log("[" + basket_items + "]");
                        console.log(basket_items !== undefined);
                        console.log(basket_items === "");
                        console.log(basket_items.indexOf("Icon ionic-ios-close-circle-outline.png"));*/
                        //if((basket_items !== undefined) && (basket_items.indexOf("Icon ionic-ios-close-circle-outline.png") < 0)) window.location = "{{ url('order') }}";
                        if((basket_items !== undefined) && (basket_items.indexOf("Icon ionic-ios-close-circle-outline.png") < 0)) $("#emptyBasketModal").modal("show");
                        /*if(typeof no === 'string') {
                            no = no.split('_')[0];
                            $("#kp-option-" + no).html(0);
                        }*/
                        if(pass === '') {
                            $("#kp-option-" + no).html(0);
                        }
                    }
                });
            }


            function add(id) {
                $.ajax({
                    type: 'POST',
                    url: url + "plus",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id,
                        'plus' : 1
                    },
                    dataType: "json",
                    success: function(res) {
                        console.log(res);
                        if(res.status) fillBasket(res.data.basket);
                    }
                });
            }
            function minus(id) {
                $.ajax({
                    type: 'POST',
                    url: url + "minus",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id,
                        'minus' : 1
                    },
                    dataType: "json",
                    success: function(res) {
                        console.log(res);
                        if(res.status) fillBasket(res.data.basket);
                        // $("#order-no-" + id).attr("placeholder", res.data.no);
                    }
                });
            }


            function addOption(id) {
                // console.clear();
                // console.log('addOption | id: ' + id);
                $.ajax({
                    type: 'POST',
                    url: url + "options",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id,
                        'plus' : 1
                    },
                    dataType: "json",
                    success: function(res) {
                        console.log(res);
                        if(res.status) fillBasket(res.data.basket);
                        $("#kp-option-" + id).html(res.data.no);
                    }
                });
            }
            function addExtra(eId, kpId) {
                // console.clear();
                // console.log('addOption | eId: ' + eId + ' ; kpId: ' + kpId);
                $.ajax({
                    type: 'POST',
                    url: url + "extras",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'eId': eId,
                        'kpId': kpId,
                        'plus' : 1
                    },
                    dataType: "json",
                    success: function(res) {
                        console.log(res);
                        if(res.status) fillBasket(res.data.basket);
                        $("#kp-extra-" + eId).html(res.data.no);
                    }
                });
            }

            function GoToCheckout(comment) {
                comment = ".comment-" + comment;
                comment = $(comment).val();
                $.ajax({
                    type: 'POST',
                    url: url + "comment",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'comment': comment,
                    },
                    dataType: "json",
                    success: function(res) {
                        console.log(res);
                        if(res.status) {
                            fillBasket(res.data.basket);
                            window.location = "{{ url('checkout') }}";
                        }
                    }
                });
            }

            function SendNewsLetter() {
                //
            }

            $("#SendNewsLetter").on("submit", function () {
                // alert("submit SendNewsLetter");
                $("#NewsLetterMsg")
                    .removeClass("hidden")
                    .removeClass("text-danger")
                    .removeClass("text-success")
                    .html("");
                $.ajax({
                    url: "{{ route('news-letter.store') }}",
                    type: "POST",
                    data: {email:$("#NewsLetter").val(), _token:"{{ csrf_token() }}"},
                    success:function (data) {
                        console.clear();
                        console.log('success');
                        console.log(data);
                        $("#NewsLetterMsg")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .html("Yor email saved...")
                            .removeClass("hidden");
                    },
                    error:function (exp) {
                        console.clear();
                        console.log('error');
                        console.log(exp);
                        console.log(exp.responseJSON.message);
                        $("#NewsLetterMsg")
                            .removeClass("text-success")
                            .addClass("text-danger")
                            .html("Invalid email, please check another one!")
                            .removeClass("hidden");
                    },
                });
                return false;
            });
        </script>
      {{--@endif--}}
    </body>
</html>

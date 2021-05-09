@extends('layouts.home.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('home/css/order.css') }}" />
@endsection

@section('content')
    @include('content.home.order.header')
    @include('content.home.order.popular')
    @include('content.home.order.menu')
    <br />
@endsection

@section('js')
    <script>
        var TopScroll = $("{{ $isPc ? '#kp_menu_desktop' : '#kp_menu_mobile' }}").offset().top;
        // TopScroll -=  (TopScroll / 100 * 3.5)
        if($isPc == '#kp_menu_desktop') {
            TopScroll -= $("nav").height();
        } else {
            var nav = $(".menu-collapsed ").height();
            //TopScroll -= nav + (nav / 100 * 4.28);
            //TopScroll -= nav + (nav / 100 * 4.3);
            TopScroll -= nav;
        }
        function scrolltomenue() {
            $('html, body').animate({
                scrollTop: $("{{ $isPc ? '#kp_menu_desktop' : '#kp_menu_mobile' }}").offset().top
            }, 800);
        }
    </script>
    <script>
        $extends = [];
        $(document).ready(function () {
            var swiper1 = new Swiper('.swiper-container1 ', {
                slidesPerView: 4,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination1 ',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next ',
                    prevEl: '.swiper-button-prev ',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 40,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                }
            });
            var swiper2 = new Swiper('.swiper-container2', {
                slidesPerView: 1,
                spaceBetween: 10,
                // init: false,
                pagination: {
                    el: '.swiper-pagination2',
                    clickable: true,
                },
                breakpoints: {
                    300: {
                        slidesPerView: 2,
                        spaceBetween: 5,
                    },
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                    1024: {
                        slidesPerView: 5,
                        spaceBetween: 50,
                    },
                }
            });


            $('.tab-body').removeClass('active');
            $('#tab-body-Main-2').addClass('active');
            $('#tab-body-Main').addClass('active');
        });

        add = function(elem) {
            var $main = $(elem).prev();
            var val = $main.val().length ? $main.val() : 0;
            val++;
            $main.val(val);
        };
        minus = function(elem) {
            var $main = $(elem).next();
            var val = $main.val();
            if (!val.length || val <= 0) return;
            val--;
            $main.val(val);
        }

        /*$('.buy').live('click',  function() {
            console.log('buy click');
            var id = "#" + $(this).attr("data-number");
            console.log('id: ' + id);
            if ($(id).hasClass('btn-class')) {
                $(id).removeClass('btn-class');
                $(id).addClass('btn-class1');
            } else {
                $(id).removeClass('btn-class1');
                $(id).addClass('btn-class');
            }
        });*/
        $('body').delegate('.buy' , 'click' , function(){
            console.log('buy click');
            var id = "#" + $(this).attr("data-number");
            console.log('id: ' + id);
            if ($(id).hasClass('btn-class')) {
                $(id).removeClass('btn-class');
                $(id).addClass('btn-class1');
            } else {
                $(id).removeClass('btn-class1');
                $(id).addClass('btn-class');
            }
        });

        $('.tab-header').click(function () {
            console.log('start tab');
            $('.tab-body').removeClass('active');
            var id = '#tab-body-' + $(this).attr("data-id");
            console.log(id);
            $(id).addClass('active');
        });

        function OrderModal(id) {
            var extrasRows = $("#extras-rows");
            extrasRows.html("");
            var rows = "";
            var extras = {};
            if($extends.hasOwnProperty(id)) {
                extras = $extends[id];
            } else {
                extras = JSON.parse($("#extras-" + id).val());
                $extends[id] = extras;
            }
            console.clear();
            console.log(extras);
            $.each(extras, function(index, extra) {
                var row = $("#extras-rows-sample").html();
                row = row.replace("eTit", extra.title);
                row = row.replace("ePrc", extra.price);
                row = row.split("eId").join(extra.id);
                row = row.replace("eNo", extra.inBasket);
                row = row.replace("kpId", id);
                rows += row;
            });
            extrasRows.html(rows);
            $("#kp-pic").attr("src", $("#kp-pic-"+id).attr("src"));
            $("#kp-des").html($("#kp-des-"+id).html());
            $(".kp-add").attr("onclick", "add("+id+")");
            $(".kp-minus").attr("onclick", "minus("+id+")");
            $(".kp-no").attr("placeholder", $("#order-no-"+id).attr("placeholder"));
            $("#OrderModal").modal("show");
        }
    </script>
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="OrderModal" tabindex="-1" role="dialog" aria-labelledby="OrderModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('home/img/header/Icon ionic-ios-close-circle-outline.png') }}" alt=""
                                                      width="3%" class="d-table ml-auto"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 px-0 ">
                        <div class="border-style-1 ">
                            <div class="row ">
                                <div class="col-4 col-md-4">
                                    <img id="kp-pic" src="{{ asset('home/img/tmp/a0nztmhz.png') }} " alt=" " width="100% ">
                                </div>
                                <di class="col-8 col-md-8 ">
                                    <div class="col-8 col-md-8 pt-3 ">
                                        <p class="text-menu" id="kp-des"> Marinated charbroiled boneless breast of chicken Marinated charbroiled boneless breast of chicken Marinated charbroiled boneless breast of chicken Marinated charbroiled boneless breast of chicken
                                        </p>
                                    </div>
                                    <div class="col-7 col-md-7 d-table ml-auto">
                                        <div class="row justify-content-end">
                                            <div class="d-table my-auto btn-mp">
                                                <p class="mb-0 check btn-class my-auto" id="checkOrderModal"><button id="qButtonMinus" class="kp-minus" onclick="minus(this)">-</button>
                                                    <input type="text" name="quantity" style="width:30px;" class="value kp-no" placeholder="0"> <button class="kp-add" onclick="add(this)" id="qButtonAdd">+</button>
                                                </p>
                                            </div>
                                            <div class="">
                                                <img src="{{ asset('home/img/basket.png') }}" width="60%" class="image-basket1 d-table ml-auto buy" data-number="checkOrderModal">
                                            </div>
                                        </div>
                                    </div>
                                </di>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <p class="title-option ">Options</p>
                                </div>
                                <div class="col-6 col-md-6 d-none d-sm-block d-md-block d-lg-block">
                                    <p class="title-option ">Extras</p>
                                </div>
                                <div class="col-12 col-md-6 ">
                                    @foreach($options as $option)
                                        <div class="row border-between">
                                            <div class="col-5 col-md-9 ">
                                                <p class="desc-option ">{{ $option->title }}</p>
                                            </div>
                                            <div class="col-5 col-md-2  col-2">
                                                <p class="price-option ">${{ $option->price }} x <strong id="kp-option-{{ $option->id }}">{{ $option->inBasket }}</strong></p>
                                            </div>
                                            <div class="col-2 col-md-1 ol-2 hand">
                                                <img src="{{ asset('home/img/plus.png') }}" alt="" width="80%" onclick="addOption({{ $option->id }})">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-6 col-md-6 d-block d-sm-none d-md-none d-lg-none">
                                    <p class="title-option ">Extras</p>
                                </div>
                                <div class="col-md-6 vl" id="extras-rows">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="extras-rows-sample" class="hidden">
        <div class="row border-between">
            <div class="col-md-9  col-5">
                <p class="desc-option ">eTit</p>
            </div>
            <div class="col-md-2 col-5 hand">
                <p class="price-option ">$ePrc x <strong id="kp-extra-eId">eNo</strong></p>
            </div>
            <div class="col-md-1 col-2 hand">
                <img src="{{ asset('home/img/plus.png') }}" alt="" width="80%" onclick="addExtra(eId, kpId)">
            </div>
        </div>
    </div>
@endsection

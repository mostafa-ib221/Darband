@extends('layouts.home.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('home/css/explore.css') }}" />
@endsection

@section('content')
    @include('content.home.explore.welcome')
    @include('content.home.explore.about')
    @include('content.home.explore.dishes_popular')
    @include('content.home.explore.dishes_other')
    @include('content.home.explore.news')
    @include('content.home.explore.detail')
@endsection

@section('js')
    <script>
        var swiper1 = new Swiper('.swiper-container1', {
            slidesPerView: 1,
            spaceBetween: 10,
            // init: false,
            pagination: {
                el: '.swiper-pagination1',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next1',
                prevEl: '.swiper-button-prev1',
            },

            breakpoints: {
                300: {
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
                    spaceBetween: 50,
                },
            }
        });

        var swiper3 = new Swiper('.swiper-container3', {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination3',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next3',
                prevEl: '.swiper-button-prev3',
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
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination2',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next3',
                prevEl: '.swiper-button-prev3',
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
    </script>
    <script>
        /*$('.buy').click(function() {
            var id = "#" + $(this).attr("data-number");
            console.log(id);
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

        function OrderModal(id) {

            var extrasRows = $("#extras-rows");
            extrasRows.html("");
            var rows = "";
            var extras = JSON.parse($("#extras-" + id).val());
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
                <p class="price-option ">$ePrc x <strong id="kp-extra-eId">0</strong></p>
            </div>
            <div class="col-md-1 col-2 hand">
                <img src="{{ asset('home/img/plus.png') }}" alt="" width="80%" onclick="addExtra(eId, kpId)">
            </div>
        </div>
    </div>
@endsection

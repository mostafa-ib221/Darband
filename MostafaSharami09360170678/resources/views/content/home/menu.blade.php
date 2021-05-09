@extends('layouts.home.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('home/css/menu.css') }}" />
@endsection

@section('content')
    @include('content.home.menu.header')
    @include('content.home.menu.other')
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

      @foreach (FOOD_CAT as $id => $value)
       @if(isset($others[$id]) && count($others[$id]))
        var swiper_{{ $id }} = new Swiper('.swiper-container-{{ $id }}', {
            slidesPerView: 3,
            spaceBetween: 10,
            // init: false,
            pagination: {
                el: '.swiper-pagination-{{ $id }}',
                clickable: true,
            },
            breakpoints: {
                300: {
                    slidesPerView: 2,
                    spaceBetween: 20,
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
       @endif
      @endforeach

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

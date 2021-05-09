<!-- section2 --------------------------------------------------------------- -->
<section class="section2" >
    <div class="container-fluid">
        <div class="row">
            <div class="swiper-container swiper-container1">
                <div class="col-md-12">
                    <p class="swiper-title pb-1">Most Popular Dishes: Kale Pache</p>
                    <hr class="pb-2">
                </div>

                <div class="swiper-wrapper">
                  @foreach($populars as $popular)
                    <div class="swiper-slide">
                        <div class="card card2" style="width: 18rem;">
                            <img class="card-img-top hand" src="{{ $popular->pic }}" alt="Card image cap" onclick="OrderModal({{ $popular->id }})">
                            <div class="card-body">
                                <h5 class="card-title hand" onclick="OrderModal({{ $popular->id }})">{{ $popular->title }}</h5>
                                <p class="card-text hand" onclick="OrderModal({{ $popular->id }})">{{ $popular->description }}</p>
                                <div class="col-md-12 px-0">
                                    <div class="row ">
                                        <div class="col-4 col-md-4 pr-0 d-table my-auto">
                                            <p class="price">${{ $popular->price }}</p>
                                        </div>
                                        <div class="col-8 col-md-8">
                                            <div class="row justify-content-around">
                                                <div class="col-7 col-md-7 col-lg-8 d-table my-auto px-0">
                                                    <p class="mb-0 check btn-class my-auto" id="check{{ $popular->id }}p"><button id="qButtonMinus" onclick="minus({{ $popular->id }})">-</button>
                                                        <input type="text" name="quantity" style="width:30px;" class="value order-no" id="order-no-{{ $popular->id }}p" placeholder="0"> <button onclick="add({{ $popular->id }})" id="qButtonAdd">+</button>
                                                    </p>
                                                </div>
                                                <div class="col-4 col-md-3 col-lg-4 ">
                                                    <img src="{{ asset('home/img/basket.png') }}" width="95%" class="image-basket d-table ml-auto buy" data-number="check{{ $popular->id }}p">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
                {{--<p id="kp_menu_desktop"></p>--}}
                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination1"></div>
                <!-- Add Arrows -->
                <div class="swiper-button-next swiper-button-next1"> <img src="{{ asset('home/img/Icon feather-arrow-left-circle-1.svg') }}" alt="" width="100%"></div>
                <div class="swiper-button-prev swiper-button-prev1"><img src="{{ asset('home/img/Icon feather-arrow-left-circle-1.sv') }}g" alt="" width="100%"></div>
            </div>
        </div>
    </div>
</section>
<p id="kp_menu_desktop"></p>
<!-- ./section2-------------------------------------------------------------- -->

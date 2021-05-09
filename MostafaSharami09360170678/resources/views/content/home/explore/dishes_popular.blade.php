<!-- section3 --------------------------------------------------------------- -->
<section class="section3">
    <div class="container-fluid">
        <div class="row">
            <div class="swiper-container swiper-container1">
                <div class="col-md-12">
                    <p class="swiper-title">Most Popular Dishes: Kale Pache</p>
                    <hr class="pb-2">
                </div>

                <div class="swiper-wrapper">
                  @foreach($dishes['populars'] as $popular)
                    <div class="swiper-slide">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top hand" src="{{ $popular->pic }}" onclick="OrderModal({{ $popular->id }})" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title hand" onclick="OrderModal({{ $popular->id }})">{{ $popular->title }}</h5>
                                <p class="card-text hand" onclick="OrderModal({{ $popular->id }})">{{ $popular->description }}
                                </p>
                                <div class="col-md-12 px-0">
                                    <div class="row ">
                                        <div class="col-4 col-md-4 pr-0">
                                            <p class="price">${{ $popular->price }}</p>
                                        </div>
                                        <div class="col-8 col-md-8">
                                            <div class="row justify-content-around">
                                                <div class="col-7 col-md-7 d-table my-auto px-0">
                                                    <p class="mb-0 check btn-class my-auto" id="check{{ $popular->id }}"><button id="qButtonMinus" onclick="minus({{ $popular->id }})">-</button>
                                                        <input type="text" name="quantity" id="order-no-{{ $popular->id }}" style="width:30px;" class="value" placeholder="0"> <button onclick="add({{ $popular->id }})" id="qButtonAdd">+</button>
                                                    </p>
                                                </div>
                                                <div class="col-4 col-md-5">
                                                    <img src="{{ asset('home/img/basket.png') }}" width="100%" class="image-basket d-table ml-auto buy" data-number="check{{ $popular->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="extras-{{ $popular->id }}" value="{{ json_encode($popular->extras) }}" />
                    </div>
                  @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination1"></div>
                <!-- Add Arrows -->
                <div class="swiper-button-next swiper-button-next1"> <img src="{{ asset('home/img/Icon feather-arrow-left-circle-1.svg') }}" alt="" width="100%"></div>
                <div class="swiper-button-prev swiper-button-prev1"><img src="{{ asset('home/img/Icon feather-arrow-left-circle-1.svg') }}" alt="" width="100%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-style">
        <button class="sale-btn" onclick="window.location = '{{ url('order') }}';"><img src="{{ asset('home/img/noun_food menu_3417310.svg') }}" class="pr-3"> Pre Order Kale
            Pache</button>
    </div>
</section>
<!-- ./section3-------------------------------------------------------------- -->

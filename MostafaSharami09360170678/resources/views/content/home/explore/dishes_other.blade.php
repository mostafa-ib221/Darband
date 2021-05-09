<!-- section4 --------------------------------------------------------------- -->
<section class="section3">
    <div class="container-fluid">
        <div class="row">
            <div class="swiper-container swiper-container3">
                <div class="col-md-12">
                    <p class="swiper-title">Other Signature Dishes</p>
                    <hr class="pb-2">
                </div>
                <div class="swiper-button-next nx swiper-button-next3 "> <img src="{{ asset('home/img/Icon feather-arrow-left-circle-1.svg') }}" alt="" width="100%"></div>
                <div class="swiper-button-prev prv swiper-button-prev3 "><img src="{{ asset('home/img/Icon feather-arrow-left-circle-1.svg') }}" alt="" width="100%"></div>
                <div class="swiper-wrapper">
                    @foreach($dishes['others'] as $other)
                    <div class="swiper-slide" style="cursor: pointer">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $other->pic }}" alt="Order this meal through Uber Eats" title="Order this meal through Uber Eats">
                            <div class="msg-dark">Order this meal through Uber Eats</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $other->title }}</h5>
                                <p class="card-text">{{ $other->description }}</p>
                                <div class="col-md-12">
                                    <p class="price">{{ $other->price }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="swiper-slide" style="cursor: pointer">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $other->pic }}" alt="Order this meal through Uber Eats" title="Order this meal through Uber Eats">
                            <div class="card-body">
                                <h5 class="card-title">{{ $other->title }}</h5>
                                <p class="card-text">{{ $other->description }}</p>
                                <div class="col-md-12">
                                    <p class="price">{{ $other->price }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" style="cursor: pointer">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $other->pic }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $other->title }}</h5>
                                <p class="card-text">{{ $other->description }}</p>
                                <div class="col-md-12">
                                    <p class="price">{{ $other->price }}</p>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    @endforeach
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination3"></div>
            <!-- Add Arrows -->

        </div>
    </div>
    <div class="col-md-12 mt-style">
        <button class="sale-btn1" onclick="window.location = '{{ UBER_EATS }}';"><img src="{{ asset('home/img/btn_uber_eats.png') }}" width="100%"></button>
    </div>
</section>
<!-- ./section4-------------------------------------------------------------- -->

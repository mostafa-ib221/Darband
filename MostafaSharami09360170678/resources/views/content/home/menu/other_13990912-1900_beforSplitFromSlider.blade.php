<!-- section4---------------------------------------------------------------- -->
<section class="section4 d-none d-sm-none d-md-none d-lg-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                {{--<p class="p-title">Our Menu</p>--}}

            </div>
            <div class="col-md-2 text-right">
                <a href="{{ UBER_EATS }}" class="View-more">View more</a>
                {{--<img src="{{ asset('home/img/footer/arrowicon.png') }}" alt="" width="10%" class="ml-5">--}}
            </div>
        </div>
        <hr>
        <div class="row">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach (FOOD_CAT as $id => $value)
                  @if(isset($others[$id]) && (count($others[$id]) > 3))
                    <li class="nav-item" role="presentation">
                        <a class="nav-link tab-header @if($id=='Main') active @endif" data-id="{{ $id }}" id="pills-{{ $id }}-tab" data-toggle="pill" href="#pills-{{ $id }}" role="tab" aria-controls="pills-{{ $id }}" aria-selected="@if($id=='Main') true @else false @endif">{{ $value }}</a>
                    </li>
                  @endif
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach (FOOD_CAT as $id => $value)
                  @if(isset($others[$id]) && (count($others[$id]) > 3))
                    <div class="tab-body @if($id=='Main') active @endif" id="tab-body-{{ $id }}" role="tabpanel" aria-labelledby="pills-{{ $id }}-tab">
                        <div class="row">
                            {{--@for ($i = 0; $i < 4; $i++)
                                <div class="col-md-3">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('home/img/j3g6fdvk.png') }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $id }}</h5>
                                            <p class="card-text">{{ $value }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endfor--}}
                            @foreach($others[$id] as $other)
                                <div class="col-md-3" style="cursor: pointer">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ $other->pic }}" alt="Order this meal through Uber Eats" title="Order this meal through Uber Eats">
                                        <div class="msg-dark">Order this meal through Uber Eats</div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $other->title }}</h5>
                                            <p class="card-text">{{ $other->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                  @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-12 mt-style">
            <button class="sale-btn1" onclick="window.location = '{{ UBER_EATS }}';"><img src="{{ asset('home/img/btn_uber_eats.png') }}" width="100%"></button>
        </div>
    </div>
</section>
<section class="section4 d-block d-sm-block d-md-block d-lg-none">
    <div class="row">
        <div class="col-8 col-md-10">
            {{--<p class="p-title">Our Menu</p>--}}
        </div>
        <div class="col-4 col-md-2 text-right">
            <a href="{{ UBER_EATS }}" class="View-more">View more</a>
            {{--                <img src="{{ asset('home/img/footer/arrowicon.png') }}" alt="" width="10%" class="ml-5">--}}
        </div>
    </div>
    <hr>
    <!-- Swiper -->
    <div class="swiper-container swiper-container2">
        <div class="swiper-wrapper">
            @foreach (FOOD_CAT as $id => $value)
              @if(isset($others[$id]) && (count($others[$id]) > 3))
                <div class="swiper-slide">
                    <a class="nav-link tab-header @if($id=='Main') active @endif" data-id="{{ $id }}-2" id="pills-{{ $id }}-tab" data-toggle="pill" href="#pills-{{ $id }}" role="tab" aria-controls="pills-{{ $id }}" aria-selected="@if($id=='Main') true @else false @endif">{{ $value }}</a>
                </div>
              @endif
            @endforeach
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination2"></div>
    </div>
    <div>
        @foreach (FOOD_CAT as $id => $value)
          @if(isset($others[$id]) && (count($others[$id]) > 3))
            <div class="tab-body active" id="tab-body-{{ $id }}-2" role="tabpanel" aria-labelledby="pills-{{ $id }}-tab">
                <div class="swiper-container swiper-container-{{ $id }}">
                    <div class="swiper-wrapper">
                        {{--@for ($i = 0; $i < 4; $i++)
                            <div class="swiper-slide">
                                <div class="card card4">
                                    <img class="card-img-top" src="{{ asset('home/img/j3g6fdvk.png') }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $id }}</h5>
                                        <p class="card-text">{{ $value }}</p>
                                    </div>
                                </div>
                            </div>
                        @endfor--}}

                        @foreach($others[$id] as $other)
                            <div class="swiper-slide">
                                <div class="card card4">
                                    <img class="card-img-top" src="{{ $other->pic }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $other->title }}</h5>
                                        <p class="card-text">{{ $other->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination swiper-pagination-{{ $id }}"></div>
                </div>
            </div>
          @endif
        @endforeach
    </div>
</section>
<!-- ./section4------------------------------------------------------------- -->

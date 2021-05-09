<!-- section3---------------------------------------------------------------- -->
<section class="section3 d-none d-sm-none d-md-block d-lg-block">
    <div class="container-fluid">
        <div class="row">
            <p class="title-section3 d-table mx-auto" id="kp_menu_desktop">
                <img src="{{ asset('home/img/noun_food menu_3417310_black.svg') }}" alt="" class="mr-3 ml-5" width="10%"> Kale pache Menu
            </p>
        </div>

        <div class="row">
          @foreach($kps as $kp)
            <div class="col-md-4 col-lg-3 pt-style-card padding-style-responsive my-3">
                <div class="card interior  card1">
                    {{--<img class="card-img-top" src="{{ $kp->pic }}" alt="Card image cap" data-toggle="modal" data-target="#OrderModal">--}}
                    <img class="card-img-top" id="kp-pic-{{ $kp->id }}" src="{{ $kp->pic }}" alt="Card image cap" onclick="OrderModal({{ $kp->id }})">
                    <div class="card-body">
                        <h5 class="card-title hand" id="kp-title-{{ $kp->id }}" onclick="OrderModal({{ $kp->id }})">{{ $kp->title }}</h5>
                        <p class="card-text hand" id="kp-des-{{ $kp->id }}" onclick="OrderModal({{ $kp->id }})">{{ $kp->description }}</p>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-4 col-md-4 d-table my-auto px-0">
                                    <p class="price">${{ $kp->price }}</p>
                                </div>
                                <div class="col-8 col-md-12 col-lg-8">
                                    <div class="row justify-content-around">
                                        <div class="col-7 col-md-7 col-lg-8 d-table my-auto px-0">
                                            <p class="mb-0 check btn-class my-auto" id="check{{ $kp->id }}"><button id="qButtonMinus" onclick="minus({{ $kp->id }})">-</button>
                                                <input type="text" name="quantity" style="width:30px;" class="value order-no" id="order-no-{{ $kp->id }}" placeholder="0"> <button onclick="add({{ $kp->id }})" id="qButtonAdd">+</button>
                                            </p>
                                        </div>
                                        <div class="col-4 col-md-3 col-lg-4 ">
                                            <img src="{{ asset('home/img/basket.png') }}" width="100%" class="image-basket d-table ml-auto buy" data-number="check{{ $kp->id }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="extras-{{ $kp->id }}" value="{{ json_encode($kp->extras) }}" />
            </div>
          @endforeach
        </div>
    </div>
</section>
<!-- ./section3------------------------------------------------------------- -->
{{--ghemate jadid --}}
<section class="section3 d-block d-sm-block d-md-none d-lg-none mb-2">
    <div class="col-12">
        <p class="title-section3 d-table mx-auto" id="kp_menu_mobile">
            <img src="{{ asset('home/img/noun_food menu_3417310_black.svg') }}" alt="" class="mr-3 ml-5 " width="10%" > Kale pache Menu
        </p>
    </div>
    @foreach($kps as $kp)
    <div class="col-12 card card-mobile-section3 mb-2">
        <div class="row">
            <div class="col-4 px-0">
                <img class="card-img-top image-res-new-sec" src="{{ $kp->pic }}" alt="Card image cap" width="100%" onclick="OrderModal({{ $kp->id }})">
            </div>
            <div class="col-8">
                <div class="card-body px-0 ">
                    <h5 class="card-title" id="kp-title-{{ $kp->id }}" onclick="OrderModal({{ $kp->id }})">{{ $kp->title }}</h5>
                    <p class="card-text" id="kp-des-{{ $kp->id }}" onclick="OrderModal({{ $kp->id }})">{{ $kp->description }}</p>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-4 col-md-4 d-table my-auto px-0">
                                <p class="price">${{ $kp->price }}</p>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8">
                                <div class="row justify-content-around">
                                    <div class="col-8 col-md-7 col-lg-8 d-table my-auto px-0">
                                        <p class="mb-0 check btn-class my-auto" id="check{{ $kp->id }}m"><button id="qButtonMinus" onclick="minus({{ $kp->id }})">-</button>
                                            <input type="text" name="quantity" style="width:30px;" class="value order-no" id="order-no-{{ $kp->id }}" placeholder="0"> <button onclick="add({{ $kp->id }})" id="qButtonAdd">+</button>
                                        </p>
                                    </div>
                                    <div class="col-4 col-md-3 col-lg-4 px-1">
                                        <img src="{{ asset('home/img/basket.png') }}" width="60%" class="image-basket d-table ml-auto buy" data-number="check{{ $kp->id }}m">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @endforeach
</section>

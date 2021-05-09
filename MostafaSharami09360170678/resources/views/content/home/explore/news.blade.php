<!-- section5---------------------------------------------------------------- -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="section5-bg"></div>

            <div class="swiper-container swiper-container2">
                <div class="col-md-12">
                    <p class="swiper-title-section5">Latest News</p>
                </div>
                <div class="swiper-wrapper">
                  @foreach($News as $one)
                    <div class="swiper-slide">
                        <div class="card1">
                            <div class="card-body card-body-1">
                                {{--<img src="{{ asset('home/img/explore/5ckwiro3.png') }}">--}}
                              @if(!empty($one->pic))
                                <img src="/MostafaSharami09360170678/storage/app/News/{{ $one->pic }}" class="w-100" />
                              @endif
                                <h5 class="card-title1 py-3">{{ $one->title }}</h5>
                                <p class="card-text1 pb-5">{{ $one->summery }}</p>
                                <a href="{{ $one->url }}" class="btn more" @if($one->url == '') style="opacity: 0" @endif>Read More</a>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination2"></div>
                <!-- Add Arrows -->
            </div>
        </div>
    </div>
</section>
<!-- /.section5-------------------------------------------------------------- -->

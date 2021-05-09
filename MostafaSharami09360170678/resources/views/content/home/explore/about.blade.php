<!-- section2---------------------------------------------------------------- -->
<section class="section2" id="about">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-5">
                {{--<img src="{{ $abouts['img'] }}" alt="image1" class="d-table ml-auto responsive-image" width="70%">--}}
                <img src="{{ asset('home/img/tmp/img.png') }}" alt="image1" class="d-table ml-auto responsive-image" width="70%">
            </div>
            <div class="col-sm-8 col-md-7 px-5">
                <p class="title-section2">{{ $abouts['title'] }}</p>
                <div class="col-7 col-md-5 pl-0">
                    <hr class="hr-1">
                </div>
                <p class="desc-section">{{ $abouts['text'] }}</p>
                {{--<div class="col-md-12 pt-5 respons-padding">--}}
                    {{--<a href="{{ $abouts['video'] }}" target="_blank" class="row">--}}
                        {{--<div class="col-3 col-md-2 col-lg-1">--}}
                            {{--<img src="{{ asset('home/img/play-rounded-button.svg') }}" width="100%">--}}
                        {{--</div>--}}
                        {{--<div class="col-9    col-md-10  col-lg-11 d-table my-auto">--}}
                            {{--<p class="vedio-play ">--}}
                                {{--Watch Video--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</section>
<!-- ./section2-------------------------------------------------------------- -->

@extends('layouts.boss.index')

@section('content')
    <h1 class="my-4 rem-4">{{ $title }}</h1>
    <div class="row">
        <div class="col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="title">Title</label>
                    </div>
                    <input type="hidden" name="caption" value="title" />
                    <input type="text" name="value" id="title" class="form-control" placeholder="Please enter title" aria-label="Please enter title" aria-describedby="basic-addon2" value="{{ isset($abouts['title']) ? $abouts['title'] : '' }}" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="video">video Url</label>
                    </div>
                    <input type="hidden" name="caption" value="video" />
                    <input type="text" name="value" id="video" class="form-control" placeholder="Please enter video url" aria-label="Please enter video url" aria-describedby="basic-addon2" value="{{ isset($abouts['video']) ? $abouts['video'] : '' }}" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="open_day_from">Text of About</label>
                    </div>
                    <input type="hidden" name="caption" value="text" />
                    <textarea name="value" id="text" class="form-control" placeholder="Please enter text of about" aria-label="Please enter text of about" aria-describedby="basic-addon2">{{ isset($abouts['text']) ? $abouts['text'] : '' }}</textarea>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="img">Photo</label>
                    </div>
                    <input type="hidden" name="caption" value="img" />
                    <input type="file" name="value" id="img" class="form-control" placeholder="Please enter video url" aria-label="Please enter video url" aria-describedby="basic-addon2" value="{{ isset($abouts['img']) ? $abouts['img'] : '' }}" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
      @if(isset($abouts['img']))
        <div class="offset-md-3 col-md-6 col-sm-12 col-12 mb-5">
            <img src="{{ $abouts['img'] }}" style="width: 100%;" />
        </div>
      @endif
    </div>
@endsection

@section('js')
    <script>
        function makeDisable(id) {
            console.clear();
            console.log('=============================> START');
            $("#"+id).attr("disable", "disable");
            console.log('=============================> END');
        }
    </script>
@endsection

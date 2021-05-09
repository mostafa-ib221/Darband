@extends('layouts.app')

@section('css')
    <style>
        html, body {overflow: hidden !important;}
        .container-fluid {padding-left: 0 !important; padding-right: 0 !important;}
        h1 {padding-left: 1.5rem; padding-right: 1.5rem;}

        .msg-box {
            height: 52vh;
            padding: 2rem 1rem !important;
            margin: 0.5rem !important;
            border-radius: 50px;
            border: solid 2px #0003;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .msg-box::-webkit-scrollbar {
            width: 11px;
        }

        .msg {
            display: block;
            width: 100%;
            margin: 5px 0;
        }

        .msg div div {
            display: inline-block;
            border-radius: 10px;
            padding: 10px;
        }

        .msg .msg-customer {text-align: left;}
        .msg .msg-customer .msg-customer-text {background-color: #0A3E60; border-bottom-left-radius: 0; color: #FFF !important;}

        .msg .msg-admin {text-align: right;}
        .msg .msg-admin .msg-admin-text {background-color: #EFEFEF; border-bottom-right-radius: 0;}

        .msg img {
            height: 40vh;
        }
    </style>
@endsection

@section('content')
    <h1 class="my-4 rem-4">
        {{ $title }}
        <a href="{{ url(isset($cat) ? '/message/' . $user . '/' . $cat . '/delete' : '/message/user/' . $user . '/delete') }}" class="btn btn-danger" title="حذف گروه" onclick="return confirm('از حذف گروه «{{ $title }}» اطمینان دارید؟')">
            <i class="fas fa-trash"></i>
        </a>
    </h1>
    {{--<div class="row bg-info" style="height: 61vh">--}}
    <div class="row msg-box" style="">
        <div class="col-12">
          @foreach($messages as $message)
            <div class="msg">
                <div class="msg-{{ ($message->is_customer == 1) ? 'customer' : 'admin' }}">
                    <div class="msg-{{ ($message->is_customer == 1) ? 'customer' : 'admin' }}-text">
                      @if($message->file !== '')
                       @switch($message->type)
                        @case('img')
                           <img src="{{ $message->file }}" />
                           @break
                        @case('audio')
                            <audio controls>
                                <source src="{{ $message->file }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                           @break
                        @case('video')
                            <video width="320" height="240" controls>
                                <source src="{{ $message->file }}" type="video/mp4">
                                {{--<source src="movie.ogg" type="video/ogg">--}}
                                Your browser does not support the video tag.
                            </video>
                           @break
                        @case('document')
                           DOCUMENT
                            <br />
                            <a href="{{ $message->file }}" target="_blank">دانلود</a>
                           @break
                        @case('compress')
                           COMPRESS
                            <br />
                            <a href="{{ $message->file }}" target="_blank">دانلود</a>
                           @break
                        @default
                            FILE
                            <br />
                           <a href="{{ $message->file }}" target="_blank">دانلود</a>
                       @endswitch
                      @else
                        {{ $message->text }}
                      @endif
                    </div>
                </div>
            </div>
          @endforeach
        </div>
    </div>
    <div class="row mx-4">
        <div class="col-md-6 col-sm-12">
            <form action="{{ url(isset($cat) ? '/message/' . $user . '/' . $cat : '/message/user/' . $user) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="msg" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100">ارسال</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-sm-12">
            <form action="{{ url(isset($cat) ? '/message/' . $user . '/' . $cat : '/message/user/' . $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="attach" class="form-control" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100">ارسال</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".msg-box").scrollTop($(".msg-box")[0].scrollHeight);
        });
    </script>
@endsection

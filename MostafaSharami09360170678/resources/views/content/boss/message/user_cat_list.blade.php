@extends('layouts.app')

@section('content')
    <h1 class="my-4 rem-4">
        {{ $title }}
        <i class="fas fa-plus text-success float-left" style="cursor: pointer" data-toggle="modal" data-target="#AddMsgCat" title="ایجاد گروه پیام جدید"></i>
    </h1>
    <div class="row">
        <div class="col-12">
            <div class="list-group">
              @foreach($cats as $cat)
                <a href="{{ url('/message/' . $user . '/' . $cat->id) }}" class="list-group-item list-group-item-action">
                    {{ $cat->title }}
                    <span class="badge badge-primary badge-pill float-left">{{ $cat->read_admin }}</span>
                </a>
              @endforeach
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- The Modal -->
    <div class="modal" id="AddMsgCat">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ایجاد گروه پیام جدید</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body persianAll">
                        <div class="form-group">
                            <label for="title">عنوان گروه</label>
                            <input type="text" name="title" id="title" class="form-control" />
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div class="btn-group englishAll w-100">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onclick="$('#title').val('')">انصراف</button>
                            <button type="submit" class="btn btn-success">ایجاد</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

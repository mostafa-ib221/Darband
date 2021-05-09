@extends('layouts.boss.index')

@section('css')
    <style>
        .td-img {padding: 0px !important; width: 20%;}
        .td-img img {width: 100%; margin: 0px;}
    </style>
@endsection

@section('content')
    <h1 class="my-4 rem-4">{!! $title !!}</h1>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="title">Title</label>
                    </div>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Please enter title" aria-label="Please enter title" aria-describedby="basic-addon2" value="{{ old('title') }}" required />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="price">Price</label>
                    </div>
                    <input type="number" min="1.00" step="0.01" name="price" id="price" class="form-control" placeholder="Please enter price" aria-label="Please enter price" aria-describedby="basic-addon2" value="{{ old('price') }}" required />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="description">Description</label>
                    </div>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Please enter description" aria-label="Please enter description" aria-describedby="basic-addon2" value="{{ old('description') }}" />
                    <div class="input-group-append hidden" id="btn_reset">
                        <button class="btn btn-outline-warning" type="button" onclick="ResetForm()">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="pic">Photo</label>
                    </div>
                    <input type="file" name="pic" id="pic" class="form-control" placeholder="Please enter video url" aria-label="Please enter video url" aria-describedby="basic-addon2" value="{{ old('pic') }}" />
                    <div class="input-group-append hidden" id="btn_reset">
                        <button class="btn btn-outline-warning" type="button" onclick="ResetForm()">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <hr />

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>pic</th>
                        <th>title</th>
                        <th>description</th>
                        <th>price</th>
                        <th class="operations">operations</th>
                    </tr>
                </thead>
                <tbody>
	            <?php $i = 1; ?>
                @foreach($options as $option)
                    <tr>
                        <td id="row_{{ $option->id }}_pic" class="td-img">
                          @if(!empty($option->pic))
                            <img src="{{ $option->pic }}" />
                          @endif
                        </td>
                        <td id="row_{{ $option->id }}_title">{{ $option->title }}</td>
                        <td id="row_{{ $option->id }}_des">{{ $option->description }}</td>
                        <td id="row_{{ $option->id }}_price">{{ $option->price }}</td>
                        <td class="operations">
                            <button type="button" class="btn btn-info" onclick="EditOption({{ $option->id }})">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <a href="{{ url('boss/dishes/options/delete/' . $option->id) }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br />
            {{ $options->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function EditOption(id) {
            $("form").attr("action", "{{ url('/boss/dishes/options/') }}/" + id);
            $("#btn_reset").removeClass("hidden");
            $("#title").val($('#row_' + id + '_title').html());
            $("#description").val($('#row_' + id + '_des').html());
            $("#price").val($('#row_' + id + '_price').html());
            $("body").scrollTop();
        }

        function ResetForm() {
            $("form").attr("action", "{{ url('/boss/dishes/options') }}");
            $("#btn_reset").addClass("hidden");
            $("#title").val("");
            $("#description").val("");
            $("#price").val("");
        }
    </script>
@endsection

@extends('layouts.boss.index')

@section('content')
    <h1 class="my-4 rem-4">{!! $title !!}</h1>
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="title">Title</label>
                    </div>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Please enter title" aria-label="Please enter title" aria-describedby="basic-addon2" value="{{ old('title') }}" required />
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="price">Price</label>
                    </div>
                    <input type="number" min="1.00" step="0.01" name="price" id="price" class="form-control" placeholder="Please enter price" aria-label="Please enter price" aria-describedby="basic-addon2" value="{{ old('price') }}" required />
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
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
                        <th>title</th>
                        <th>description</th>
                        <th>price</th>
                        <th class="operations">operations</th>
                    </tr>
                </thead>
                <tbody>
	            <?php $i = 1; ?>
                @foreach($extras as $extra)
                    <tr>
                        <td id="row_{{ $extra->id }}_title">{{ $extra->title }}</td>
                        <td id="row_{{ $extra->id }}_des">{{ $extra->description }}</td>
                        <td id="row_{{ $extra->id }}_price">{{ $extra->price }}</td>
                        <td class="operations">
                            <button type="button" class="btn btn-info" onclick="EditOption({{ $extra->id }})">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <a href="{{ url('boss/dishes/extras/delete/' . $extra->id) }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br />
            {{ $extras->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function EditOption(id) {
            $("form").attr("action", "{{ url('/boss/dishes/extras/') }}/" + id);
            $("#btn_reset").removeClass("hidden");
            $("#title").val($('#row_' + id + '_title').html());
            $("#description").val($('#row_' + id + '_des').html());
            $("#price").val($('#row_' + id + '_price').html());
            $("body").scrollTop();
        }

        function ResetForm() {
            $("form").attr("action", "{{ url('/boss/dishes/extras') }}");
            $("#btn_reset").addClass("hidden");
            $("#title").val("");
            $("#description").val("");
            $("#price").val("");
        }
    </script>
@endsection

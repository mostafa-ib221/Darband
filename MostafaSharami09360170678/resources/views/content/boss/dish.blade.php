@extends('layouts.boss.index')

@section('css')
    <style>
        .extras .fas {
            margin-right: -6px !important;
            margin-left: 0px !important;
            z-index: 999;
        }
        .extras .badge {
            margin-right: 0px !important;
            margin-left: -6px !important;
        }
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
                    <input type="text" name="title" id="title" class="form-control" placeholder="Please enter title" aria-label="Please enter title" aria-describedby="basic-addon2" value="{{ old('title') }}" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="description">Description</label>
                    </div>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Please enter description" aria-label="Please enter description" aria-describedby="basic-addon2" value="{{ old('description') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text bg-light" for="price">Price</label>
                        </div>
                        <input type="number" min="1.00" step="0.01" name="price" id="price" class="form-control" placeholder="Please enter price" aria-label="Please enter price" aria-describedby="basic-addon2" value="{{ old('price') }}" />
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
                        <th>title</th>
                        <th>description</th>
                        <th>price</th>
                        <th>pic</th>
                        <th class="operations">operations</th>
                    </tr>
                </thead>
                <tbody>
	            <?php $i = 1; ?>
                @foreach($dishes as $dish)
                    <tr>
                        <td id="row_{{ $dish->id }}_title">{{ $dish->title }}</td>
                        <td id="row_{{ $dish->id }}_des">{{ $dish->description }}</td>
                        <td id="row_{{ $dish->id }}_price">{{ $dish->price }}</td>
                        <td id="row_{{ $dish->pic }}_pic" class="p-0" style="width: 300px">
                            <img src="{{ $url . $dish->pic }}" class="p-0 m-0" style="width: 300px" />
                        </td>
                        <td class="operations pt-2">
                            <button type="button" class="btn btn-info my-1" onclick="EditDish({{ $dish->id }})">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <a href="{{ url('boss/dishes/delete/' . $dish->id) }}" class="btn btn-danger my-1">
                                <i class="fas fa-trash"></i>
                            </a>
                          @if($locate == 'Popular')
                            <input type="hidden" id="row_{{ $dish->id }}_extras" value="{{ $dish->mackExtraIdJsonList(true) }}" />
                            @php($count = count($dish->Extras))
                            @php($colorClass = 'btn-' . ($count ? 'primary' : 'secondary'))
                            <button type="button" class="btn {{ $colorClass }} mt-1 extras px-1" title="Add/Remove extras" onclick="OpenExtraModal({{ $dish->id }})">
                                <i class="fas fa-plus-circle"></i>
                                <span class="badge badge-light">{{ $count }}</span>
                            </button>
                          @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br />
            {{ $dishes->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function EditDish(id) {
            $("form").attr("action", "{{ url('/boss/dishes/' . strtolower($locate)) }}/" + id);
            $("#btn_reset").removeClass("hidden");
            $("#title").val($('#row_' + id + '_title').html());
            $("#description").val($('#row_' + id + '_des').html());
            $("#price").val($('#row_' + id + '_price').html());
            $("#news-form-div").collapse("show");
            $("body").scrollTop();
            //console.log(id);
        }

        function ResetForm() {
            $("form").attr("action", "{{ url('/boss/dishes') }}");
            $("#btn_reset").addClass("hidden");
            $("#title").val("");
            $("#description").val("");
            $("#price").val("");
            $("#news-form-div").collapse("hide");
        }

      @if($locate == 'Popular')
        function OpenExtraModal(id) {
            $(".custom-control-input").prop("checked", false);
            var extras = JSON.parse($("#row_"+id+"_extras").val());
            $.each(extras, function(index, value) {
                $("#extra_" + value).prop("checked", true);
            });
            $("#TitleExtraModal").html($("#row_"+id+"_title").html());
            $("#extra_form").attr("action", "{{ url('/boss/dishes/popular/extras') }}/" + id);
            $("#ExtraModal").modal("show");
        }
      @endif
    </script>
@endsection

@section('modal')
  @if($locate == 'Popular')
    <!-- The Modal -->
    <div class="modal fade" id="ExtraModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Manage "<strong id="TitleExtraModal"></strong>" Extras</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

              <form action="{{ url('/boss/dishes/popular/extras') }}" method="post" id="extra_form">
                @csrf
                <!-- Modal body -->
                <div class="modal-body row">
                  @foreach($extras as $extra)
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="extra_{{ $extra->id }}" name="extras[{{ $extra->id }}]">
                            <label class="custom-control-label" for="extra_{{ $extra->id }}">{{ $extra->title }}</label>
                        </div>
                    </div>
                  @endforeach
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
               </form>

            </div>
        </div>
    </div>
  @endif
@endsection

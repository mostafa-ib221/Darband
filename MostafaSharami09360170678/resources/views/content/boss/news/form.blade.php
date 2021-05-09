@extends('layouts.boss.index')

@section('content')
    <h1 class="my-4 rem-4">{{ $title }}</h1>
    <div class="card mb-4">
        <a href="#news-form-div"  data-toggle="collapse" class="card-header"><i class="fas fa-newspaper ml-1"></i> New news form</a>
        <div class="card-body collapse" id="news-form-div">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="summery">Summery</label>
                            <textarea name="summery" id="summery" style="height: 207px;" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" name="url" id="url" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="pic">Logo</label>
                            <input type="file" name="pic" id="pic" class="form-control" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mt-5">
                            <input type="submit" id="btn_submit" value="Insert {{ $title }}" class="btn btn-success btn-block" />
                            <div class="btn-group w-100 englishAll hidden" id="btn_edit">
                                <input type="button" value="Cancel Edit" class="btn btn-warning" onclick="ResetForm()" />
                                <input type="submit" value="Edit {{ $title }}" class="btn btn-info" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="englishAll">
                        <tr>
                            <th class="no">#</th>
                            <th>Title</th>
                            <th>url</th>
                            <th>Logo</th>
                            <th class="operations">operations</th>
                        </tr>
                    </thead>
                    <tfoot class="englishAll">
                        <tr>
                            <th class="no">#</th>
                            <th>Title</th>
                            <th>url</th>
                            <th>Logo</th>
                            <th class="operations">operations</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                      @foreach($News as $oneNews)
                        <tr>
                            <td class="no">{{ $i++ }}</td>
                            <td id="row_{{ $oneNews->id }}_title">{{ $oneNews->title }}</td>
                            <textarea id="row_{{ $oneNews->id }}_summery" class="hidden">{{ $oneNews->summery }}</textarea>
                            <td>
                                @if($oneNews->url != '')
                                    <a href="{{ $oneNews->url }}" target="_blank" id="row_{{ $oneNews->id }}_url">{{ $oneNews->url }}</a>
                                @endif
                            </td>
                            <td>
                              @if(!empty($oneNews->pic))
                                <img src="/MostafaSharami09360170678/storage/app/News/{{ $oneNews->pic }}" class="img-thumbnail" />
                              @endif
                            </td>
                            <td class="operations">
                                <button type="button" class="btn btn-info" onclick="EditOnNews({{ $oneNews->id }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="{{ url('/boss/news/delete/' . $oneNews->id) }}" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function EditOnNews(id) {
            $("form").attr("action", "{{ url('/boss/news') }}/" + id);
            $("#btn_submit").addClass("hidden");
            $("#btn_edit").removeClass("hidden");
            $("#title").val($('#row_' + id + '_title').html());
            $("#summery").val($('#row_' + id + '_summery').val());
            $("#url").val($('#row_' + id + '_url').html());
            $("#news-form-div").collapse("show");
            $("body").scrollTop();
            //console.log(id);
        }

        function ResetForm() {
            $("form").attr("action", "{{ url('/boss/news') }}");
            $("#btn_submit").removeClass("hidden");
            $("#btn_edit").addClass("hidden");
            $("#title").val("");
            $("#summery").val("");
            $("#url").val("");
            $("#news-form-div").collapse("hide");
        }
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <h1 class="my-4 rem-4">{{ $title }}</h1>
    <div class="card mb-4">
        <a href="#news-form-div"  data-toggle="collapse" class="card-header"><i class="fas fa-network-wired ml-1"></i>فرم {{ $title }} جدید</a>
        <div class="card-body collapse" id="news-form-div">
            <form method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12 form-group">
                        <label for="des">توضیحات</label>
                        <textarea name="des" id="des" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" name="title" id="title" class="form-control" required />
                        </div>
                        <div class="form-group mt-md-4">
                            <input type="submit" id="btn_submit" value="درج {{ $title }}" class="btn btn-success btn-block" />
                            <div class="btn-group w-100 englishAll hidden" id="btn_edit">
                                <input type="button" value="لغو ویرایش" class="btn btn-warning" onclick="ResetForm()" />
                                <input type="submit" value="ویرایش {{ $title }}" class="btn btn-info" />
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
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="englishAll">
                        <tr>
                            <th class="no">#</th>
                            <th>عنوان</th>
                            <th>خلاصه</th>
                            <th class="operations">عملیات</th>
                        </tr>
                    </thead>
                    <tfoot class="englishAll">
                        <tr>
                            <th class="no">#</th>
                            <th>عنوان</th>
                            <th>خلاصه</th>
                            <th class="operations">عملیات</th>
                        </tr>
                    </tfoot>
                    <tbody>
				    <?php $i = 1; ?>
                    @foreach($cats as $cat)
                        <tr>
                            <td class="no">{{ $i++ }}</td>
                            <td id="row_{{ $cat->id }}_title">{{ $cat->title }}</td>
                            <td id="row_{{ $cat->id }}_des">{{ $cat->des }}</td>
                            <td class="operations">
                                <a href="{{ url('/message/user/10000-' . $cat->id) }}" class="btn btn-outline-success">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <button type="button" class="btn btn-info" onclick="EditOnCat({{ $cat->id }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                              @if(count($cat->Co) == 0)
                                <a href="{{ url('/company_cat/delete/' . $cat->id) }}" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                              @else
                                <a title="این گروه دارای شرکت زیرمجموعه است. لطفا ابتدا شرکت را حذف یا به دسته دیگر منتقل کنید" class="btn btn-outline-danger" style="cursor: not-allowed">
                                    <i class="fas fa-trash"></i>
                                </a>
                               @endif
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
        function EditOnCat(id) {
            $("form").attr("action", "{{ url('company_cat') }}/" + id);
            $("#btn_submit").addClass("hidden");
            $("#btn_edit").removeClass("hidden");
            $("#title").val($('#row_' + id + '_title').html());
            $("#des").val($('#row_' + id + '_des').html());
            $("#news-form-div").collapse("show");
            $("body").scrollTop();
            //console.log(id);
        }

        function ResetForm() {
            $("form").attr("action", "{{ url('company_cat') }}");
            $("#btn_submit").removeClass("hidden");
            $("#btn_edit").addClass("hidden");
            $("#title").val("");
            $("#des").val("");
            $("#news-form-div").collapse("hide");
        }
    </script>
@endsection

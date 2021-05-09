@extends('layouts.app')

@section('content')
    <h1 class="my-4 rem-4">{{ $title }}</h1>
    <div class="card mb-4">
        <a href="#news-form-div"  data-toggle="collapse" class="card-header"><i class="fas fa-network-wired ml-1"></i>فرم {{ $title }} جدید</a>
        <div class="card-body collapse" id="news-form-div">
            <form method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="cat">دسته</label>
                            <select name="cat" id="cat" class="custom-select">
                                {{--<option disabled selected>لطفا دسته شرکت را انتخاب کنید</option>--}}
                              @foreach($cats as $cat)
                                    <option value="{{ $cat->id }}" title="{{ $cat->des }}">{{ $cat->title }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" name="title" id="title" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label for="des">توضیحات</label>
                        <textarea name="des" id="des" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-0"></div>
                    <div class="offset-md-3 col-md-6 col-sm-12">
                        <input type="submit" id="btn_submit" value="درج {{ $title }}" class="btn btn-success btn-block" />
                        <div class="btn-group w-100 englishAll hidden" id="btn_edit">
                            <input type="button" value="لغو ویرایش" class="btn btn-warning" onclick="ResetForm()" />
                            <input type="submit" value="ویرایش {{ $title }}" class="btn btn-info" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-0"></div>
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
                            <th>دسته</th>
                            <th class="operations">عملیات</th>
                        </tr>
                    </thead>
                    <tfoot class="englishAll">
                        <tr>
                            <th class="no">#</th>
                            <th>عنوان</th>
                            <th>خلاصه</th>
                            <th>دسته</th>
                            <th class="operations">عملیات</th>
                        </tr>
                    </tfoot>
                    <tbody>
				    <?php $i = 1; ?>
                    @foreach($companies as $company)
                        <tr>
                            <td class="no">{{ $i++ }}</td>
                            <td id="row_{{ $company->id }}_title">{{ $company->title }}</td>
                            <td id="row_{{ $company->id }}_des">{{ $company->des }}</td>
                            <td>{{ $company->Cat->title }}</td>
                            <input type="hidden" id="row_{{ $company->id }}_cat" value="{{ $company->cat }}" />
                            <td class="operations">
                                <a href="{{ url('/message/user/20000-' . $company->id) }}" class="btn btn-outline-success">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <button type="button" class="btn btn-info" onclick="EditOnCo({{ $company->id }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @if(count($company->Customer) == 0)
                                    <a href="{{ url('/company/delete/' . $company->id) }}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @else
                                    <a title="این شرکت دارای شرکت زیرمجموعه است. لطفا ابتدا مشتری ها را حذف یا به شرکت دیگر منتقل کنید" class="btn btn-outline-danger" style="cursor: not-allowed">
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
        function EditOnCo(id) {
            $("form").attr("action", "{{ url('company') }}/" + id);
            $("#btn_submit").addClass("hidden");
            $("#btn_edit").removeClass("hidden");
            $("#title").val($('#row_' + id + '_title').html());
            $("#des").val($('#row_' + id + '_des').html());
            $("#cat").val($('#row_' + id + '_cat').val());
            $("#news-form-div").collapse("show");
            $("body").scrollTop();
            //console.log(id);
        }

        function ResetForm() {
            $("form").attr("action", "{{ url('company') }}");
            $("#btn_submit").removeClass("hidden");
            $("#btn_edit").addClass("hidden");
            $("#title").val("");
            $("#des").val("");
            $("#news-form-div").collapse("hide");
        }
    </script>
@endsection

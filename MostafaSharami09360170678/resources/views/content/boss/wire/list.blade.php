@extends('layouts.app')

@section('content')
    <h1 class="my-4 rem-4">{{ $title }}</h1>
    <div class="card mb-4">
        <a href="#wire-form-div"  data-toggle="collapse" class="card-header"><i class="fas fa-tools ml-1"></i>فرم «{{ $title }}» جدید</a>
        <div class="card-body collapse" id="wire-form-div">
            <form action="{{ url('wire') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="cat" value="{{ $cat }}" />
                <div class="row mb-3" style="border-bottom: solid 1px #000;">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" name="title" id="title" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="pic_top">تصویر بالا</label>
                            <input type="file" name="pic_top" id="pic_top" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="pic">تصویر</label>
                            <input type="file" name="pic" id="pic" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <div class="form-group">
                            <label for="des">توضیحات</label>
                            <textarea name="des" id="des" rows="6" style="width: 100%;" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="is_rtl" id="is_rtl" checked="checked">
                                <label class="custom-control-label" for="is_rtl">راست چین</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3" id="tables">
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-0"></div>
                    <div class="offset-md-3 col-md-6 col-sm-12">
                        <button type="button" class="btn btn-outline-info btn-block" style="font-size: 0.5em; font-weight: bold" onclick="AddTbl();">اضـــافـــه کـــردن جـــدول</button>
                    </div>
                    <div class="col-md-3 col-sm-0"></div>
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

    <div class="hidden" id="samples">
        <div id="sample_table">
            <div class="row mb-2 pb-2" id="tbl_TBL-NO" style="border-bottom: solid 1px #000;">
                <input type="hidden" id="tbl_TBL-NO_lastChild" class="form-control" value="1" />
                <div class="col-12 input-group mb-1">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="AddRowForTbl(TBL-NO);">سطر اضافه</button>
                    </div>
                    <input type="text" name="tbl[TBL-NO][title]" class="form-control" value="table_title" placeholder="عنوان جدول TBL-NO" />
                </div>
                TBL-LST-CHD
            </div>
        </div>
        <div id="sample_table_row">
            <div class="col-12 input-group mb-1" id="tbl_TBL-NO_row_TBL-ROW-NO">
                <input type="text" name="tbl[TBL-NO][rows][TBL-ROW-NO][title]" class="form-control" value="child_title" placeholder="عنوان سطر TBL-ROW-NO" />
                <input type="text" name="tbl[TBL-NO][rows][TBL-ROW-NO][value]" class="form-control" value="child_value" placeholder="مقدار سطر TBL-ROW-NO" />
                <button type="button" class="btn btn-danger" onclick="delRowForTbl(TBL-NO, TBL-ROW-NO)">-</button>
            </div>
            {{--<div class="col-md-6 col-sm-12 mb-1">
                <input type="text" name="tbl[TBL-NO][title][TBL-ROW-NO][title]" class="form-control" placeholder="عنوان سطر TBL-ROW-NO" />
            </div>
            <div class="col-md-6 col-sm-12 mb-1">
                <input type="text" name="tbl[TBL-NO][title][TBL-ROW-NO][value]" class="form-control" placeholder="مقدار سطر TBL-ROW-NO" />
            </div>--}}
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
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th class="operations">عملیات</th>
                        </tr>
                    </thead>
                    <tfoot class="englishAll">
                        <tr>
                            <th class="no">#</th>
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th class="operations">عملیات</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                      @foreach($Wires as $wire)
                        <tr>
                            <td class="no">{{ $i++ }}</td>
                            <td id="row_{{ $wire->id }}_title">{{ $wire->title }}</td>
                            <td id="row_{{ $wire->id }}_des">{{ $wire->des }}</td>
                            {{--<div class="hidden" id="row_{{ $wire->id }}_tables">{{ $wire->tables }}</div>--}}
                            <input type="hidden" id="row_{{ $wire->id }}_pic" value="{{ $wire->pic }}" />
                            <input type="hidden" id="row_{{ $wire->id }}_pic_top" value="{{ $wire->pic_top }}" />
                            <td class="operations">
                                <a href="{{ url('/wire/delete/' . $wire->id) }}" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <button type="button" class="btn btn-info" onclick="EditWire({{ $wire->id }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="{{ url('/api/wire/show/android/' . $wire->id ) }}" class="btn btn-outline-success" target="_blank">
                                    <i class="fas fa-eye"></i>
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

@section('css')
@endsection

@section('js')
    <script type="text/javascript">
        var tblNo = 0;
        function AddTbl(tblTitle, chdTitle, chdValue) {
            if(tblTitle === undefined) tblTitle = "";
            if(chdTitle === undefined) chdTitle = "";
            if(chdValue === undefined) chdValue = "";
            tblNo++;
            var chdDiv = $("#sample_table_row").html().split('TBL-ROW-NO').join(1);
            chdDiv = chdDiv.split('child_title').join(chdTitle);
            chdDiv = chdDiv.split('child_value').join(chdValue);
            var tblDiv = $("#sample_table").html().replace('TBL-LST-CHD', chdDiv);
            tblDiv = tblDiv.split('table_title').join(tblTitle);
            tblDiv = tblDiv.split('TBL-NO').join(tblNo);
            $("#tables").append(tblDiv);
        }

        function AddRowForTbl(no, chdTitle, chdValue) {
            if(chdTitle === undefined) chdTitle = "";
            if(chdValue === undefined) chdValue = "";
            var chdIpt = $("#tbl_" + no + "_lastChild");
            var chdNo = chdIpt.val();
            var chdDiv = $("#sample_table_row").html().split('TBL-ROW-NO').join(++chdNo);
            chdDiv = chdDiv.split('child_title').join(chdTitle);
            chdDiv = chdDiv.split('child_value').join(chdValue);
            chdIpt.val(chdNo);
            chdDiv = chdDiv.split('TBL-NO').join(no);
            $("#tbl_" + no).append(chdDiv);
        }

        function delRowForTbl(tblNo, rowNo) {
            var tbl = $("#tbl_" + tblNo);
            var count = tbl.children().length;
            //console.log('children count: ' + count);
            if(count > 3) {
                $("#tbl_" + tblNo + "_row_" + rowNo).remove();
            } else {
                tbl.remove();
            }
        }

        /* ========================================================================================================== */

        var $Tables = {!! $Tables !!};
        var $url = "{{ $url }}";
        function EditWire(id) {
            $("form").attr("action", "{{ url('wire') }}/" + id);
            // console.clear();
            // console.log(id);
            // console.log("#row_" + id + "_tables");
            var tables = $Tables[id];
            // console.log(tables);
            //console.log(tables[1].title);
            // console.log($Tables);
            // console.log("\n\n");

            ResetForm(false);
            $("#btn_submit").addClass("hidden");
            $("#btn_edit").removeClass("hidden");

            $("#title").val($("#row_" + id + "_title").html());
            $("#des").val($("#row_" + id + "_des").html());

            $.each(tables, function(index, table) {
                var tblTitle = (table.title == null) ? "" : table.title;
                var chdTitle = "", chdValue = "";
                if(Object.keys(table.rows).length > 0) {
                    chdTitle = (table.rows[1].title == null) ? "" : table.rows[1].title;
                    chdValue = (table.rows[1].value == null) ? "" : table.rows[1].value;
                }
                // chdTitle = Object.keys(table.rows).length;
                AddTbl(tblTitle, chdTitle, chdValue);

                if(Object.keys(table.rows).length > 1) {
                    $.each(table.rows, function(i, row) {
                        if(i > 1) {
                            var chdTitle = (row.title == null) ? "" : row.title;
                            var chdValue = (row.value == null) ? "" : row.value;
                            AddRowForTbl(tblNo, chdTitle, chdValue);
                        }
                    });
                }
            });

            $("#wire-form-div").collapse("show");
        }

        function ResetForm(close) {
            if(close) $("form").attr("action", "{{ url('wire') }}");
            if(close == undefined) close = true;
            {{--$("form").attr("action", "{{ url('company') }}");--}}
            $("#btn_submit").removeClass("hidden");
            $("#btn_edit").addClass("hidden");
            $("#title").val("");
            $("#des").val("");
            $("#tables").html("");
            tblNo = 0;
            if(close) $("#wire-form-div").collapse("hide");
        }
    </script>
@endsection

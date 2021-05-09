@extends('layouts.app')

@section('content')
    <h1 class="my-4 rem-4">خبر</h1>
    {{--<ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Tables</li>
    </ol>--}}
    <div class="card mb-4">
        <a href="#news-form-div"  data-toggle="collapse" class="card-header"><i class="fas fa-newspaper ml-1"></i>فرم خبر جدید</a>
        <div class="card-body collapse" id="news-form-div">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">عنوان</label>
                        <input type="text" name="title" id="title" class="form-control" />
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label for="pic">تصویر</label>
                        <input type="file" name="pic" id="pic" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 form-group">
                        <label for="summery">خلاصه</label>
                        <textarea name="summery" id="summery" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label for="des">ادامه</label>
                        <textarea name="des" id="des" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-0"></div>
                    <div class="offset-md-3 col-md-6 col-sm-12">
                        <input type="submit" value="درج خبر" class="btn btn-success btn-block" />
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="englishAll">
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>خلاصه</th>
                            {{--<th>Office</th>--}}
                        </tr>
                    </thead>
                    <tfoot class="englishAll">
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>خلاصه</th>
                            {{--<th>Office</th>--}}
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                      @foreach($News as $oneNews)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $oneNews->title }}</td>
                            <td>{{ $oneNews->summery }}</td>
                            {{--<td>Edinburgh</td>--}}
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

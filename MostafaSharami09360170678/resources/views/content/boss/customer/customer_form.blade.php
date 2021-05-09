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
                            <label for="co">شرکت</label>
                            <select name="co" id="co" class="custom-select">
                                {{--<option disabled selected>لطفا دسته شرکت را انتخاب کنید</option>--}}
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" title="{{ $company->des }}">{{ $company->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <div class="form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" name="email" id="email" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <div class="form-group">
                            <label for="mobile">موبایل</label>
                            <input type="tel" name="mobile" id="mobile" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="password">گذرواژه</label>
                            <input type="password" name="password" id="password" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <div class="form-group">
                            <label for="password_confirmation">تکرار گذرواژه</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="birthday">تاریخ تولد</label>
                            <input type="text" name="birthday" id="birthday" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-0"></div>
                    <div class="offset-md-3 col-md-6 col-sm-12">
                        <input type="submit" value="درج {{ $title }}" class="btn btn-success btn-block" />
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
                            <th class="no">#</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>موبایل</th>
                            <th>شرکت</th>
                            <th>تاریخ تولد</th>
                            <th class="operations">عملیات</th>
                        </tr>
                    </thead>
                    <tfoot class="englishAll">
                        <tr>
                            <th class="no">#</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>موبایل</th>
                            <th>شرکت</th>
                            <th>تاریخ تولد</th>
                            <th class="operations">عملیات</th>
                        </tr>
                    </tfoot>
                    <tbody>
				    <?php $i = 1; ?>
                    @foreach($customers as $customer)
                        <tr>
                            <td class="no">{{ $i++ }}</td>
                            <td>{{ $customer->User->name }}</td>
                            <td>{{ $customer->User->email }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->Co->title }}</td>
                            <td>{{ $customer->birthday }}</td>
                            <td class="operations">
                                <a href="{{ url('/message/' . $customer->user) }}" class="btn btn-outline-success">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="{{ url('/customer/delete/' . $customer->id) }}" class="btn btn-danger">
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

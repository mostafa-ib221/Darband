@extends('layouts.boss.index')

@section('content')
    <h1 class="my-4 rem-4">{{ $title }}</h1>
    <div class="row">
        <div class="col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="address">Address</label>
                    </div>
                    <input type="hidden" name="caption" value="address" />
                    <input type="text" name="value" id="address" class="form-control" placeholder="Please enter address of restaurant" aria-label="Please enter address of restaurant" aria-describedby="basic-addon2" value="{{ isset($contacts['address']) ? $contacts['address'] : '' }}" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="open_day_from">Open day from</label>
                    </div>
                    <input type="hidden" name="caption" value="open_day_from" />
                    <select name="value" id="open_day_from" class="custom-select" onchange="makeDisable('open_day_from_disable')">
                        <option value="" id="open_day_from_disable">select open day to</option>
                        @php($open_day_from = isset($contacts['open_day_from']) ? $contacts['open_day_from'] : '')
                        <option value="Sunday" @if($open_day_from == 'Sunday') selected @endif>Sunday</option>
                        <option value="Monday" @if($open_day_from == 'Monday') selected @endif>Monday</option>
                        <option value="Tuesday" @if($open_day_from == 'Tuesday') selected @endif>Tuesday</option>
                        <option value="Wednesday" @if($open_day_from == 'Wednesday') selected @endif>Wednesday</option>
                        <option value="Thursday" @if($open_day_from == 'Thursday') selected @endif>Thursday</option>
                        <option value="Friday" @if($open_day_from == 'Friday') selected @endif>Friday</option>
                        <option value="Saturday" @if($open_day_from == 'Saturday') selected @endif>Saturday</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="open_day_to">Open day to</label>
                    </div>
                    <input type="hidden" name="caption" value="open_day_to" />
                    <select name="value" id="open_day_to"  class="custom-select" onchange="makeDisable('open_day_to_disable')">
                        <option value="" id="open_day_to_disable">select open day to</option>
                        @php($open_day_to = isset($contacts['open_day_to']) ? $contacts['open_day_to'] : '')
                        <option value="Sunday" @if($open_day_to == 'Sunday') selected @endif>Sunday</option>
                        <option value="Monday" @if($open_day_to == 'Monday') selected @endif>Monday</option>
                        <option value="Tuesday" @if($open_day_to == 'Tuesday') selected @endif>Tuesday</option>
                        <option value="Wednesday" @if($open_day_to == 'Wednesday') selected @endif>Wednesday</option>
                        <option value="Thursday" @if($open_day_to == 'Thursday') selected @endif>Thursday</option>
                        <option value="Friday" @if($open_day_to == 'Friday') selected @endif>Friday</option>
                        <option value="Saturday" @if($open_day_to == 'Saturday') selected @endif>Saturday</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="open_time_from">Open time from</label>
                    </div>
                    <input type="hidden" name="caption" value="open_time_from" />
                    <select name="value" id="open_time_from" class="custom-select" onchange="makeDisable('open_time_from_disable')">
                        <option value="" id="open_time_from_disable">select open time to</option>
                        @php($open_time_from = isset($contacts['open_time_from']) ? $contacts['open_time_from'] : '')
                      @foreach(['AM', 'PM'] as $ap)
                       @for($i=1; $i<=12; $i++)
                        @php($time = (($i<10) ? '0'.$i : $i) . ' ' . $ap)
                        <option value="{{ $time }}" @if($open_time_from == $time) selected @endif>{{ $time }}</option>
                       @endfor
                      @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="open_time_to">Open time to</label>
                    </div>
                    <input type="hidden" name="caption" value="open_time_to" />
                    <select name="value" id="open_time_to"  class="custom-select" onchange="makeDisable('open_time_to_disable')">
                        <option value="" id="open_time_to_disable">select time day to</option>
                        @php($open_time_to = isset($contacts['open_time_to']) ? $contacts['open_time_to'] : '')
                      @foreach(['AM', 'PM'] as $ap)
                       @for($i=1; $i<=12; $i++)
                        @php($time = (($i<10) ? '0'.$i : $i) . ' ' . $ap)
                        <option value="{{ $time }}" @if($open_time_to == $time) selected @endif>{{ $time }}</option>
                       @endfor
                      @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="phone">Phone Number</label>
                    </div>
                    <input type="hidden" name="caption" value="phone" />
                    <input type="text" name="value" id="phone" class="form-control" placeholder="Please enter phone number of restaurant" aria-label="Please enter phone number of restaurant" aria-describedby="basic-addon2" value="{{ isset($contacts['phone']) ? $contacts['phone'] : '' }}" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function makeDisable(id) {
            console.clear();
            console.log('=============================> START');
            $("#"+id).attr("disable", "disable");
            console.log('=============================> END');
        }
    </script>
@endsection

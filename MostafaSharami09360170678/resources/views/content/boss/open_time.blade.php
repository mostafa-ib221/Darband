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

        .custom-checkbox {
            margin: auto;
        }
    </style>
@endsection

@section('content')
    <h1 class="my-4 rem-4">{!! $title !!}</h1>
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="date_from">Date From</label>
                    </div>
                    <input type="date" name="date_from" id="date_from" class="form-control" placeholder="Please enter date from" aria-label="Please enter date from" aria-describedby="basic-addon2" value="{{ old('date_from') }}" required />
                </div>
            </div>
            <div class="col-md-6 col-sm-12 form-inline justify-content-center mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="day_Mon" name="days[Mon]" required>
                    <label class="custom-control-label" for="day_Mon">Monday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="day_Tue" name="days[Tue]" required>
                    <label class="custom-control-label" for="day_Tue">Tuesday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="day_Wed" name="days[Wed]" required>
                    <label class="custom-control-label" for="day_Wed">Wednesday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="day_Thu" name="days[Thu]" required>
                    <label class="custom-control-label" for="day_Thu">Thursday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="day_Fri" name="days[Fri]" required>
                    <label class="custom-control-label" for="day_Fri">Friday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="day_Sat" name="days[Sat]" required>
                    <label class="custom-control-label" for="day_Sat">Saturday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="day_Sun" name="days[Sun]" required>
                    <label class="custom-control-label" for="day_Sun">Sunday</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text bg-light" for="time_from">Time From</label>
                        </div>
                        <input type="number" min="0" max="23" step="1" name="time_from" id="time_from" class="form-control" placeholder="Please enter time from in 24 system" aria-label="Please enter time from in 24 system" aria-describedby="basic-addon2" value="{{ old('time_from') }}" required />
                    </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="time_to">Time To</label>
                    </div>
                    <input type="number" min="0" max="23" step="1" name="time_to" id="time_to" class="form-control" placeholder="Please enter time to in 24 system" aria-label="Please enter time to in 24 system" aria-describedby="basic-addon2" value="{{ old('time_to') }}" required />
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="period">Period of Hour</label>
                    </div>
                    <input type="number" min="1" step="1" name="period" id="period" class="form-control" placeholder="Please enter period of time" aria-label="Please enter period of time" aria-describedby="basic-addon2" value="{{ old('period', 1) }}" required />
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
                        <th>From</th>
                        <th>To</th>
                        <th>Days</th>
                        <th>Times</th>
                        <th class="operations">operations</th>
                    </tr>
                </thead>
                <tbody>
	            <?php $i = 1; ?>
                @foreach($OpenTimes as $openTime)
                    <tr>
                        <td id="row_{{ $openTime->id }}_date_from">{{ $openTime->date_from }}</td>
                        <td id="row_{{ $openTime->id }}_date_to">{{ $openTime->date_to }}</td>
                        <td>{{ $openTime->mackDaysList() }}</td>
                        <td id="row_{{ $openTime->id }}_times">{!! implode('<br />', $openTime->mackTimesList()) !!}</td>
                        <td class="operations pt-2">
                            {{--<input type="hidden" id="row_{{ $openTime->id }}_days" value="{!! $openTime->mackDaysList(false) !!}" />--}}
                            <input type="hidden" id="row_{{ $openTime->id }}_days" value="{{ $openTime->days }}" />
                            <input type="hidden" id="row_{{ $openTime->id }}_time_info" value="{{ $openTime->time_info }}" />
                            <button type="button" class="btn btn-info my-1" onclick="EditOpenTimes({{ $openTime->id }})">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <form action="{{ url('/boss/open/times/' . $openTime->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                              @if($openTime->active)
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-lock-open"></i>
                                </button>
                              @else
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-lock"></i>
                                </button>
                              @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br />
            {{ $OpenTimes->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        checks = 0;
        function EditOpenTimes(id) {
            $("form").attr("action", "{{ url('/boss/open/times/') }}/" + id);
            $("#btn_reset").removeClass("hidden");
            $("#date_from").val($('#row_' + id + '_date_from').html());
            //$("#date_to").val($('#row_' + id + '_date_to').html());

            var days = $('#row_' + id + '_days').val();
            days = JSON.parse(days);
            $.each(days, function(i, day) {
                $("#day_" + day).prop("checked", true);
                checks++;
                if(checks > 7) checks = 7;
            });
            if(checks > 0) {
                $('.custom-control-input').removeAttr('required');
            } else {
                $('.custom-control-input').attr('required', 'required');
            }

            var info = $('#row_' + id + '_time_info').val();
            info = JSON.parse(info);
            $("#time_from").val(info.from);
            $("#time_to").val(info.to);
            $("#period").val(info.period);
            console.clear();
            console.log(info);
            console.log(typeof info);
            $("body").scrollTop();
        }

        function ResetForm() {
            $("form").attr("action", "{{ url('/boss/open/times') }}");
            $("#btn_reset").addClass("hidden");
            $("#date_from").val("");
            $('.custom-control-input').prop("checked", false).attr('required', 'required');
            checks = 0;
            $("#date_to").val("");
            $("#time_from").val("");
            $("#time_to").val("");
        }

        $(".custom-control-input").on("click", function () {
          if($(this).prop("checked")) {
              checks++;
              if(checks > 7) checks = 7;
          } else {
              checks--;
              if(checks < 0) checks = 0;
          }

          if(checks > 0) {
              $('.custom-control-input').removeAttr('required');
          } else {
              $('.custom-control-input').attr('required', 'required');
          }
        });
    </script>
@endsection

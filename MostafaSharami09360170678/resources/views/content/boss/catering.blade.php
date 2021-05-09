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
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h1 class="my-4 rem-4">{!! $title !!}</h1>
        </div>
        <div class="col-md-6 col-sm-12">
          @if($show)
            <a href="{{ url('/boss/catering/reading/hide') }}" class="btn btn-warning btn-sm mt-5">
                hidden reading comments
            </a>
          @else
            <a href="{{ url('/boss/catering/reading/show') }}" class="btn btn-success btn-sm mt-5">
                show reading comments
            </a>
          @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>eMail</th>
                        <th>Number</th>
                        <th>Date</th>
                        <th>comment</th>
                        <th class="operations">status</th>
                    </tr>
                </thead>
                <tbody>
	            <?php $i = 1; ?>
                @foreach($caterings as $catering)
                    <tr>
                        <td>{{ $catering->name }}</td>
                        <td>{{ $catering->email }}</td>
                        <td>{{ $catering->number }}</td>
                        <td>{{ $catering->date }}</td>
                        <td>{{ $catering->comment }}</td>
                        <td class="operations pt-2">
                          @if($catering->read)
                            <button type="button" class="btn btn-secondary">
                                <i class="fas fa-envelope-open"></i>
                            </button>
                          @else
                            <a href="{{ url('/boss/catering/read/' . $catering->id) }}" class="btn btn-info">
                                <i class="fas fa-envelope"></i>
                            </a>
                          @endif
                            <a href="{{ url('/boss/catering/delete/' . $catering->id) }}" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br />
            {{ $caterings->links() }}
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

@extends('layouts.boss.index')

@section('content')
    <h1 class="my-4 rem-4">{!! $title !!}</h1>

    <hr />

    <div class="row">
        <div class="col-12 table-responsive">
            <div id="accordion">
              @foreach($histories as $index => $history)
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapse{{ $history->id  }}">
                            <div class="row">
                                <div class="col-md-2 col-sm-4">created at: <strong>{{ $history->created_at }}</strong></div>
                                <div class="col-md-2 col-sm-4"><strong>{{ $history->date_time }}</strong></div>
                                <div class="col-md-2 col-sm-4">
                                    @php($paid = $history->pey_type == 'online' ? ($history->pey_status == '' ? ', <font class="text-danger">not paid</font>' : ', <font class="text-success">paid</font>') : '')
                                    @php($link = (($history->pey_type == 'online') && ($history->pey_status == '')) ? '<a href="' . url('/payment/details/'.$history->order_no) . '" target="_blank">pay link</a>' : '')
                                    payment type: <strong>{{ $history->pey_type }}</strong>{!! $paid !!}<font class="text-danger"></font>
                                </div>
                                <div class="col-md-2 col-sm-4">total: ${{ $history->order->priceAll }}</div>
                                <div class="col-md-2 col-sm-4">Number: <strong>{{ $history->order_no }}</strong></div>
                                <div class="col-md-2 col-sm-4">
                                    @if($history->status == 1)
                                        <font class="text-success">Confirm</font>
                                    @else
                                        <font class="text-danger">Cancel</font>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                    <div id="collapse{{ $history->id  }}" class="collapse" data-parent="#accordion">
                        {!! $link !!}
                        <div class="card-body row">
                            <div class="col-md-5 col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kale Pache</th>
                                            <th>Extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($history->order->items as $item)
                                        <tr>
                                            <td>{{ $item->name }} X {{ $item->no }}</td>
                                            <td>
                                             @if(!empty($item->extra->items))
                                              @foreach($item->extra->items as $extra)
                                                    {{ $extra->name }} X {{ $extra->no }}<br />
                                              @endforeach
                                             @endif
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <h3 style="border-bottom: solid 1px #5a6268">Options</h3>
                               @foreach($history->order->options->items as $item)
                                {{ $item->name }} X {{ $item->no }}<br />
                               @endforeach
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h3 style="border-bottom: solid 1px #5a6268">Delivery Information</h3>
                                <div class="row">
                                    <div class="col-4 text-right">name: </div><strong class="col-8">{{ $history->address->name }}</strong><br />
                                </div>
                                <div class="row">
                                    <div class="col-4 text-right">Flat No: </div><strong class="col-8">{{ $history->address->flat_no }}</strong><br />
                                </div>
                                <div class="row">
                                    <div class="col-4 text-right">Address: </div><strong class="col-8">{{ $history->address->addresss }}</strong><br />
                                </div>
                                <div class="row">
                                    <div class="col-4 text-right">Postcode: </div><strong class="col-8">{{ $history->address->postcode }}</strong><br />
                                </div>
                                <div class="row">
                                    <div class="col-4 text-right">Phone: </div><strong class="col-8">{{ $history->address->phone }}</strong><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>
            <br />
            {{ $histories->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function EditOption(id) {
            $("form").attr("action", "{{ url('/boss/dishes/options/') }}/" + id);
            $("#btn_reset").removeClass("hidden");
            $("#title").val($('#row_' + id + '_title').html());
            $("#description").val($('#row_' + id + '_des').html());
            $("#price").val($('#row_' + id + '_price').html());
            $("body").scrollTop();
        }

        function ResetForm() {
            $("form").attr("action", "{{ url('/boss/dishes/options') }}");
            $("#btn_reset").addClass("hidden");
            $("#title").val("");
            $("#description").val("");
            $("#price").val("");
        }

        function getNew() {
            $.get("{{ url('/boss/order/live/get/new/' . $LastId) }}", function(data, status){
                if(data > 0) window.location = "{{ url('/boss/live/orders') }}";
            });
        }

        $(document).ready(function() {
            setInterval(getNew, 15000);
        });
    </script>
@endsection

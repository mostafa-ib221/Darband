@extends('layouts.boss.index')

@section('content')
    <h1 class="my-4 rem-4">{!! $title !!}</h1>
    {{--<form method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="title">Title</label>
                    </div>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Please enter title" aria-label="Please enter title" aria-describedby="basic-addon2" value="{{ old('title') }}" required />
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="price">Price</label>
                    </div>
                    <input type="number" min="1.00" step="0.01" name="price" id="price" class="form-control" placeholder="Please enter price" aria-label="Please enter price" aria-describedby="basic-addon2" value="{{ old('price') }}" required />
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="description">Description</label>
                    </div>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Please enter description" aria-label="Please enter description" aria-describedby="basic-addon2" value="{{ old('description') }}" />
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
    </form>--}}

    <hr />

    <div class="row">
        <div class="col-12 table-responsive">
            <div id="accordion">
              @foreach($lives as $index => $live)
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapse{{ $live->id  }}">
                            <div class="row">
                                <div class="col-md-2 col-sm-4">created at: <strong>{{ $live->created_at }}</strong></div>
                                <div class="col-md-3 col-sm-6"><strong>{{ $live->date_time }}</strong></div>
                                <div class="col-md-3 col-sm-4">
                                    @php($paid = $live->pey_type == 'online' ? ($live->pey_status == '' ? ', <font class="text-danger">not paid</font>' : ', <font class="text-success">paid</font>') : '')
                                    @php($link = (($live->pey_type == 'online') && ($live->pey_status == '')) ? '<a href="' . url('/payment/details/'.$live->order_no) . '" target="_blank">pay link</a>' : '')
                                    payment type: <strong>{{ $live->pey_type }}</strong>{!! $paid !!}<font class="text-danger"></font>
                                </div>
                                <div class="col-md-2 col-sm-4">total: ${{ $live->order->priceAll }}</div>
                                <div class="col-md-2 col-sm-4">Number: <strong>{{ $live->order_no }}</strong></div>
                            </div>
                        </a>
                    </div>
                    <div id="collapse{{ $live->id  }}" class="collapse @if($index == 0) show @endif" data-parent="#accordion">
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
                                      @foreach($live->order->items as $item)
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
                               @foreach($live->order->options->items as $item)
                                {{ $item->name }} X {{ $item->no }}<br />
                               @endforeach
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h3 style="border-bottom: solid 1px #5a6268">Delivery Information</h3>
                                <div class="row">
                                    <div class="col-4 text-right">name: </div><strong class="col-8">{{ $live->address->name }}</strong><br />
                                </div>
                                <div class="row">
                                    <div class="col-4 text-right">Flat No: </div><strong class="col-8">{{ $live->address->flat_no }}</strong><br />
                                </div>
                                <div class="row">
                                    <div class="col-4 text-right">Address: </div><strong class="col-8">{{ $live->address->addresss }}</strong><br />
                                </div>
                                <div class="row">
                                    <div class="col-4 text-right">Postcode: </div><strong class="col-8">{{ $live->address->postcode }}</strong><br />
                                </div>
                                <div class="row">
                                    <div class="col-4 text-right">Phone: </div><strong class="col-8">{{ $live->address->phone }}</strong><br />
                                </div>
                            </div>
                            <div class="offset-md-6 col-md-6 col-sm-12">
                                <a href="{{ url('/boss/order/cancel/' . $live->id) }}" class="btn btn-danger">Cancel</a>
                                <a href="{{ url('/boss/order/confirm/' . $live->id) }}" class="btn btn-success">Confirm</a>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>
            <br />
            {{ $lives->links() }}
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
                if(data > 0) window.location = "{{ url('/boss/order/live') }}";
            });
        }

        $(document).ready(function() {
            setInterval(getNew, 15000);
        });
    </script>
@endsection

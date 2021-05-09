@extends('layouts.app')

@section('content')
    <h1 class="my-4 rem-4">{{ $title }}</h1>
    <div class="row">
        <div class="col-12">
            <div id="accordion">
              @foreach($companies as $company)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{ $company['id'] }}" aria-expanded="true" aria-controls="collapse_{{ $company['id'] }}">
                                {{ $company['title'] }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapse_{{ $company['id'] }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="list-group">
                              @foreach($company['customer'] as $customer)
                               @if(isset($customer['chat']) && $customer['chat'])
                                <a href="{{ url('/message/user/' . $customer['id']) }}" class="list-group-item list-group-item-action">{{ $customer['name'] }}</a>
                               @else
                                <a href="{{ url('/message/' . $customer['user']['id']) }}" class="list-group-item list-group-item-action">{{ $customer['user']['name'] }}</a>
                               @endif
                              @endforeach
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>
        </div>
    </div>
@endsection

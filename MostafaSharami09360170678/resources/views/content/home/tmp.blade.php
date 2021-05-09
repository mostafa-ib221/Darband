@php($ids = ['Main'=> 'Main Course', 'Signatures'=>'Darband Signatures', 'Traditional'=>'Traditional Dishes', 'Stews'=>'Stews with Rice', 'Sticks'=>'Sticks', 'Appetizers'=>'Cold Appetizers', 'Appetizer'=>'Hot Appetizers'])
<div class="row">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        @foreach ($ids as $id => $value)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($id=='Main') active @endif" id="pills-{{ $id }}-tab" data-toggle="pill" href="#pills-{{ $id }}" role="tab" aria-controls="pills-{{ $id }}" aria-selected="@if($id=='Main') true @else false @endif">{{ $value }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="pills-tabContent">
        @foreach ($ids as $id => $value)
            <div class="tab-pane fade @if($id=='Main') active show @endif" id="pills-{{ $id }}" role="tabpanel" aria-labelledby="pills-{{ $id }}-tab">
                <div class="row">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-md-3">
                            <div class="card">
                                <img class="card-img-top" src="asset/image/j3g6fdvk.png" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $id }}</h5>
                                    <p class="card-text">{{ $value }}</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="col-md-12 mt-style">
    <button class="sale-btn1"><img src="asset/image/Group 572.png" width="100%"></button>
</div>

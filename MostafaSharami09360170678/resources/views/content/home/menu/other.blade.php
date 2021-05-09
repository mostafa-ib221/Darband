{{--section4------------------------------------------------------------------------}}
<section class="section4 mb-5">
    <div class="container-fluid">
     @foreach (FOOD_CAT as $id => $value)
      @if($id !== 'Explore')
       @if(isset($others[$id]) && (count($others[$id]) > 0))
        <div class="row">
            <div class="col-md-12 text-center py-5">
                <span class="section4-title">{{ $value }}</span></div>

           @foreach($others[$id] as $other)
            <div class="col-md-3 padding-mobile mb-3">
                <div class="card">
                    <img class="card-img-top" src="{{ $other->pic }}" alt="Order this meal through Uber Eats" title="Order this meal through Uber Eats">
                    <div class="msg-dark">Order this meal through Uber Eats</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $other->title }}</h5>
                        <p class="card-text" style="height: 80px">{{ substr($other->description, 0, 86) }}</p>
                        <p class="price">${{ $other->price }}</p>
                    </div>
                </div>
            </div>
           @endforeach
        </div>
       @endif
      @endif
     @endforeach
    </div>
</section>
{{--section4-----------------------------------------------------------------------------}}

@extends('layouts.boss.index')

@section('content')
    <h1 class="my-4 rem-4">{!! $title !!}</h1>
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="price">Total Price Under</label>
                    </div>
                    <input type="number" min="1.00" step="0.01" name="price" id="price" class="form-control" placeholder="Please enter price" aria-label="Please enter price" aria-describedby="basic-addon2" value="{{ old('price', (isset($df->price) ? $df->price : '')) }}" required />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-light" for="delivery_fee">Delivery Fee</label>
                    </div>
                    <input type="number" min="1.00" step="0.01" name="delivery_fee" id="delivery_fee" class="form-control" placeholder="Please enter Delivery Fee" aria-label="Please enter Delivery Fee" aria-describedby="basic-addon2" value="{{ old('delivery_fee', (isset($df->delivery_fee) ? $df->delivery_fee : '')) }}" required />
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
@endsection

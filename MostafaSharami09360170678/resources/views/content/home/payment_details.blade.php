@extends('layouts.home.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('home/css/payment_details.css') }}" />
@endsection

@section('js_head')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <!-- section1------------------------------------------------- -->
    <section class="section-oadding">
        <div class="container-fluid">
            <div class="paddding-stle">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <p class="title-left">Payment Details</p>

                        <form id="payment-form" method="POST">
                            @csrf
                            <div class="col-12 col-sm-12  col-md-7">
                                <label for="effect-1 " class="lbl">
                                    Name on card
                                </label>
                                <input class="effect-1" type="text" name="name_on_card" id="name_on_card" required />
                                <span class="focus-border"></span>
                            </div>
                            {{--<div class="col-12 col-sm-12 col-md-7 pt-4">
                                <label for="effect-1 " class="lbl">
                                    Card number
                                </label>
                                <input class="effect-1" type="text">
                                <span class="focus-border"></span>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="col-md-12 mt-4">
                                            <label for="effect-1 " class="lbl">
                                                Expiration
                                            </label>
                                        </div>

                                        <span class="expiration">
                                            <input name="month" maxlength="2" size="2" class="number" />
                                            <span class="slash">/</span>
                                        <input name="year" maxlength="2" size="2" class="number" />
                                        </span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md-12 mt-4">
                                            <label for="effect-1 " class="lbl">
                                                CVC
                                            </label>

                                        </div>
                                        <input class="effect-1 mt-1" type="text">
                                    </div>
                                </div>
                            </div>--}}
                            <div class="col-12 col-sm-12  col-md-7">
                                <div class="form-group w-100">
                                    <label for="card-element">
                                        Credit or debit card
                                    </label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <button class="btn btn-Payment">
                                    Submit Order
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <p class="title-left">Order Details</p>
                        @foreach($order->order->items as $items)
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4">
                                    <p class="number-order">{{ $items->no }}X</p>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4">
                                    <p class="name-order">{{ $items->name }}</p>
                                </div>
                                <div class="col-4 col-sm-4col-md-4">
                                    <p class="price-order">${{ $items->price }}</p>
                                </div>

                            </div>
                        @endforeach
                        @foreach($order->order->options->items as $items)
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4">
                                    <p class="number-order">{{ $items->no }}X</p>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4">
                                    <p class="name-order">{{ $items->name }}</p>
                                </div>
                                <div class="col-4 col-sm-4col-md-4">
                                    <p class="price-order">${{ $items->price }}</p>
                                </div>

                            </div>
                        @endforeach
                        <hr>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-4">
                                <p class="number-order"></p>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <p class="name-order">Delivery Fee</p>
                            </div>
                            <div class="col-4 col-sm-4col-md-4">
                                <p class="price-order">${{ $order->order->delivery_fee }}</p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="lbl">Deliver in</p>
                            </div>
                            <div class="col-5 col-sm-5 col-md-5 pt-4">
                                @php($date = explode(' , ', $order->date_time))
                                <p class="deliver">{{ $date[0] }}</p>
                            </div>
                            <div class="col-7 col-sm-7 col-md-7 pt-4">
                                <span>{{ $date[01] }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <p class="lbl">Delivery Address</p>
                        </div>
                        <div class="col-12 col-md-12">
                            <p class="lbl1">{{ $order->address->name }}</p>
                            <p class="lbl1">{{ $order->address->flat_no }}, {{ $order->address->addresss }}, {{ $order->address->postcode }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./section1------------------------------------------------ -->
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Create a Stripe client.
            // var stripe = Stripe('pk_test_51Hahm5AXfjw1fvBetcvdxqU3ptxoeFb0iHEQXLCjKoq24w9xYSjGpHZfzc9AovseLHHyC3tH7jnzjmjH4xwfSKJ900dWBuIUHg');
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            // var stripe = Stripe('pk_live_51Hahm5AXfjw1fvBez3pJT8O377fth07dePRn2JcozbWVsoybx2fTUlUjmdXP4qDbwYgCwc0xVoOfschkjCzipysM008mxDnoGT');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)زخ
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                var options = {
                    name: $("#name_on_card").val(),
                    address_line1: "{{ $order->address->addresss }}",
                    address_zip: "{{ $order->address->postcode }}",
                    phone: "{{ $order->address->phone }}"
                };

                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        });
    </script>
@endsection

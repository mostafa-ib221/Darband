@extends('layouts.home.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('home/css/checkout.css') }}" />
    <style>
        .cell.active {
            cursor: pointer;
        }
        .cell.active.selected, .cell.active:hover {
            background: #c79c45;
            color: white;
            border-radius: 5px;
            font-weight: bolder;
        }
    </style>
@endsection

@section('content')
  @if(\Session::has('error'))
    <div class="alert alert-danger alert-dismissible mg-b-0 fade show mb-2"  role="alert">
        <p> {{ session('error') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
  @endif
    <!-- section1------------------------------------------------------ -->
    <section class="section1">
        <div class="container-fluid">
            <div class="row" style="font-weight: bold;">
                <div class="col-md-6">
                    <div class="col-md-12">

                        <div class="col-md-12">
                            <p class="section1-title">Items</p>
                        </div>
                    </div>
                    @foreach($basket['items'] as $key => $item)
                        <div class="col-md-12">
                            <div id="basket_items">
                                <div class="row basket-item-{{ $key }}">
                                    <div class="col-2 col-md-2  col-lg-2">
                                        <p class="section1-p1">{{ $item['no'] }}X</p>
                                    </div>
                                    <div class="col-4 col-md-4  col-lg-4">
                                        <p class="section1-name">{{ $item['name'] }}</p>
                                    </div>
                                    <div class="col-4 col-md-4 col-lg-5">
                                        <p class="section1-price">${{ $item['price'] }}</p>
                                    </div>
                                    <div class="col-2 col-sm-1  col-md-2 col-lg-1 hand basket-close-item" data-number="{{ $key }}">
                                        <img src="{{ asset('home/img/Icon ionic-ios-close-mines.png') }}" alt="" width="80%">
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="col-md-12">
                        <div id="basket_items">
                            <div class="row">
                                <div class="col-2 col-md-2 col-lg-2">
                                    <p class="section1-p1"> </p>
                                </div>
                                <div class="col-4 col-md-4  col-lg-4">
                                    <p class="section1-name">Delivery Fee</p>
                                </div>
                                <div class="col-4 col-md-4 col-lg-5">
                                    <p class="section1-price">${{ $basket['delivery_fee'] }}</p>
                                </div>
                                <div class="col-2 col-sm-1  col-md-2 col-lg-1 hand basket-close-item"></div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="col-12 d-block d-sm-block d-md-none d-lg-none pb-3">
                        <div id="calendar_mobile" class="calendar">
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="section1-title" id="deliver_in">Deliver in</p>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                  @foreach($open['times'] as $time)
                                    <div class="col-6 col-md-4 my-1">
                                        <button type="button" class="deliver">{{ $time }}</button>
                                    </div>
                                  @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-5">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="section1-title">Delivery Addresss</p>
                            </div>
                            <form method="POST" class="form px-1">
                                @csrf
                                <input type="hidden" name="date" id="date" />
                                <input type="hidden" name="time" id="time" />
                                <input type="hidden" name="pay_type" id="pay_type" />
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <input name="name" id="name" class="effect-1" type="text" placeholder="Name" value="{{ old('name') }}" />
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <input name="flat_no" id="flat_no" class="effect-1" type="text" placeholder="Flat Number" value="{{ old('flat_no') }}" />
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 px-0">
                                        <input name="addresss" id="addresss" class="effect-1" type="text" placeholder="Addresss" value="{{ old('addresss') }}" />
                                        <span class="focus-border"></span>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <input name="postcode" id="postcode" class="effect-1" type="text" placeholder="Postcode" value="{{ old('postcode') }}" />
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <input name="phone" id="phone" class="effect-1" type="text" placeholder="Phone Number" value="{{ old('phone') }}" />
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 px-0">
                                        <input name="comment" id="comment" class="effect-1" type="text" placeholder="Note" value="{{ $basket['comment'] }}">
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 d-none d-sm-block d-md-block d-lg-block">
                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <p class="section1-title">Add a side dish?</p>
                            </div>
                          @foreach($options as $option)
                            <div class="col-sm-4 col-md-4">
                                <div class="border-style">
                                    <p class="mb-0 section1-title">{{ $option['title'] }}</p>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-8 col-md-8">
                                                <p class="mb-0 section1-p1"><strong id="kp-option-{{ $option['id'] }}">{{ $option['inBasket'] }}</strong> X ${{ $option['price'] }}</p>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <a class=" mb-0 add" onclick="addOption({{ $option['id'] }})">+Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>


                    <div class="col-md-12 d-block d-sm-none d-md-none d-lg-none mt-2">
                        <!-- Swiper -->
                        <div class="swiper-container">
                            <div class="col-md-12">
                                <p class="section1-title">Add a side dish?</p>
                            </div>
                            <div class="swiper-wrapper">
                              @foreach($options as $option)
                                <div class="swiper-slide">
                                    <div class="border-style">
                                        <p class="mb-0 section1-title">{{ $option['title'] }}</p>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-8 px-0">
                                                    <p class="mb-0 section1-p1"><strong id="kp-option-{{ $option['id'] }}m">{{ $option['inBasket'] }}</strong> X ${{ $option['price'] }}</p>
                                                </div>
                                                <div class="col-4 col-md-4">
                                                    <a class=" mb-0 add" onclick="addOption('{{ $option['id'] }}m')">+Add</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              @endforeach
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>

                        </div>
                        <div class="row pt-5">
                            <div class="col-md-6 col-6">
                                <button class="btnPay btn-pay" id="btnPay_mobil" onclick="selectPeyOnline('mobil')">Pay online</button>
                            </div>
                            <div class="col-md-6 col-6">
                                <button class="btnCash btn-pay" id="btnCash_mobil" onclick="selectPeyCash('mobil')">Cash on Delivery</button>
                            </div>
                        </div>
                        <div class="col-md-11 bgcheckout mt-5">
                            <div class="row py-3 hand" onclick="setOrder()">
                                <div class="col-md-2 col-2 d-table my-auto">
                                    <p class="number-style mb-0 basket-count-all">10</p>
                                </div>
                                <div class="col-md-6 col-6">
                                    <p class="Checkout mb-0">Checkout</p>
                                </div>
                                <div class="col-md-4 col-4">
                                    <p class="price mb-0 basket-price-all">$209.94</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-none d-sm-none d-md-block d-lg-block">
                    <div class="col-md-6 d-table mx-auto">
                        <div id="calendar_desktop" class="calendar">
                        </div>
                        <div class="row pt-5">
                            <div class="col-md-6 col-6">
                                <button class="btnPay btn-pay" id="btnPay_desktop" onclick="selectPeyOnline('desktop')">Pay online</button>
                            </div>
                            <div class="col-md-6 col-6">
                                <button class="btnCash btn-pay" id="btnCash_desktop" onclick="selectPeyCash('desktop')">Cash on Delivery</button>
                            </div>
                            <div class="col-md-11 bgcheckout mt-5">
                                <div class="row py-3 hand" onclick="setOrder()">
                                    <div class="col-md-2 col-2 d-table my-auto">
                                        <p class="number-style mb-0 basket-count-all">{{ $basket['no'] }}</p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <p class="Checkout mb-0">Checkout</p>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <p class="price mb-0 basket-price-all">${{ $basket['priceAll'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ./section1---------------------------------------------------- -->
@endsection

@section('js')
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            // init: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 50,
                },
            }
        });
        $('#close').click(function() {
            $('.colse-div').addClass('colse-div1')
        });
    </script>
    <script>
        var daysId = {Sun:0, Mon:1, Tue:2, Wed:3, Thu:4, Fri:5, Sat:6};
        var daysSelectedId = [{{ $daysSelectedId }}];

        var calendarId = 'desktop';
        var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
        if (isiDevice) {calendarId = 'mobile';}
        var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
        if (isAndroid) {calendarId = 'mobile';}
        calendarId = 'calendar_' + calendarId;

        var calendarNode = document.querySelector("#" + calendarId);

        var currDate = new Date();
        var currYear = currDate.getFullYear();
        var currMonth = currDate.getMonth() + 1;

        var selectedYear = currYear;
        var selectedMonth = currMonth;
        var selectedMonthName = getMonthName(selectedYear, selectedMonth);
        var selectedMonthDays = getDayCount(selectedYear, selectedMonth);

        renderDOM(selectedYear, selectedMonth);

        function getMonthName(year, month) {
            let selectedDate = new Date(year, month - 1, 1);
            return selectedDate.toLocaleString('default', {
                month: 'long'
            });
        }

        function getMonthText() {
            if (selectedYear === currYear)
                return selectedMonthName;
            else
                return selectedMonthName + ", " + selectedYear;
        }

        function getDayName(year, month, day) {
            let selectedDate = new Date(year, month - 1, day);
            return selectedDate.toLocaleDateString('en-US', {
                weekday: 'long'
            });
        }

        function getDayCount(year, month) {
            return 32 - new Date(year, month - 1, 32).getDate();
        }

        function getDaysArray() {
            let emptyFieldsCount = 0;
            let emptyFields = [];
            let days = [];

            switch (getDayName(selectedYear, selectedMonth, 1)) {
                case "Tuesday":
                    emptyFieldsCount = 1;
                    break;
                case "Wednesday":
                    emptyFieldsCount = 2;
                    break;
                case "Thursday":
                    emptyFieldsCount = 3;
                    break;
                case "Friday":
                    emptyFieldsCount = 4;
                    break;
                case "Saturday":
                    emptyFieldsCount = 5;
                    break;
                case "Sunday":
                    emptyFieldsCount = 6;
                    break;
            }

            emptyFields = Array(emptyFieldsCount).fill("");
            days = Array.from(Array(selectedMonthDays + 1).keys());
            days.splice(0, 1);

            return emptyFields.concat(days);
        }

        function renderDOM(year, month) {
            let newCalendarNode = document.createElement("div");
            newCalendarNode.id = calendarId;
            newCalendarNode.className = "calendar";

            let dateText = document.createElement("div");
            //dateText.append(getMonthText());
            dateText.className = "date-text";
            newCalendarNode.append(dateText);

            let leftArrow = document.createElement("div");
            leftArrow.append("«");
            leftArrow.className = "button";
            leftArrow.addEventListener("click", goToPrevMonth);
            newCalendarNode.append(leftArrow);

            let curr = document.createElement("div");
            // curr.append("📅");
            curr.append(getMonthText());
            curr.className = "button";
            curr.addEventListener("click", goToCurrDate);
            newCalendarNode.append(curr);

            let rightArrow = document.createElement("div");
            rightArrow.append("»");
            rightArrow.className = "button";
            rightArrow.addEventListener("click", goToNextMonth);
            newCalendarNode.append(rightArrow);

            let dayNames = ["M", "T", "W", "T", "F", "S", "S"];

            dayNames.forEach((cellText) => {
                let cellNode = document.createElement("div");
                cellNode.className = "cell cell--unselectable border1";
                cellNode.append(cellText);
                newCalendarNode.append(cellNode);
            });

            let days = getDaysArray(year, month);
            console.log("\n\n\n\n\n\n");
            console.log(year);
            console.log(month);
            console.log("\n\n\n\n\n\n");

            var activeDays = [20, 21, 27, 28];
            days.forEach((cellText) => {
                let cellNode = document.createElement("div");
                //cellNode.className = $.inArray(cellText, activeDays) >= 0 ? "cell active" : "cell";
                var day = new Date(year + "/" + month + "/" + cellText);
                cellNode.className = $.inArray(day.getDay(), daysSelectedId) >= 0 ? "cell active" : "cell";
                //console.log([cellText, typeof cellText, $.inArray(cellText, activeDays)]);
                cellNode.append(cellText);
                newCalendarNode.append(cellNode);
            });

            calendarNode.replaceWith(newCalendarNode);
            calendarNode = document.querySelector("#" + calendarId);
        }

        $(".cell.active").on("click", function() {
            console.log("Click on a active day: " + $(this).html());
            console.log("year: " + selectedYear + " / " +  currYear);
            console.log("year: " + selectedMonthName + " / " +  selectedMonth + " / " +  currMonth);
            $("#date").val(selectedYear + "-" +  selectedMonth + "-" +  $(this).html());

            $(".cell.active").removeClass("selected");
            $(this).addClass("selected");
        });

        $(".deliver").on("click", function() {
            console.log("Click on a active time: " + $(this).html());

            $("#time").val($(this).html());

            $(".deliver").removeClass("selected");
            $(this).addClass("selected");
        });

        function goToPrevMonth() {
            selectedMonth--;
            if (selectedMonth === 0) {
                selectedMonth = 12;
                selectedYear--;
            }
            selectedMonthDays = getDayCount(selectedYear, selectedMonth);
            selectedMonthName = getMonthName(selectedYear, selectedMonth);

            renderDOM(selectedYear, selectedMonth);
        }

        function goToNextMonth() {
            selectedMonth++;
            if (selectedMonth === 13) {
                selectedMonth = 0;
                selectedYear++;
            }
            selectedMonthDays = getDayCount(selectedYear, selectedMonth);
            selectedMonthName = getMonthName(selectedYear, selectedMonth);

            renderDOM(selectedYear, selectedMonth);
        }

        function goToCurrDate() {
            selectedYear = currYear;
            selectedMonth = currMonth;

            selectedMonthDays = getDayCount(selectedYear, selectedMonth);
            selectedMonthName = getMonthName(selectedYear, selectedMonth);

            renderDOM(selectedYear, selectedMonth);
        }

        /*$(document).ready(function() {
            console.clear();
            console.log("\n\n\n\n\n\n");
            console.log(daysSelectedId);
            console.log(daysSelectedName);
            console.log("\n\n\n\n\n\n");
        });*/
    </script>
    <script>
        function setOrder() {
            if(checkOrder()) {
                $("form").submit();
            }
        }

        var checks = {
            "time": ["#deliver_in", "err-time"],
            "date": ["#" + calendarId, "err-date"],
            "pay_type": [".btn-pay", "is-invalid"],
            "name": ["#name", "is-invalid"],
            "flat_no": ["#flat_no", "is-invalid"],
            "addresss": ["#addresss", "is-invalid"],
            "postcode": ["#postcode", "is-invalid"],
            "phone": ["#phone", "is-invalid"],
        };
        function checkOrder() {
            var hasErr = false;
            $.each(checks, function(input, check) {
                if($('#'+input).val() == '') {
                    hasErr = true;
                    $(check[0]).addClass(check[1]);
                } else {
                    $(check[0]).removeClass(check[1]);
                }
            });
            return !hasErr;
        }

      @if($goToOrder)
        $(document).ready(function() {
            $("#emptyBasketModal").modal("show");
        });
      @endif

        function selectPeyOnline(device) {
            var other = '#btnCash_' + device;
            var current = '#btnPay_' + device;
            $(other).removeClass("selected");
            $(current).addClass("selected");
            $("#pay_type").val("online");
        }
        function selectPeyCash(device) {
            var other = '#btnPay_' + device;
            var current = '#btnCash_' + device;
            $(other).removeClass("selected");
            $(current).addClass("selected");
            $("#pay_type").val("cash");
        }
    </script>
@endsection

@section('modal')
    <!-- Modal -->
    <div id="emptyBasketModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Your basket is empty</h4>
                </div>
                <div class="modal-footer bg-warning">
                    <a href="{{ url('order') }}" class="btn btn-default">Go to <strong>Menu</strong> page</a>
                </div>
            </div>

        </div>
    </div>
@endsection

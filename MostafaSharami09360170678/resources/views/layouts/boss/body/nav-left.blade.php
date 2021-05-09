<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Order</div>
                <a class="nav-link" href="{{ url('/boss/order/live') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                    Live Orders
                </a>
                <a class="nav-link" href="{{ url('/boss/order/history') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                    Orders History
                </a>

                <div class="sb-sidenav-menu-heading"></div>

                <div class="sb-sidenav-menu-heading">Dishes</div>
                <a class="nav-link" href="{{ url('/boss/dishes/options') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-sliders-h"></i></div>
                    Options
                </a>
                <a class="nav-link" href="{{ url('/boss/dishes/popular') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bone"></i></div>
                    Kale Pache
                </a>
                <a class="nav-link" href="{{ url('/boss/dishes/other') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-utensils"></i></div>
                    Menu
                </a>
                <a class="nav-link" href="{{ url('/boss/dishes/extras') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                    Extras
                </a>

                <div class="sb-sidenav-menu-heading"></div>


                <div class="sb-sidenav-menu-heading">Settings</div>
                <a class="nav-link" href="{{ url('/boss/contact') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                    Contact
                </a>
                <a class="nav-link" href="{{ url('/boss/about') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                    About
                </a>
                <a class="nav-link" href="{{ url('/boss/open/times') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                    Open Times
                </a>
                {{--<div class="sb-sidenav-menu-heading">اخبار</div>--}}
                <a class="nav-link" href="{{ url('/boss/news') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                    News
                </a>
                <a class="nav-link" href="{{ url('/boss/delivery_fee') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                    Delivery Fee
                </a>
                <a class="nav-link" href="{{ url('/boss/catering') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                    Catering
                </a>
                <a class="nav-link" href="{{ url('/boss/newsletter') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                    Newsletter
                </a>
            </div>
        </div>
    </nav>
</div>

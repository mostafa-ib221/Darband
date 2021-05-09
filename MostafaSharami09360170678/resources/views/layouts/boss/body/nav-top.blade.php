<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">Darband Restaurant</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
    ><!-- Navbar Search-->
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0" style="position: absolute; right: 30px;">
        <a class=" text-light" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
            Exit
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
    <ul class="navbar-nav ml-auto ml-md-0 text-light" style="position: absolute; right: 80px;">
        {{ Auth::user()->name }}
    </ul>
</nav>

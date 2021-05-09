<!DOCTYPE html>
    <html lang="en">
    <head>
        @include('layouts.boss.head.meta')
        <title>Drarband Restaurant - Manager Panel {{ $title ? ' : '.$title.' Page' : '' }}</title>
        @include('layouts.boss.head.style')
        @yield('css')
        @include('layouts.boss.head.js')
    </head>
    <body class="sb-nav-fixed">
    @include('layouts.boss.body.nav-top')
        <div id="layoutSidenav">
            @include('layouts.boss.body.nav-left')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </main>
                {{--@include('layouts.boss.body.footer')--}}
            </div>
        </div>
        @include('layouts.boss.body.js')
        @yield('js')
        @yield('modal')
    </body>
</html>

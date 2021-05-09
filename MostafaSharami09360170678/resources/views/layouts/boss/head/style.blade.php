<link href="/static/css/safty.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
{{--<link href="/static/css/MahdiMajidzadeh-bootstrap-rtl.min.css" media="screen" />--}}
{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-CKHFSO+alj8INnPTr6aTHcZfWxiUMck+E/gmzluv3nw0QiPeBS2hRjV8ImTZS5Yd" crossorigin="anonymous">--}}
<link href="/static/font/persian/persian-font.css" rel="stylesheet" />

<style>
    @font-face {
        font-family: 'Vazir';
        src: url('/static/font/Vazir-FD.eot');
        src: url('/static/font/Vazir-FD.eot') format('embedded-opentype'),
            url('/static/font/Vazir-FD.woff') format('woff'),
            url('/static/font/Vazir-FD.woff2') format('woff2'),
            url('/static/font/Vazir-FD.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    .hidden {display: none;}
    textarea {resize: none;}

    /*.persian, .persianAll, .persianAll * {font-family: Vazir; direction: rtl !important; text-align: right; color: #0A3E60 !important;}*/
    .persian, .persianAll, .persianAll * {color: #0A3E60 !important;}
    .persianAll .btn {text-align: center !important;}
    .persianAll .fas {margin-left: 0.20rem !important;}

    .english, .englishAll, .englishAll * {direction: ltr !important; text-align: left; /*font-size: 1.05em*/}
    .englishAll .btn {text-align: center !important;}
    .englishAll .fas {margin-right: 0.20rem !important;}

    /*.label {font}*/

    .rem-1 {font-size: 1.00em !important;}
    .rem-2 {font-size: 1.50em !important;}
    .rem-3 {font-size: 2.00em !important;}
    .rem-4 {font-size: 2.50em !important;}

    th {text-align: center !important;}
    /*th.operations, td.operations {width: 70px !important;}*/
    th.operations, td.operations {width: 120px !important;}
    th.no, td.no {width: 30px !important;}

    /*#layoutSidenav_nav {left: unset !important;}
    #layoutSidenav_content {padding-right: 225px; padding-left: 0 !important;}*/
    .sb-sidenav-dark {background-color: #1D1D1D !important;}
    /*.sb-topnav {background-color: #17B68D !important;}*/
    .sb-topnav {background-color: #87ceeb !important;}
</style>

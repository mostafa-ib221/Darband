<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ $wire->title }}</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style>
         @if($wire->is_rtl == 1)
          @if(isset($os))
            html, body {direction: rtl; text-align: right;}
          @else
            html, body {direction: rtl; text-align: right; font-size: 1.5em;}
          @endif
         @else
          @if(isset($os))
            html, body {direction: ltr; text-align: left;}
          @else
            html, body {direction: ltr; text-align: left; font-size: 1.5em;}
          @endif
         @endif

           {{--@if($wire->is_rtl == 1)
            td {direction: ltr; text-align: left !important;}
           @else
            td {direction: rtl; text-align: right !important;}
           @endif--}}
            th {direction: rtl; text-align: left !important;}
            td {direction: rtl; text-align: right !important;}

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

            .vazir {font-family: Vazir;}

            .justify-text {
                /*direction: rtl !important;*/
                direction: @if($wire->is_rtl == 1) rtl @else ltr @endif !important;
                text-align: justify !important;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <h3 class="text-center vazir2" style="font-weight: bold;">{{ $wire->title }}</h3>
                </div>
            </div>

            @if(!empty($wire->pic_top))
                <img src="{{ $wire->pic_top }}" alt="{{ $wire->title }}" class="img-fluid mx-auto d-block" />
            @endif

         @if($wire->tables != '')
          @foreach($wire->tables as $tbl)
            <div class="row">
                <div class="col-12 table-responsive">
                    <h6 style="/*font-size: 1.5em;*/color: #666565;font-weight: bold;">{{ $tbl['title'] }}</h6>
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        {{--<thead class="englishAll">
                            <tr>
                                <th>عنوان</th>
                                <th>مقدار</th>
                                --}}{{--<th>Office</th>--}}{{--
                            </tr>
                        </thead>
                        <tfoot class="englishAll">
                            <tr>
                                <th>عنوان</th>
                                <th>مقدار</th>
                                --}}{{--<th>Office</th>--}}{{--
                            </tr>
                        </tfoot>--}}
                        <tbody>
                          @foreach($tbl['rows'] as $row)
                            <tr>
                                <th style="color: #c0c2c4;" class="vazir2">{{ $row['title'] }}</th>
                                <td style="font-weight: bold;color: #c0c2c4;">{{ $row['value'] }}</td>
                                {{--<td>Edinburgh</td>--}}
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          @endforeach
         @endif

            <div class="row mt-5">
                <div class="col-12">
                    <p class="mx-3 vazir2 d-block justify-content-center justify-text">{{ $wire->des }}</p>
                    @if($wire->pic != '')
                        <img src="{{ $wire->pic }}" alt="{{ $wire->title }}" class="img-fluid mx-auto d-block" />
                    @endif
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
    </body>
</html>

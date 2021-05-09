@extends('layouts.home.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('home/css/catering.css') }}" />

    <script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>

    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

    <style>
        #successModal .modal-dialog, #dangerModal .modal-dialog {
            background-color: #FFFF;
        }
        #successModal .modal-header {
            background: #28a745 linear-gradient(180deg,#48b461,#28a745) repeat-x !important;
            color: #FFF;
        }
        #dangerModal .modal-header {
            background: #dc3545 linear-gradient(180deg,#e15361,#dc3545) repeat-x !important;
            color: #FFF;
        }
    </style>
@endsection

@section('content')
    <!-- section1------------------------------------------------------------ -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <img src="{{ asset('home/img/bg_catering.png') }}" alt="" width="100%">
                </div>
                <div class="col-12 col-sm-6 col-md-6 d-table my-auto res-sm">
                    <div class="row">
                        <div class="col-3 col-md-2">
                            <img src="{{ asset('home/img/header/logo.png') }}" alt="" width="100%" class="res-img-section1">
                        </div>
                        <div class="col-9 col-md-10 d-table my-auto">
                            <p class="  title-section1">Darband Catering</p>

                        </div>
                    </div>
                    <p class="mt-4 text-section1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                        specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ./section1------------------------------------------------------------ -->

    <!-- section2-------------------------------------------------------------- -->
    <section>
        <div class="container">
            <div class="col-md-12">

                <p class="text-center title-section2">Gallery</p>

                <div class="row paddind-style-section2">
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter1">
                        <img src="{{ asset('home/img/tmp/d4yyx7kb.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/d4yyx7kb.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter2">
                        <img src="{{ asset('home/img/tmp/kp1vhthc.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/kp1vhthc.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter3">
                        <img src="{{ asset('home/img/tmp/kdjhl3da.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/kdjhl3da.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 paddind-style-section2">
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter4">
                        <img src="{{ asset('home/img/tmp/kam2cilz.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/kam2cilz.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter5">
                        <img src="{{ asset('home/img/tmp/t31wxg9o.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/t31wxg9o.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter6">
                        <img src="{{ asset('home/img/tmp/siciw738.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/siciw738.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 paddind-style-section2">
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter7">
                        <img src="{{ asset('home/img/tmp/d4yyx7kb.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter7" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/d4yyx7kb.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter8">
                        <img src="{{ asset('home/img/tmp/kp1vhthc.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/kp1vhthc.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4" data-toggle="modal" data-target="#exampleModalCenter9">
                        <img src="{{ asset('home/img/tmp/kdjhl3da.png') }}" alt="" width="100%">
                    </div>
                    <div class="modal fade" id="exampleModalCenter9" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img src="{{ asset('home/img/tmp/kdjhl3da.png') }}" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./section2------------------------------------------------------------ -->

    <!-- section3--------------------------------------------------------------- -->
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center title-section3">Contact us for catering</p>
                </div>

                <form class="w-100" method="POST">
                    @csrf
                    <div class="col-md-12 bg-color-section3">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-4 col-md-3">
                                <input class="effect-1" type="text" name="name" placeholder="Name" required />
                                <span class="focus-border"></span>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <input class="effect-1" type="email" name="email" placeholder="Email Address" required />
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-4 col-md-3">
                                <input class="effect-1" type="text" name="number" placeholder="Contact Number" required />
                                <span class="focus-border"></span>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3  px-0">
                                <div class="bootstrap-iso">

                                    <form action="https://formden.com/post/MlKtmY4x/" class="form-horizontal" method="post">
                                        <div class="form-group px-3">
                                            <label class="control-label lbl-style requiredField px-0" for="date">
                                                       Catering Date:
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-addon ">
                                                    <i class="fa fa-calendar">
                                                    </i>
                                                </div>
                                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text" required />
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-8 col-md-6 pt-3">
                                <textarea class="form-control" rows="5" name="comment" id="comment" placeholder="comment" required ></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center px-0">
                            <button class="btn btn-send">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ./section3-------------------------------------------------------------- -->
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <script>
        $(document).ready(function(){
          @if(isset($_GET['ok']))
            $("#successModal").modal("show");
          @elseif(isset($_GET['no']))
            $("#dangerModal").modal("show");
          @endif

            var date_input=$('input[name="date"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            });
        });
    </script>
@endsection

@section('modal')
    <!-- The Modal -->
    <div class="modal" id="successModal" style=>
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Your message is saved.
                </div>

            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="dangerModal" style=>
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Failed</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Your message isn't saved.
                    <br />
                    Please try again
                    Please try again
                </div>

            </div>
        </div>
    </div>
@endsection

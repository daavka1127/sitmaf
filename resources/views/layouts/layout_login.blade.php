<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('public/css/zam_login.css')}}" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{url('public/images/gsmaf_logo.ico')}}"/>
    <!-- jQuery -->
    <script src="{{url('public/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{url('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <link href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">



    <!--Zagvarlag alert-->
    <link rel="stylesheet" href="{{ asset('public/z-alert/css/alertify.core.css') }}" />
	  <link rel="stylesheet" href="{{ asset('public/z-alert/css/alertify.default.css') }}" />
    <script src="{{ asset('public/z-alert/js/alertify.min.js') }}"></script>
    <!--Zagvarlag alert-->

    <title>Төмөр замын ажлын мэдээлэл</title>
  </head>
  <body>

    <div id="content" class="col-md-4 col-md-offset-4">
      @yield("content")

    </div>
  </body>
</html>

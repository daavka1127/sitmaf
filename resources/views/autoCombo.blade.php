<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>


    <link href="{{url('public/css/zam_styles.css')}}" rel="stylesheet">

    <!-- SLIDER CSS -->
		<link rel="stylesheet" href="{{url('public/dist/css/slider-pro.min.css')}}"/>
		<!-- END SLIDER CSS -->

    <!-- Bootstrap -->
    <link href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('public/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('public/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{url('public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{url('public/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('public/build/css/custom.min.css')}}" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{url('public/vendors/jquery/dist/jquery.min.js')}}"></script>

    <script src="{{url('public/js/fullscreenTab.js')}}"></script>

    <!--Zagvarlag alert-->
    <link rel="stylesheet" href="{{ asset('public/z-alert/css/alertify.core.css') }}" />
	  <link rel="stylesheet" href="{{ asset('public/z-alert/css/alertify.default.css') }}" />
    <script src="{{ asset('public/z-alert/js/alertify.min.js') }}"></script>
    <!--Zagvarlag alert-->

    <!--row auto merge-->
    <script src="{{ asset('public/js/row-merge/jquery.rowspanizer.js') }}"></script>
    <script src="{{ asset('public/js/row-merge/jquery.rowspanizer.min.js') }}"></script>








    <script src="{{url('public/js/chart/jquery.canvasjs.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{url('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- DateJS -->
    <script src="{{url('public/vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{url('public/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{url('public/build/js/custom.min.js')}}"></script>

    <!-- SLIDER JS -->
		<script src="{{url("public/dist/js/jquery.sliderPro.min.js")}}"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->


    <link rel="stylesheet" href="{{url("public/js/autoCombo/base.jquery.css")}}">
    <script src="{{url("public/js/autoCombo/autojquery-ui.js")}}"></script>
    <script src="{{url("public/js/autoCombo/autoHeader.js")}}"></script>
  </head>
  <style media="screen">
  .custom-combobox {
  position: relative;
  display: inline-block;
}
.custom-combobox-toggle {
  position: absolute;
  top: 0;
  bottom: 0;
  margin-left: -1px;
  padding: 0;
}
.custom-combobox-input {
  margin: 0;
  padding-top: 2px;
  padding-bottom: 5px;
  padding-right: 5px;
}

  </style>

  <body>
    <div class="container">
    	<div class="row">
    		<div class="ui-widget">
                <label>Procedure: loool </label>
                <select id="combobox">
                    <option></option>
                    <option value="Ultrasound Knee Right">Ultrasound Knee Right</option>
                    <option value="Ultrasound Knee Left">Ultrasound Knee Left</option>
                    <option value="Ultrasound Forearm/Elbow Right">Ultrasound Forearm/  Elbow Right</option>
                    <option value="Ultrasound Forearm/Elbow Left">Ultrasound Forearm/Elbow Left</option>
                    <option value="MRI Knee Right">MRI Knee Right</option>
                    <option value="MRI Knee Left">MRI Knee Left</option>
                    <option value="MRI Forearm/Elbow Right">MRI Forearm/Elbow Right</option>
                    <option value="MRI Forearm/Elbow Left">MRI Forearm/Elbow Left</option>
                    <option value="CT Knee Right">CT Knee Right</option>
                    <option value="CT Knee Left">CT Knee Left</option>
                    <option value="CT Forearm/Elbow Right">CT Forearm/Elbow Right</option>
                    <option value="CT Forearm/Elbow Left">CT Forearm/Elbow Left</option>
              </select>
            </div>
    	</div>
    </div>
  </body>
</html>

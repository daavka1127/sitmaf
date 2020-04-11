@extends('layouts.layout_main')
@section('content')
  <div class="clearfix"></div>
  <div class="row">
    <script>
      $(document).ready(function(){
          $("#cmbHeseg").change(function(){
              $(".divWorkType").css("display","none");
              window.location.href = "{{url('/chart/all')}}/" + $("#cmbHeseg").val();
          });
          $("#cmbCompany").change(function(){
            $(".divWorkType").css("display","block");
            $("#cmbWorkType").val("0");
          });
          $("#cmbWorkType").change(function(){
            window.location.href = "{{url('/chart/byDate')}}/" + $("#cmbCompany").val() + "/" +$("#cmbWorkType").val();
          });
      });

    </script>

    <link rel="stylesheet" href="{{url("public/js/autoCombo/base.jquery.css")}}">
    <link rel="stylesheet" href="{{url("public/js/autoCombo/autoComboStyle.css")}}">
    <script src="{{url("public/js/autoCombo/autojquery-ui.js")}}"></script>
    <script src="{{url("public/js/autoCombo/autoHeader.js")}}"></script>

    <div class="col-md-4">
      <label>Хэсгээр харах</label>
      <select class="form-control" id="cmbHeseg">
        <option value="0">Сонгоно уу</option>
        <option value="1">Зүүнбаян чиглэл I хэсэг</option>
        <option value="2">Мандах чиглэл II хэсэг</option>
        <option value="3">Цогтцэций чиглэл III чиглэл</option>
        <option value="4">Бүх аж ахуйн нэгжээр</option>
      </select>
    </div>
    <div class="col-md-4">


          <div class="ui-widget">
            <label>Аж ахуйн нэгжээр харах</label>
            <select  id="cmbCompany">  {{-- cmbCompany --}}
              <option value="0">Сонгоно уу</option>
              @foreach ($companies as $company)
                @if($companyID == $company->id)
                  <option value="{{$company->id}}" selected>{{$company->companyName}}</option>
                @else
                  <option value="{{$company->id}}">{{$company->companyName}}</option>
                @endif
              @endforeach
            </select>
          </div>


    </div>
    <div class="divWorkType col-md-4">
      <label>Хийгдэж буй ажлын төрөл</label>
      <select class="form-control" id="cmbWorkType">
        <option value="0">Сонгоно уу</option>
        @php
          $workTypes = App\Http\Controllers\WorktypeController::getCompactWorkType();
        @endphp
        @foreach ($workTypes as $workType)
          @if ($workTypeID == $workType->id)
            <option value="{{$workType->id}}" selected>{{$workType->name}}</option>
          @else
            <option value="{{$workType->id}}">{{$workType->name}}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>
  <link href="{{url('public/jqChart/jqstyles.css')}}" rel="stylesheet">
  <link href="{{url('public/jqChart/jquery.jqChart.css')}}" rel="stylesheet">
  <script src="{{url('public/jqChart/jquery.jqChart.min.js')}}"></script>
  <div class="clearfix"></div>
  <br>

  @if(count($datas) > 0)

    @include('chart.chartByDate')
    <div class="clearfix"></div>

    @include('chart.chartByTorol')
    <div style="color: black; font-size: 20px; font-weight: bold" class="col-md-12 col-md-offset-5">Гүйцэтгэл /үзүүлэлтээр/</div>
    <div class="clearfix"></div>
    <div id="chartContainer123" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </br>
    <div id="jqChart" style="height: 370px; max-width: 920px; margin: 0px auto; background-color: #fff;" ></div>
    <div class="clearfix"></div>




  @else
    <div class="clearfix"></div>
    <div style="color: black; font-size: 20px; font-weight: bold" class="col-md-12 col-md-offset-5">Өгөгдөл ороогүй</div>
    <div class="clearfix"></div>
  @endif
@endsection

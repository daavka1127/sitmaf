@extends('layouts.layout_main')
@section('content')
  <div class="clearfix"></div>
  <div class="row">

    <script>
      $(document).ready(function(){
        $("#cmbHeseg").change(function(){
          $(".divWorkType").css("display","none");
            if($("#cmbHeseg").val() > 0)
              window.location.href = "{{url('/chart/all')}}/" + $("#cmbHeseg").val();
        });

          $("#cmbCompany").change(function(){
            $(".divWorkType").css("display","block");
            $("#cmbWorkType").val('0');
          });
          $("#cmbWorkType").change(function(){
            // $(".divWorkType").css("display","block");
              window.location.href = "{{url('/chart/byDate')}}/"+ {{Auth::user()->heseg_id}}+ "/" + $("#cmbCompany").val() + "/" + $("#cmbWorkType").val();
          });

      });
    </script>


    <div class="col-md-4">
      <label>Хэсгээр харах</label>
      <select class="form-control" id="cmbHeseg">
        <option value="0">Сонгоно уу</option>
        @foreach ($hesegs as $heseg)
            @if($heseg->id == $hesegID)
              <option value="{{$heseg->id}}" selected>{{$heseg->name}}</option>
            @else
              <option value="{{$heseg->id}}">{{$heseg->name}}</option>
            @endif
        @endforeach
        @if(Auth::user()->heseg_id > 3)
        <option value="4">Бүх хэсгээр харах</option>
      @endif
      </select>
    </div>

    <div class="col-md-2">
    </div>

    <div class="col-md-5">
      <div class="row">
        <label>Аж ахуйн нэгжээр харах</label>
        <select class="form-control"  id="cmbCompany">  {{-- cmbCompany --}}
          <option value="0">Сонгоно уу</option>
          @foreach ($companiesChart as $company)
            @if($companyID == $company->id)
                <option value="{{$company->id}}" selected>{{$company->companyName}}-><strong>{{$company->ajliinHeseg}}</strong></option>
            @else
                <option value="{{$company->id}}">{{$company->companyName}}-><strong>{{$company->ajliinHeseg}}</strong></option>
            @endif
          @endforeach
        </select>
      </div>
      <div class="divWorkType row">
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

  </div>
  <div class="row">
    <div class="col-md-4">
      @php
        $getDate = App\Http\Controllers\guitsetgelChartController::getLastGenrateDate();
        foreach ($getDate as $date) {
        $dd =  $date->endDate;
        }
        // $dd = explode("&", $getDate);
        echo "<p>".$dd." өдрийн байдлаар</p>";
      @endphp
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

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
              // window.location.href = "{{url('/chart/byDate')}}/" + $("#cmbCompany").val() + "/" + $("#cmbWorkType").val();
          });
          $("#cmbWorkType").change(function(){
            // $(".divWorkType").css("display","block");
              window.location.href = "{{url('/chart/byDate')}}/" + $("#cmbCompany").val() + "/" + $("#cmbWorkType").val();
          });

      });
    </script>

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

    <div class="col-md-2">

    </div>

    <div class="col-md-5">
      <div class="row">
        <label>Аж ахуйн нэгжээр харах</label>
        <select class="form-control" id="cmbCompany">
          <option value="0">Сонгоно уу</option>
          @foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->companyName}}-><strong>{{$company->ajliinHeseg}}</strong></option>
          @endforeach
        </select>
      </div>
      <div class="divWorkType row" style="display: none;" >
        <label>Хийгдэж буй ажлын төрөл</label>
        <select class="form-control" id="cmbWorkType">
          <option value="0">Сонгоно уу</option>
          @php
            $workTypes = App\Http\Controllers\WorktypeController::getCompactWorkType();
          @endphp
          @foreach ($workTypes as $workType)
              <option value="{{$workType->id}}">{{$workType->name}}</option>
          @endforeach
        </select>
      </div>
    </div>

  </div>

  <div style="display:none;" id="loading" class="col-md-2 col-md-offset-5">
    <br/>
    <div class="clearfix"></div>
    <img width="100" src="{{url('public/images/loading_big.gif')}}" />
  </div>
  <div id="chartContent">

  </div>
  {{-- <script type="text/javascript" src="{{url('public/js/guitsetgelChartAll/guitsetgelChartAll.js')}}"></script> --}}
@endsection

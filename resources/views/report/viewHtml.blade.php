@extends('layouts.layout_main')

@section('content')
  <script type="text/javascript">
  $(document).on('click', '[type=checkbox]', function(){
      var id = $(this).attr("workTypeId");
      if($(this).is(':checked')){
          $("#workTypeIDReport" + id).css("display","block");
      }
      else{
          $("#workTypeIDReport" + id).css("display","none");
      }
  });
  </script>
  <div class="row">
    <div class="form-group col-md-12 text-left">
      <label>Харагдах ажлын төрлийг сонгоно уу <span class="red-required">*</span> </label>
      <div class="clearfix"></div>
      @php
          $getWorkType = \App\Http\Controllers\WorktypeController::getCompactWorkType();
      @endphp

        @foreach ($getWorkType as $WorkType)
          <div class="col-md-3">
            <label >{{$WorkType->name}} </label>
            <input type="checkbox" workTypeId="{{$WorkType->id}}" id="checkboxRep{{$WorkType->id}}"  />
          </div>
        @endforeach

    </div>
  </div>

<?php include 'test.html'; ?>
@endsection

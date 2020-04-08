
@extends('layouts.layout_main')

@section('content')

  <div class="container">
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#VisibleModal">Ажилын төрөл Hide хийх</button>

    <!-- Modal -->
    <div class="modal fade" id="VisibleModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ажлын төрөл HIDE болгох</h4>
          </div>
          <div class="modal-body">


              <div class="form-group col-md-3 text-left">
                <label>Ажилын төрөл <span class="red-required">*</span> </label>
                <input type="hidden" id="txtEditID" name="id" class="form-control" />
                @php
                  $worktypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
                @endphp
                </div>
              <div class="form-group col-md-12 text-left">
                <form id="frmWorkType">

                  @foreach ($worktypes as $worktype)
                    <div class="col-md-3">
                      <label class="checkbox-inline">
                        @if ($worktype->visible == 1)
                          <input type="checkbox" value="{{$worktype->id}}" name="visibleWorkType[]" checked>
                        @else
                          <input type="checkbox" value="{{$worktype->id}}" name="visibleWorkType[]">
                        @endif
                        {{$worktype->name}}
                      </label>
                    </div>
                  @endforeach
                </form>
              </div>
              <div class="col-md-12 text-right">
                <button type="button" id="BtnVisbileChange" class="btn btn-primary" data-dismiss="modal">Өөрчлөх</button>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-4 text-left">
                <select class="form-control" name="" id="cmbWorkTypeID" >
                  @foreach ($worktypes as $workType)
                    <option value="{{$workType->id}}">{{$workType->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="clearfix"></div>
              <form id="frmWorks">
                <div class="" id="workChecks"></div>
              </form>
              <div class="col-md-12 text-right">
                <button type="button" id="BtnVisbileChangeWorks" class="btn btn-primary" data-dismiss="modal">Өөрчлөх</button>
              </div>
              <div class="clearfix"></div>

          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
var VisbleStoreUrl = "{{url('workType/visibleChange')}}";
var VisbleCheckUrl = "{{url('workType/getCheck')}}";
var VisbleworksCheckUrl = "{{url('works/checkStroe')}}";


$(document).ready(function(){

  $(document).on("change", '#cmbWorkTypeID', function(){
      $.ajax({
      type: 'GET',
      url: VisbleCheckUrl,
      data: {
        workTypeID: $("#cmbWorkTypeID").val()
      },
      success:function(response){
        // alertify.alert(response);
          $('#workChecks').text("");
        $.each(response, function(key, value){
          // alert(value.name);
          //alert("key="+ key +" value=" + value.name);
          if(value.visible == 1){
            $('#workChecks').append('<div class="col-md-12">' +
                '<label class="checkbox-inline">' +
                '<input type="checkbox" value="'+value.id+'" name="visibleWorkName[]" checked>  '+value.name+
                '</label></div>'
                );
          }else{
            $('#workChecks').append('<div class="col-md-12">' +
                '<label class="checkbox-inline">' +
                '<input type="checkbox" value="'+value.id+'" name="visibleWorkName[]">  '+value.name+
                '</label></div>'
                );
          }
        });
      },
      error: function(jqXhr, json, errorThrown){// this are default for ajax errors
        var errors = jqXhr.responseJSON;
        var errorsHtml = '';
        $.each(errors['errors'], function (index, value) {
            errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
        });
        alert(errorsHtml);
      }
    });
  });

$(document).on("click", '#BtnVisbileChange', function(){
  var check=0;
alert($('#frmWorkType').serialize());
      $.ajax({
      type: 'GET',
      url: VisbleStoreUrl,
      data: $('#frmWorkType').serialize(),
      success:function(response){
          alertify.alert(response);
      },
      error: function(jqXhr, json, errorThrown){// this are default for ajax errors
        var errors = jqXhr.responseJSON;
        var errorsHtml = '';
        $.each(errors['errors'], function (index, value) {
            errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
        });
        alert(errorsHtml);
      }
    });
  });

  $(document).on("click", '#BtnVisbileChangeWorks', function(){
        $.ajax({
        type: 'GET',
        url: VisbleworksCheckUrl,
        data: $('#frmWorks').serialize(),
        success:function(response){
            alertify.alert(response);
        },
        error: function(jqXhr, json, errorThrown){// this are default for ajax errors
          var errors = jqXhr.responseJSON;
          var errorsHtml = '';
          $.each(errors['errors'], function (index, value) {
              errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
          });
          alert(errorsHtml);
        }
      });
    });

});


</script>

@endsection

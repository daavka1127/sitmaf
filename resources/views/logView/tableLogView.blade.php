@extends('layouts.layout_main')
@section('content')

<div class="clearfix"></div>
<div class="row">
  <label class="radio-inline" style="font-weight: bold;"><input value="data" type="radio" name="gender" checked /> Хэрэглэгчдийн үйлдлийн бүртгэл              </label>
  <label class="radio-inline" style="font-weight: bold;"><input value="user" type="radio" name="gender" /><h7>  Хэрэглэгчдийн нэвтрэлт </h7></label><br><br>
</div>

  <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
<script>

$(document).on('click', '[type=radio]', function(){
    if( $(this).val() == "user"){
      $("#data").css("display","none");
      $("#user").css("display","block");
    }
    else {
      $("#data").css("display","block");
      $("#user").css("display","none");
    }

});

$(document).ready(function(){


  $('#datatable').DataTable( {
    "language": {
        "lengthMenu": "_MENU_ мөрөөр харах",
        "zeroRecords": "Хайлт илэрцгүй байна",
        "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
        "infoEmpty": "Хайлт илэрцгүй",
        "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
        "sSearch": "Хайх: ",
        "paginate": {
          "previous": "Өмнөх",
          "next": "Дараахи"
        }
    },
    "processing": true,
    "serverSide": true,
    "stateSave": true,
    "ajax":{
             "url": "{{url('/logView/getTableLog')}}",
             "dataType": "json",
             "type": "POST",
             "data":{
                  _token: "{{ csrf_token() }}"
                }
           },
    "columns":
    [
      { data: "ipAddress", name: "ipAddress"},
      { data: "userName", name: "userName"},
      { data: "actionName", name: "actionName"},
      { data: "tableName", name: "tableName"},
      { data: "value", name: "value"},
      { data: "comment", name: "comment" },
      { data: "dateTime", name: "dateTime" }
    ]
  });
});

$(document).ready(function(){


  $('#usertable').DataTable( {
    "language": {
        "lengthMenu": "_MENU_ мөрөөр харах",
        "zeroRecords": "Хайлт илэрцгүй байна",
        "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
        "infoEmpty": "Хайлт илэрцгүй",
        "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
        "sSearch": "Хайх: ",
        "paginate": {
          "previous": "Өмнөх",
          "next": "Дараахи"
        }
    },
    "processing": true,
    "serverSide": true,
    "stateSave": true,
    "ajax":{
             "url": "{{url('/logView/userTableLog')}}",
             "dataType": "json",
             "type": "POST",
             "data":{
                  _token: "{{ csrf_token() }}"
                }
           },
    "columns":
    [
      { data: "ipAddress", name: "ipAddress"},
      { data: "userName", name: "userName"},
      { data: "dateTime", name: "dateTime"},
      { data: "loggedOutTime", name: "loggedOutTime"}
    ]
  });
});

</script>

<div class="col-xs-12" id="data">
  <h2 style="text-align:center;"><strong>Хэрэглэгчдийн үйлдлийн бүртгэл</strong></h2>
  <div class="row">
      <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
          <thead>
              <tr>
                <th>IP хаяг</th>
                <th>Хэрэглэгч нэр</th>
                <th>Үйлдэл</th>
                <th>Хүснэгт</th>
                <th>Утга</th>
                <th>Тайлбар</th>
                <th>Огноо</th>
              </tr>
          </thead>
      </table>
  </div>
</div>

<div class="col-xs-12" id="user" style="display:none;">
  <h2 style="text-align:center;"><strong>Хэрэглэгчдийн нэвтрэлт</strong></h2>
  <div class="row">
      <table id="usertable" class="table table-striped table-bordered" style="width:100%;">
          <thead>
              <tr>
                <th>IP хаяг</th>
                <th>Хэрэглэгч нэр</th>
                <th>Нэвтэрсэн огноо</th>
                <th>Гарсан огноо</th>
              </tr>
          </thead>
      </table>
  </div>
</div>


<script src="{{url('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{url('public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{url('public/vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{url('public/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{url('public/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

@endsection

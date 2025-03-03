@extends('layouts.layout_main')

@section('content')
  <!-- Datatables -->
      <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

<script>
    var newHunHuchUrl = "{{url("/hunHuch/store")}}";
    var getHunHuchUrl = "{{url("/hunHuch/new/get")}}";
    var editHunHuchUrl = "{{url("/hunHuch/update")}}";
    var deleteHunHuchUrl = "{{url("/hunHuch/delete")}}";

    var getOneCompanyHunHuchUrl = "{{url("/hunHuch/getOneCompanyHunhuch")}}";
    var editOneCompanyHunHuchUrl = "{{url("/hunHuch/editOneCompanyHunhuch")}}";
    var dataRow = "";
    var hunhuchEditRow = "";
    var csrf = "{{ csrf_token() }}";
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
          "ajax":{
                   "url": getHunHuchUrl,
                   "dataType": "json",
                   "type": "get",
                   "data":{
                        _token: "{{ csrf_token() }}"
                      }
                 },
          "columns": [
              {
                  "class":          "details-control",
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": ""
              },
              { data: "id", name: "id" },
              { data: "companyName", name: "companyName"},
              { data: "ajliinHeseg", name: "ajliinHeseg"}
            ]
      });
  });
  $(document).ready(function(){
    $('#datatable tbody').on( 'click', 'tr', function () {
        var currow = $(this).closest('tr');
        $('#datatable tbody tr').css("background-color", "white");
        $(this).closest('tr').css("background-color", "yellow");
        dataRow = $('#datatable').DataTable().row(currow).data();
        // alert(dataRow["companyName"]);
      });
  });
</script>
<script src="{{url('public/js/hunHuch/hunHuch.js')}}"></script>
<script src="{{url('public/js/hunHuch/hunhuchEditModal.js')}}"></script>

<div class="col-xs-12">
  <h2 style="text-align:center;"><strong>Хүн хүч нэмэх</strong></h2>
  <div class="row">
      <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
          <thead>
              <tr>
                  <th></th>
                  <th>ID</th>
                  <th>Аж ахуй нэгжийн нэр</th>
                  <th>Ажлын хэсэг</th>
              </tr>
          </thead>
      </table>


  </div>
  <div class="text-left">
    @if(Auth::user()->heseg_id == 5)
      <button type="button" class="btn btn-success"  id="btnAddHunhuch">Нэмэх</button>
      <button type="button" class="btn btn-warning" id="btnEditHunHuch">Засах</button>
      <button type="button" class="btn btn-danger" id="btnDeleteHunHuch">Устгах</button>
    @endif
  </div>
  @if ($errors->any())
          {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  {{-- <script src="{{url('public/js/hunHuch/hunHuchNew.js')}}"></script> --}}
  @include('hunHuch.hunHuchNew')
  @include('hunHuch.hunHuchEdit')
</div>


<!-- Datatables -->
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

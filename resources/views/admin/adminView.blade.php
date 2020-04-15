@extends('layouts.layout_main')

@section('content')


  <!-- Datatables -->
      <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

<script>
    var getadminUrl = "{{url("/adminSee")}}";
    var adminUpdateUrl = "{{url('/admin/adminUpdate')}}";
    var csrf = "{{ csrf_token() }}";
    var execEditRow = "";
    var dataRow = "";
    var updateRD = "";
    $(document).ready(function(){
      $('#datatableAdmin').DataTable( {
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
                   "url": getadminUrl,
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: $('meta[name="csrf-token"]').attr('content')
                      }
                 },
          "columns": [
              { data: "id", name: "id",  render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        } },
              { data: "name", name: "name"},
              { data: "email", name: "email"},
              { data: "password", name: "password"},
              { data: "heseg_id", name: "heseg_id", visible:false },
              { data: "heseg_name", name: "heseg_name" },
              { data: "edit", name: "edit" }
            ]
      });
  });
  $(document).ready(function(){
    $('#datatableAdmin tbody').on( 'click', 'tr', function () {
        var currow = $(this).closest('tr');
        $('#datatableAdmin tbody tr').css("background-color", "white");
        $(this).closest('tr').css("background-color", "yellow");
        dataRow = $('#datatableAdmin').DataTable().row(currow).data();
      });
  });

</script>

<script src="{{url('public/js/admin/admin.js')}}"></script>
{{-- <script src="{{url('public/js/guitsetgel/executionEdit.js')}}"></script> --}}


<div class="col-xs-12">
  <h2 style="text-align:center;"><strong>Аж ахуйн нэгжүүд</strong></h2>
  <div class="row">
      <table id="datatableAdmin" class="table table-striped table-bordered" style="width:100%;">
          <thead>
              <tr>
                  <th>№</th>
                  <th>Нэр</th>
                  <th>Цахим хаяг</th>
                  <th>Нууц үг</th>
                  <th></th>
                  <th>Xандах эрх</th>
                  <th>Өгөгдөл засах</th>
              </tr>
          </thead>
      </table>

  </div>

  <div class="text-left">
    @if(Auth::user()->heseg_id == 5 )
      <button type="button" class="btn btn-success"  id="btnAddadmin">Нэмэх</button>
      <button type="button" class="btn btn-warning" id="btnEditAdmin">Засах</button>
      <button type="button" delete-url="{{url("/admin/delete")}}" class="btn btn-danger" id="btnDeleteAdmin">Устгах</button>
    @endif
  </div>
    <div class="clearfix"></div>

  @if ($errors->any())
          {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif

  @include('guitsetgel.guitsetgelNew')
  @include('admin.adminEdit')
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#btnAddadmin").click(function(){
        window.location.href = "{{url('/register')}}/";
  });


});

</script>

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

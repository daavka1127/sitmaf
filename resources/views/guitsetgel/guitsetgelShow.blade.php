@extends('layouts.layout_main')

@section('content')

<style media="screen">
.redBorder
{
   border:1px solid #f00;
}

</style>
  <!-- Datatables -->
      <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

      <link rel="stylesheet" href="{{url("public/date-time-picker/jquery.datetimepicker.css")}}">
<script src="{{url("public/date-time-picker/jquery.datetimepicker.full.js")}}"></script>

<script>
    var newCompanyUrl = "{{url("/guitsetgel/store")}}";

    var getCompanyByID = "{{url("/get/company/by/id")}}";
    var editCompanyUrl = "{{url("/guitsetgel/update")}}";
    var deleteCompanyUrl = "{{url("/guitsetgel/delete")}}";

    var getCompaniesUrl = "{{url("/company/get")}}";
    var getPlanWorkTypeUrl = "{{url('/getPlanWorkType')}}";
    var getPlanWorkUrl = "{{url('/getPlanWork/company/work_type')}}";
    var executionStoreUrl = "{{url('/execution/store')}}";
    var executionUpdateUrl = "{{url('/execution/execUpdate')}}";
    var executionDeleteUrl = "{{url('/execution/execDelete')}}";

    var csrf = "{{ csrf_token() }}";

    var getExecByCompany = "{{url("/guitsetgel/getExecByCompany")}}";
    var execEditRow = "";

    var getBtoohemjee = "{{url("/plan/get/sum/comID")}}";


    var dataRow = "";
    var updateRD = "";
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
          "order": [[ 1, "asc" ]],
          "processing": true,
          "serverSide": true,
          "ajax":{
                   "url": getCompaniesUrl,
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: "{{ csrf_token() }}"
                      }
                 },
          "columns": [
              { data: "id", name: "id",  render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        } },
              { data: "heseg_id", name: "heseg_id", visible:false},
              { data: "name", name: "name"},
              { data: "companyName", name: "companyName"},
              { data: "ajliinHeseg", name: "ajliinHeseg"},
              { data: "hunHuch", name: "hunHuch", visible:false},
              { data: "mashinTehnik", name: "mashinTehnik", visible:false},
              { data: "gereeOgnoo", name: "gereeOgnoo", visible:false },
              { data: "plan", name: "plan"},
              { data: "allExec", name: "allExec"},
              { data: "per", name: "per", render: function (data, type, full) {
                   return data.toString().match(/\d+(\.\d{1,2})?/g)[0] + "%";
              }}
            ]
      });
  });
  $(document).ready(function(){
    $('#datatable tbody').on( 'click', 'tr', function () {
        var currow = $(this).closest('tr');
        $('#datatable tbody tr').css("background-color", "white");
        $(this).closest('tr').css("background-color", "yellow");
        dataRow = $('#datatable').DataTable().row(currow).data();
      });
  });

</script>

<script>
    jQuery(document).ready(function () {
         'use strict';
        jQuery('#date').datetimepicker({
        });
    });
</script>

<script src="{{url('public/js/guitsetgel/executionNew.js')}}"></script>
<script src="{{url('public/js/guitsetgel/executionEdit.js')}}"></script>
<script src="{{url('public/js/guitsetgel/guitsetgel.js')}}"></script>

@if(Auth::user()->edit == 'on')
<div class="col-md-12">
  <div id="divGenerateReport">
    <div class="border border-primary">
      <div class="row">
        <div class="col-md-6 text-right">
          <strong style="color:red;">Гүйцэтгэл хадгалж дууссан бол тайлан бодох товч дарна уу!!! ==>></strong>
        </div>
        <div class="col-md-4">
          <div class='input-group date' >
              <input type="datetime" name="date" id="date" value="" class="form-control"/>
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
              </span>
          </div>
        </div>
        <div class="col-md-2">
          <input type="button" data-post-url="{{url('/generate/html')}}" class="btn btn-primary btn-sm" name="" data-url="{{url('/show/html')}}" id="btnGenerateReport" value="Тайлан бодох" />
        </div>
      </div>
    </div>
  </div>
  <span style="color:green;" id="generateReportAlert"></span>
</div>
@endif
<div class="col-xs-12">
  <h2 style="text-align:center;"><strong>Аж ахуйн нэгжүүд</strong></h2>
  <div class="row">
      <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
          <thead>
              <tr>
                  <th>ID</th>
                  <th></th>
                  <th>Хэсэг</th>
                  <th>Аж ахуй нэгжийн нэр</th>
                  <th>Ажлийн хэсэг</th>
                  <th>Хүн хүч</th>
                  <th>Машин техник</th>
                  <th>Огноо</th>
                  <th>Батлагдсан тоо хэмжээ</th>
                  <th>Нийт гүйцэтгэл</th>
                  <th>Хувь</th>
              </tr>
          </thead>
      </table>

  </div>

  <div class="text-left">

    @if(Auth::user()->heseg_id == 5)
      <button type="button" class="btn btn-success"  id="btnAddGuitsetgel">Нэмэх</button>
      <button type="button" class="btn btn-warning" id="btnEditGuitsetgel">Засах</button>

    @elseif (Auth::user()->heseg_id == 5 || Auth::user()->edit == 'on')
      <button type="button" class="btn btn-success"  id="btnAddGuitsetgel">Нэмэх</button>

    @endif
  </div>
    <div class="clearfix"></div>

  @if ($errors->any())
          {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  {{-- <script src="{{url('public/js/guitsetgel/guitsetgel.js')}}"></script> --}}
  <script src="{{url('public/js/guitsetgel/executionReportGenerate.js')}}"></script>
  @include('guitsetgel.guitsetgelNew')
  @include('guitsetgel.guitsetgelEdit')
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

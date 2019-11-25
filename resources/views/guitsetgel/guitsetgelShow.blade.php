@extends('layouts.layout_main')

@section('content')


  <!-- Datatables -->
      <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

<script>
    var newCompanyUrl = "{{url("/guitsetgel/store")}}";
    var getCompaniesUrl = "{{url("/guitsetgel/new/get")}}";
    var getCompanyByID = "{{url("/get/company/by/id")}}";
    var editCompanyUrl = "{{url("/guitsetgel/update")}}";
    var deleteCompanyUrl = "{{url("/guitsetgel/delete")}}";
    var dataRow = "";
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
                   "url": getCompaniesUrl,
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: "{{ csrf_token() }}"
                      }
                 },
          "columns": [
              { data: "id", name: "id" },
              { data: "companyID", name: "companyID", visible:false},
              { data: "companyName", name: "companyName"},
              { data: "gHursHuulalt", name: "gHursHuulalt"},
              { data: "gDalan", name: "gDalan" },
              { data: "gUhmal", name: "gUhmal" },
              { data: "gSuuriinUy", name: "gSuuriinUy" },
              { data: "gShuuduu", name: "gShuuduu" },
              { data: "gUhmaliinHamgaalalt", name: "gUhmaliinHamgaalalt" },
              { data: "gUuliinShuuduu", name: "gUuliinShuuduu" },
              { data: "ognoo", name: "ognoo" },
              { data: "hursHuulalt", name: "hursHuulalt", visible:false},
              { data: "dalan", name: "dalan", visible:false},
              { data: "uhmal", name: "uhmal", visible:false},
              { data: "suuriinUy", name: "suuriinUy", visible:false},
              { data: "shuuduu", name: "shuuduu", visible:false},
              { data: "uhmaliinHamgaalalt", name: "uhmaliinHamgaalalt", visible:false},
              { data: "uuliinShuuduu", name: "uuliinShuuduu", visible:false},
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

<div class="col-xs-12">
  <h2 style="text-align:center;"><strong>Бүртгэгдсэн аж ахуйн нэгжүүд</strong></h2>
  <div class="row">
      <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
          <thead>
              <tr>
                  <th>ID</th>
                  <th></th>
                  <th>Аж ахуй нэгжийн нэр</th>
                  <th>Хөрс хуулалт</th>
                  <th>Далан</th>
                  <th>Ухмал</th>
                  <th>Суурийн үе</th>
                  <th>Шуудуу</th>
                  <th>Ухмалын хамгаалалт</th>
                  <th>Уулын шуудуу</th>
                  <th>Огноо</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
          </thead>
      </table>

  </div>
  <div class="text-left">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newGuitsetgelModal">Нэмэх</button>
      <button type="button" class="btn btn-warning" id="btnEditGuitsetgel">Засах</button>
      <button type="button" class="btn btn-danger" id="btnDeleteGuitsetgel">Устгах</button>
  </div>
  @if ($errors->any())
          {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <script src="{{url('public/js/guitsetgel/guitsetgel.js')}}"></script>
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

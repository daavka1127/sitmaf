@extends('layouts.layout_main')

@section('content')


  <!-- Datatables -->
      <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

<script>
    var newCompanyUrl = "{{url("/companies/store")}}";
    var newWorksUrl = "{{url("/companies/storeWorks")}}";
    var editWorksUrl = "{{url('/companies/updateWorks')}}";
    var getCompaniesUrl = "{{url("/companies/new/get/company")}}";
    var editCompanyUrl = "{{url("/companies/update")}}";
    var deleteCompanyUrl = "{{url("/companies/delete")}}";
    var getPlansByCompanyIDurl = "{{url("/get/plans/by/companyID")}}";

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
                   "url": "{{url('/companies/new/get/company')}}",
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: "{{ csrf_token() }}"
                      }
                 },
          "columns": [
              { data: "id", name: "id" },
              { data: "companyName", name: "companyName"},
              { data: "heseg_id", name: "heseg_id"},
              { data: "ajliinHeseg", name: "ajliinHeseg"},
              { data: "gereeOgnoo", name: "gereeOgnoo" },
              { data: "hunHuch", name: "hunHuch" },
              { data: "mashinTehnik", name: "mashinTehnik" },
              { data: "mashinTehnik", name: "mashinTehnik", visible:false },
              { data: "hursHuulalt", name: "hursHuulalt" },
              { data: "dalan", name: "dalan" },
              { data: "uhmal", name: "uhmal" },
              { data: "suuriinUy", name: "suuriinUy" },
              { data: "shuuduu", name: "shuuduu" },
              { data: "uhmaliinHamgaalalt", name: "uhmaliinHamgaalalt" },
              { data: "uuliinShuuduu", name: "uuliinShuuduu" }
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
                  <th>Аж ахуй нэгжийн нэр</th>
                  <th>Хэсэг</th>
                  <th>Ажлын хэсэг</th>
                  <th>Ажил эхэлсэн /гэрээ байгуулсан/ огноо</th>
                  <th>Хүн хүч</th>
                  <th>Газар шорооны ажлын машин, техник</th>
                  <th>Гүйцэтгэлийн хувь</th>
                  <th>Хөрс хуулалт</th>
                  <th>Далан</th>
                  <th>Ухмал</th>
                  <th>Суурийн үе</th>
                  <th>Шуудуу</th>
                  <th>Ухмалын хамгаалалт</th>
                  <th>Уулын шуудуу</th>
              </tr>
          </thead>
      </table>


  </div>
  <div class="text-left">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newCompany">Нэмэх</button>
      <button type="button" class="btn btn-warning" id="btnEditCompany">Засах</button>
      <button type="button" class="btn btn-danger" id="btnDeleteCompany">Устгах</button>
  </div>
  @if ($errors->any())
          {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <script src="{{url('public/js/company/company.js')}}"></script>
  <script src="{{url('public/js/work_type/hideShowWorks.js')}}"></script>
  <script src="{{url('public/js/work_type/editHideShowWorks.js')}}"></script>
  @include('company.companyNew')
  @include('company.companyEdit')
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

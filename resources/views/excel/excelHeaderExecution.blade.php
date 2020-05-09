@extends('layouts.layout_main')

@section('content')
  <!-- Datatables -->
      <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">


      <script src="{{url('/public/js/row-merge/jquery.rowspanizer.min.js')}} "></script>

    <script src="{{url("public/js/excel/headerExec.js")}}"></script>
    <script type="text/javascript">
    $(document).ready(function(){
          $('#excelTable').DataTable( {
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
              "stateSave": true,
              "paging":   false,
              "ordering": false,
              "info":     false,
              "bFilter": false,
              dom: 'Bfrtip',
              buttons: [
                  'excel'
              ]
          });
          // $("#excelTable").rowspanizer({
          //     vertical_align: 'middle',
          //     columns: [0, 1]
          // });
      });


    </script>
    @php
      $companies = \App\Http\Controllers\companyController::getCompaniesExcel($heseg1);
      $works = \App\Http\Controllers\ExcellExecutionController::getWorks($wType);
    @endphp
    <div class="row">
      <div class="col-md-3">
        <label style="font-size:15px;" class="text-right" for="">Хэсэгээ сонгоно уу ==></label>
      </div>
      <div class="col-md-3">
        <select red-url="{{url("/excel/header/execution")}}/" id="cmbHeseg" class="form-control" name="">
          @foreach ($allHeseg as $heseg)
              @if($heseg->id == $heseg1)
                <option value="{{$heseg->id}}" selected>{{$heseg->name}}</option>
              @else
                <option value="{{$heseg->id}}">{{$heseg->name}}</option>
              @endif
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <label style="font-size:15px;" class="text-right" for="">Ажлын төрлөө сонгоно уу ==></label>
      </div>
      <div class="col-md-3">
        <select red-url="{{url("/excel/header/execution")}}/" id="cmbWtype" class="form-control" name="">
          @foreach ($workTypes as $workType)
              @if($workType->id == $wType)
                <option value="{{$workType->id}}" selected>{{$workType->name}}</option>
              @else
                <option value="{{$workType->id}}">{{$workType->name}}</option>
              @endif
          @endforeach
        </select>
      </div>
    </div>
    <br>
    <br>
    <br>
    <p><h3 class="text-center"><strong>Төмөр замын гүйцэтгэлийн excel толгой</strong></h3></p>
    <table id="excelTable" class="table">
      <thead>
        <th>Гүйцэтгэгч нэр</th>
        <th>Ажлын талбайн хэмжээ</th>
        <th>Ажлын төрөл</th>
        <th>Хэмжих нэгж</th>
        <th>Гүйцэтгэл хэмжээ</th>
      </thead>
      <tbody>
        @foreach ($companies as $company)
          @foreach ($works as $work)
            <tr>
              <td>{{$company->companyName}}</td>
              <td>{{$company->ajliinHeseg}}</td>
              <td>{{$work->name}}</td>
              <td>{{$work->hemjih_negj}}</td>
              <td></td>
            </tr>
          @endforeach
          <tr style="background-color:green;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Datatables -->
    <script src="{{url('public/vendors/jszip/dist/jszip.min.js')}}"></script>
        <script src="{{url('public/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
        <script src="{{url('public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
        <script src="{{url('public/vendors/jszip/dist/jszip.min.js')}}"></script>
        <script src="{{url('public/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{url('public/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
@endsection

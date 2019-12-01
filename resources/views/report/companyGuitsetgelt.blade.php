@extends('layouts.layout_main')

@section('content')
  <!-- Datatables -->
      <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

<script>
// requires jquery library
jQuery(document).ready(function() {
   jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
 });

</script>
<style>
.table-scroll {
position:relative;
max-width:100%;
margin:auto;
overflow:hidden;
border:1px solid #000;
}
.table-wrap {
width:100%;
overflow:auto;
}
.table-scroll table {
width:100%;
margin:auto;
border-collapse:separate;
border-spacing:0;
}
.table-scroll th, .table-scroll td {
padding:5px 10px;
border:1px solid #000;
background:#fff;
white-space:nowrap;
vertical-align:top;
}
.table-scroll thead, .table-scroll tfoot {
background:#f9f9f9;
}
.clone {
position:absolute;
top:0;
left:0;
pointer-events:none;
}
.clone th, .clone td {
visibility:hidden
}
.clone td, .clone th {
border-color:transparent
}
.clone tbody th {
visibility:visible;
color:red;
}
.clone .fixed-side {
border:1px solid #000;
background:#eee;
visibility:visible;
}
.clone thead, .clone tfoot{background:transparent;}
</style>
<div class="clearfix"></div>

<script src="{{url('public/js/freezecol/freeze-table.js')}}"></script>

<h2 style="text-align:center;"><strong>Аж ахуйн нэгжүүдийн гүйцэтгэлийн тайлан</strong></h2>
<div id="table-scroll" class="table-scroll">
  <div class="table-wrap">
    <table class="main-table">
      <thead>
          <tr>
              <th class="fixed-side" colspan="2">Хэсэг</th>
              <th colspan="{{count($companies3)*2}}">Цогтцэций чиглэл III чиглэл</th>
              <th colspan="{{count($companies2)*2}}">Мандах чиглэл II хэсэг</th>
              <th colspan="{{count($companies1)*2}}">Зүүнбаян чиглэл I хэсэг</th>
          </tr>
          <tr>
              <th class="fixed-side" colspan="2">Аж ахуйн нэр</th>
              @foreach ($companies as $company)
                <th colspan="2">{{$company->companyName}}</th>
              @endforeach
          </tr>
      </thead>
      <tbody>
        <tr>
          <td class="fixed-side" colspan="2">Ажлын хэсэг</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td colspan="2">{{$company1->ajliinHeseg}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side" style="vertical-align: inherit;" rowspan="7">Ажлын тоо хэмжээ /м.куб/</td>
          <td class="fixed-side">Хөрс хуулалт</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td>{{$company1->hursHuulalt}}</td>
            <td>{{$company1->gHursHuulalt}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side">Далан</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td>{{$company1->dalan}}</td>
            <td>{{$company1->gDalan}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side">Ухмал</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td>{{$company1->uhmal}}</td>
            <td>{{$company1->gUhmal}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side">Суурийн үе</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td>{{$company1->suuriinUy}}</td>
            <td>{{$company1->gSuuriinUy}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side">Шуудуу</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td>{{$company1->shuuduu}}</td>
            <td>{{$company1->gShuuduu}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side">Ухмалын хамгаалалт</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td>{{$company1->uhmaliinHamgaalalt}}</td>
            <td>{{$company1->gUhmaliinHamgaalalt}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side">Уулын шуудуу</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
              $guitsetgel1 = App\Http\Controllers\GuitsetgelController::getGuitsetgelTable($company->id);
            @endphp
            <td>{{$company1->uuliinShuuduu}}</td>
            <td>{{$company1->gUuliinShuuduu}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side" colspan="2">Нийт</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td>{{$company1->uuliinShuuduu+$company1->uhmaliinHamgaalalt+$company1->shuuduu+$company1->suuriinUy+$company1->uhmal+$company1->dalan+$company1->hursHuulalt}}</td>
            <td>{{$company1->gUuliinShuuduu+$company1->gUhmaliinHamgaalalt+$company1->gShuuduu+$company1->gSuuriinUy+$company1->gUhmal+$company1->gDalan+$company1->gHursHuulalt}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side" colspan="2">Ажил эхэлсэн гэрээ байгуулсан огноо</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td colspan="2">{{$company1->gereeOgnoo}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side" colspan="2">Хүн хүч</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td colspan="2">{{$company1->hunHuch}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side" colspan="2">Газар шорооны ажлын машин, техник</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getCompanyRow($company->id);
            @endphp
            <td colspan="2">{{$company1->mashinTehnik}}</td>
          @endforeach
        </tr>
        <tr>
          <td class="fixed-side" colspan="2">Гүйцэтгэлт</td>
          @foreach ($companies as $company)
            @php
              $company1 = App\Http\Controllers\GuitsetgelController::getGuitsetgelHuvi($company->id);

            @endphp
            <td colspan="2">{{round($company1, 2)}}%</td>
          @endforeach
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="clearfix"></div>
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

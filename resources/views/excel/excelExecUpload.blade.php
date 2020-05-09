@extends('layouts.layout_main')

@section('content')
  <link rel="stylesheet" href="{{url("public/date-time-picker/jquery.datetimepicker.css")}}">
<script src="{{url("public/date-time-picker/jquery.datetimepicker.full.js")}}"></script>
<script src="{{url("public/js/excel/excelExecUpload.js")}}"></script>
  <script>
      jQuery(document).ready(function () {
           'use strict';
          jQuery('#date').datetimepicker({
          });
      });
  </script>
    <form class="" id="frmUploadExcel" action="{{action("ExcellExecutionController@storeExec")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <p><h3 class="text-center"><strong>Excel файл оруулах</strong></h3></p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Файл оруулах:</label>
                <input type="file" class="form-control" id="hideFile" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            </div>
            <div class="col-md-4">
                <label for="">Гүйцэтгэлийн огноо:</label>
                <div class='input-group date' >
                    <input type="datetime" name="date" id="date" value="" class="form-control" autocomplete="off"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-8 text-center">
                <br>
                <input class="btn btn-primary" type="submit" name="" value="Файлыг оруулах">
            </div>
        </div>
    </form>

    <div class="row">
        @if(isset($errorRows))
            @if(count($errorRows) == 0)
                <div class="alert alert-success" role="alert">
                    <strong>Бүх гүйцэтгэлт орж дууслаа</strong>
                </div>
            @else
                <h4 class="text-center" style="color:red;"><strong>Дараах мөрүүд орсонгүй алдаа гарлаа!!!</strong></h4>
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Д/д</th>
                      <th class="column-title">Гүйцэтгэгч компани </th>
                      <th class="column-title">Хариуцах ПК</th>
                      <th class="column-title">Ажлын нэр</th>
                      <th class="column-title">Хэмжих нэгж </th>
                      <th class="column-title">Гүйцэтгэл </th>
                      <th class="column-title">Гарсан алдаа </th>
                    </tr>
                  </thead>

                  <tbody>
                    @php
                      $i=1;
                    @endphp
                    @foreach ($errorRows as $errorRow)
                      <tr class="even pointer">
                        <td class=" ">{{$i}}</td>
                        <td class=" ">{{$errorRow->company}}</td>
                        <td class=" ">{{$errorRow->pk}}</td>
                        <td class=" ">{{$errorRow->work}}</td>
                        <td class=" ">{{$errorRow->hemjihNegj}}</td>
                        <td class=" ">{{$errorRow->exec}}</td>
                        <td class=" ">{{$errorRow->memo}}</td>
                      </tr>
                      @php
                        $i++;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
            @endif
        @endif
    </div>
@endsection

@extends('layouts.layout_main')
@section('content')
  <link rel="stylesheet" type="text/css" href="{{url('public/jqChart/jqstyles.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{url('public/jqChart/jquery.jqChart.css')}}" />
	<script src="{{url('public/jqChart/jquery.jqChart.min.js')}}" type="text/javascript"></script>
  <script lang="javascript" type="text/javascript">
      $(document).ready(function () {
          $('#jqChart').jqChart({
              title: { text: 'Аж ахуйн нэгжийн гүйцэтгэлийн хувь' },
              animation: {
                  duration: 1
              },
              axes: [
                  {
                      type: 'category',
                      location: 'bottom',

                      categories: [
                        @foreach ($companies as $company)
                            '{{$company->companyName}}',
                        @endforeach
                        ],
                      labels: {
                          font: '12px sans-serif',
                          angle: -90
                      }
                  }
              ],
              series: [
                  {
										title: 'Гүйцэтгэлийн хувь',
                      type: 'column',
                      data: [
                        @foreach ($companies as $company)
                        @php
                          $dundaj = App\Http\Controllers\GuitsetgelController::getGuitsetgelHuvi($company->id);
                        @endphp
                            {{round($dundaj, 2)}},
                        @endforeach

                      ]
                  }
              ]
          });
      });
  </script>
  <div class="clearfix"></div>
  <div>
      <div id="jqChart" style="height: 500px;" class="col-md-12"></div>
  </div>
@endsection

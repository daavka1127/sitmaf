@extends('layouts.layout_main')
@section('content')
  <style>
    #chart {
      max-width: 950px;
      margin: 35px auto;
    }
    </style>
  <div id="app"></div>


  <div id="html">
          &lt;div id=&quot;chart&quot;&gt;&#10;&lt;ReactApexChart options={this.state.options} series={this.state.series} type=&quot;bar&quot; height=&quot;350&quot; /&gt;&#10;          &lt;/div&gt;
  </div>
  <script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/prop-types@15.6.2/prop-types.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <script src="https://unpkg.com/react-apexcharts@1.1.0/dist/react-apexcharts.iife.min.js"></script>

<script type="text/babel">

  class BarChart extends React.Component {

    constructor(props) {
      super(props);

      this.state = {
        options: {
          plotOptions: {
          bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            dataLabels: {
              position: 'bottom'
            },
          }
        },
        dataLabels: {
          enabled: true,
          textAnchor: 'start',
          style: {
            colors: ['#fff']
          },
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
          },
          offsetX: 0,
          dropShadow: {
            enabled: true
          }
        },

        stroke: {
          width: 1,
          colors: ['#fff']
        },
        xaxis: {
          categories: [
            @foreach ($companies as $company)
                '{{$company->companyName}}',
            @endforeach
          ],
        },
        yaxis: {
          labels: {
            show: false
          }
        },
        title: {
            text: 'Аж ахуйн нэгжийн гүйцэтгэлийн график',
            align: 'center',
            floating: true
        },
        subtitle: {
            text: 'Гүйцэтгэлийн хувиар',
            align: 'center',
        },
        tooltip: {
          theme: 'dark',
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function () {
                return ''
              }
            }
          }
        }
        },
        series: [{
          data: [
            @foreach ($companies as $company)
                @php
                  $dundaj = App\Http\Controllers\GuitsetgelController::getGuitsetgelHuvi($company->id);
                @endphp
                {{round($dundaj+10, 2)}},
            @endforeach
          ]
        }],
      }
    }

    render() {

      return (
        <div>
          <div id="chart">
            <ReactApexChart options={this.state.options} series={this.state.series} type="bar" height="850" />
          </div>
          <div id="html-dist">
          </div>
        </div>
      );
    }
  }

  const domContainer = document.querySelector('#app');
  ReactDOM.render(React.createElement(BarChart), domContainer);

</script>
@endsection

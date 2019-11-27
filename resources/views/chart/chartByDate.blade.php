<script>
$(document).ready(function () {
            $('#jqChart').jqChart({
                title: { text: 'Гүйцэтгэлт /хоногоор/, /м.куб/' },
                animation: { duration: 2 },
                axes: [
                    {
                        type: 'dateTime',
                        location: 'bottom',
                        interval: 1,
                        intervalType: 'days' // 'years' |  'months' | 'weeks' | 'days' | 'minutes' | 'seconds' | 'millisecond'
                    }
                ],
                series: [

                    {
                        type: 'line',
                        title: 'Хөрс хуулалт',
                        data: [
                          @foreach ($datas as $data)
                          @php
                            $date = explode("-",$data->ognoo);
                          @endphp
                          @if($data->gHursHuulalt != null)
                          [new Date({{$date[0]}}, {{$date[1]-1}}, {{$date[2]}}), {{$data->gHursHuulalt}}],
                          @endif
                          @endforeach
                        ]
                    },
                    {
                        type: 'line',
                        title: 'Далан',
                        data: [
                          @foreach ($datas as $data)
                        @php
                          $date = explode("-",$data->ognoo);
                        @endphp
                        @if($data->gDalan != null)
                        [new Date({{$date[0]}}, {{$date[1]-1}}, {{$date[2]}}), {{$data->gDalan}}],
                        @endif
                        @endforeach
                      ]
                    },
                    {
                        type: 'line',
                        title: 'Ухмал',
                        data: [
                          @foreach ($datas as $data)
                        @php
                          $date = explode("-",$data->ognoo);
                        @endphp
                        @if($data->gUhmal != null)
                        [new Date({{$date[0]}}, {{$date[1]-1}}, {{$date[2]}}), {{$data->gUhmal}}],
                        @endif
                        @endforeach
                      ]
                    },
                    {
                        type: 'line',
                        title: 'Суурийн үе',
                        data: [
                          @foreach ($datas as $data)
                        @php
                          $date = explode("-",$data->ognoo);
                        @endphp
                        @if($data->gSuuriinUy != null)
                        [new Date({{$date[0]}}, {{$date[1]-1}}, {{$date[2]}}), {{$data->gSuuriinUy}}],

                        @endif
                        @endforeach
                      ]
                    },
                    {
                        type: 'line',
                        title: 'Шуудуу',
                        data: [
                          @foreach ($datas as $data)
                        @php
                          $date = explode("-",$data->ognoo);
                        @endphp
                        @if($data->gShuuduu != null)
                        [new Date({{$date[0]}}, {{$date[1]-1}}, {{$date[2]}}), {{$data->gShuuduu}}],

                        @endif
                        @endforeach
                      ]
                    },
                    {
                        type: 'line',
                        title: 'Ухмалын хамгаалалт',
                        data: [
                          @foreach ($datas as $data)
                        @php
                          $date = explode("-",$data->ognoo);
                        @endphp
                        @if($data->gUhmaliinHamgaalalt != null)
                        [new Date({{$date[0]}}, {{$date[1]-1}}, {{$date[2]}}), {{$data->gUhmaliinHamgaalalt}}],
                        @endif
                        @endforeach
                      ]
                    },
                    {
                        type: 'line',
                        title: 'Уулын шуудуу',
                        data: [
                          @foreach ($datas as $data)
                        @php
                          $date = explode("-",$data->ognoo);
                        @endphp
                        @if($data->gUuliinShuuduu != null)
                        [new Date({{$date[0]}}, {{$date[1]-1}}, {{$date[2]}}), {{$data->gUuliinShuuduu}}],
                        @endif
                        @endforeach
                      ]
                    }
                ]
            });
        });
</script>

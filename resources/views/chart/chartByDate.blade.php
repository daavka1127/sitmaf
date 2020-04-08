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
                  @foreach ($datas as $data)
                    {
                        type: 'line',
                        title: '{{$data->nameExec}}',
                        data: [

                          @php
                            $works = App\Http\Controllers\GuitsetgelController::getWorkExecution($data->companyID, $data->work_id);
                          @endphp
                            @foreach ($works as $work)
                              @php
                                $date = explode("-",$work->date);
                              @endphp
                              @if($work->execution != null)
                              [new Date({{$date[0]}}, {{$date[1]-1}}, {{$date[2]}}), {{$work->execution}}],
                              @endif
                            @endforeach
                        ]
                    },
                    @endforeach

                ]
            });
        });
</script>

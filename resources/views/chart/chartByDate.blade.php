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
                    $tot = 0;
                  @endphp
                    @foreach ($works as $work)
                      @php
                        $date = explode("-",$work->date);
                        $tot += $work->execution;
                        if($work->execution != null)
                          echo "[new Date(($date[0]), $date[1]-1, $date[2]), $tot],";


                      @endphp

                    @endforeach
                ]
            },
            @endforeach

        ]
    });
});
</script>

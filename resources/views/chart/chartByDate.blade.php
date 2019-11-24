<script>
$(document).ready(function () {
            $('#jqChart').jqChart({
                title: { text: 'Гүйцэтгэл' },
                animation: { duration: 1 },
                axes: [
                    {
                        type: 'dateTime',
                        location: 'bottom',
                        minimum: new Date(2011, 1, 4),
                        maximum: new Date(2011, 1, 18),
                        interval: 1,
                        intervalType: 'days' // 'years' |  'months' | 'weeks' | 'days' | 'minutes' | 'seconds' | 'millisecond'
                    }
                ],


                series: [
                    {

                        type: 'line',
                        title: 'Lool',
                        data: [[new Date(2011, 1, 6), 70],
                              [new Date(2011, 1, 8), 82],
                              [new Date(2011, 1, 10), 85],
                              [new Date(2011, 1, 12), 70],
                              [new Date(2011, 1, 14), 65],
                              [new Date(2011, 1, 16), 68]]
                    },
                    {
                        type: 'line',

                        data: [[new Date(2011, 1, 6), 170],
                              [new Date(2011, 1, 8), 182],
                              [new Date(2011, 1, 10), 185],
                              [new Date(2011, 1, 12), 170],
                              [new Date(2011, 1, 14), 165],
                              [new Date(2011, 1, 16), 168]]
                    },
                    {
                        type: 'line',

                        data: [[new Date(2011, 1, 6), 10],
                              [new Date(2011, 1, 8), 12],
                              [new Date(2011, 1, 10), 15],
                              [new Date(2011, 1, 12), 10],
                              [new Date(2011, 1, 14), 15],
                              [new Date(2011, 1, 16), 18]]
                    }
                ]
            });
        });
</script>

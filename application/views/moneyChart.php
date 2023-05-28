<?php
    $getDataChart = $this->Dashboard_model->getDataChart();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="chartWeek" style="height: 280%"></div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
<script type="text/javascript">
    var domWeek = document.getElementById("chartWeek");
    var myChartWeek = echarts.init(domWeek);
    var appWeek = {};

    var optionWeek;

    optionWeek = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [
            {
                name: 'จำนวน',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2
                },
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '40',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: [
                    {value: <?php echo $getDataChart->Bag; ?>, name: 'กระเป๋า'},
                    {value: <?php echo $getDataChart->Shoe; ?>, name: 'รองเท้า'},
                    {value: <?php echo $getDataChart->Other; ?>, name: 'อื่นๆ'}
                ]
            }
        ]
    };

    if (optionWeek && typeof optionWeek === 'object') {
        myChartWeek.setOption(optionWeek);
    }

</script>
</body>
</html>
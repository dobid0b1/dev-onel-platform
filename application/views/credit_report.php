<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>C R E D I T | W E B &nbsp; M A N A G E</title>
    <link rel="icon" href="<?php echo base_url();?>images/logo.png">

    <!-- ----------------- STYLE ----------------- -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>css/styleAll.css">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <!-- ----------------- SCRIPT ----------------- -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php echo base_url();?>css/assets/scripts/main.js"></script></body>
        <script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ------------------------------------------ -->
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php require_once('menu/topBar.php'); ?>

        <div class="app-main">
            <?php require_once('menu/sideBar.php'); ?>

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>รายงานการเงิน
                                    <div class="page-title-subheading">
                                        รายงานสรุปเกี่ยวกับการเงิน
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>  

                    <div class="row m-0">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="col-6">รายงานการเงิน</div>
                                    <!-- <div class="col-6 text-right">
                                        <button class="btn btn-warning">
                                            <i class="fas fa-print"></i>
                                            Print
                                        </button>
                                    </div> -->
                                </div>   
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <?php
                                                if(!empty($_GET['date'])){
                                                    $selectDate = $_GET['date'];
                                                    if($selectDate == 'all'){
                                            ?>
                                            <a href="?date=all"><button class="btn-wide btn mr-2 btn-info">ทั้งหมด</button></a>
                                            <a href="?date=today&value=<?php echo date('Y-m-d');?>"><button class="btn-wide btn mr-2">วันนี้</button></a>
                                            <a href="?date=month&value=<?php echo date('Y-m');?>"><button class="btn-wide btn mr-2">เดือนนี้</button></a>
                                            <button class="btn-wide btn mr-2" id="selectDateShow" onclick='showInputDate()'>เลือกวันที่แสดง</button>
                                            <?php 
                                                    }else if($selectDate == 'today'){
                                            ?>
                                            <a href="?date=all"><button class="btn-wide btn mr-2">ทั้งหมด</button></a>
                                            <a href="?date=today&value=<?php echo date('Y-m-d');?>"><button class="btn-wide btn mr-2 btn-info">วันนี้</button></a>
                                            <a href="?date=month&value=<?php echo date('Y-m');?>"><button class="btn-wide btn mr-2">เดือนนี้</button></a>
                                            <button class="btn-wide btn mr-2" id="selectDateShow" onclick='showInputDate()'>เลือกวันที่แสดง</button>
                                            <?php
                                                    }else if($selectDate == 'month'){
                                            ?>
                                            <a href="?date=all"><button class="btn-wide btn mr-2">ทั้งหมด</button></a>
                                            <a href="?date=today&value=<?php echo date('Y-m-d');?>"><button class="btn-wide btn mr-2">วันนี้</button></a>
                                            <a href="?date=month&value=<?php echo date('Y-m');?>"><button class="btn-wide btn mr-2 btn-info">เดือนนี้</button></a>
                                            <button class="btn-wide btn mr-2" id="selectDateShow" onclick='showInputDate()'>เลือกวันที่แสดง</button>
                                            <?php
                                                    }else if($selectDate == '1'){
                                            ?>
                                            <a href="?date=all"><button class="btn-wide btn mr-2">ทั้งหมด</button></a>
                                            <a href="?date=today&value=<?php echo date('Y-m-d');?>"><button class="btn-wide btn mr-2">วันนี้</button></a>
                                            <a href="?date=month&value=<?php echo date('Y-m');?>"><button class="btn-wide btn mr-2">เดือนนี้</button></a>
                                            <button class="btn-wide btn mr-2 btn-info" id="selectDateShow" onclick='showInputDate()'>เลือกวันที่แสดง</button>
                                            <?php
                                                        if(!empty($_GET['dateStart']) && !empty($_GET['dateEnd'])){
                                                            $dateStart = $_GET['dateStart'];
                                                            $dateEnd = $_GET['dateEnd'];
                                            ?><br><br>
                                                            <div id="showInputDate" class='animated fadeInRight'>
                                                                <form action="credit_report" method="get">
                                                                    <input type="hidden" name="date" value="1">
                                                                    <div class="input-group" style="width: 20%;float: left;">
                                                                        <input type="date" class="form-control" name="dateStart" value="<?php echo $dateStart;?>" required> 
                                                                    </div>
                                                                    <span class="btn" style="float: left;cursor:auto;"> ถึง </span>
                                                                    <div class="input-group" style="width: 20%;float: left;">
                                                                        <input type="date" class="form-control" name="dateEnd" value="<?php echo $dateEnd;?>" required>
                                                                    </div>
                                                                    <div class="input-group ml-2" style="width: 10%;float: left;">
                                                                        <input type="submit" class="form-control bg-info text-white" value='ยืนยัน'>
                                                                    </div>
                                                                </form>
                                                            </div>
                                            <?php
                                                        }
                                                    }else{
                                            ?>
                                            <a href="?date=all"><button class="btn-wide btn mr-2 btn-info">ทั้งหมด</button></a>
                                            <a href="?date=today&value=<?php echo date('Y-m-d');?>"><button class="btn-wide btn mr-2">วันนี้</button></a>
                                            <a href="?date=month&value=<?php echo date('Y-m');?>"><button class="btn-wide btn mr-2">เดือนนี้</button></a>
                                            <button class="btn-wide btn mr-2" id="selectDateShow" onclick='showInputDate()'>เลือกวันที่แสดง</button>
                                            <?php
                                                    }
                                                }else{
                                            ?>
                                            <a href="?date=all"><button class="btn-wide btn mr-2 btn-info">ทั้งหมด</button></a>
                                            <a href="?date=today&value=<?php echo date('Y-m-d');?>"><button class="btn-wide btn mr-2">วันนี้</button></a>
                                            <a href="?date=month&value=<?php echo date('Y-m');?>"><button class="btn-wide btn mr-2">เดือนนี้</button></a>
                                            <button class="btn-wide btn mr-2" id="selectDateShow" onclick='showInputDate()'>เลือกวันที่แสดง</button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div id="showInputDate" style="display:none;" class='animated fadeInRight'>
                                                <form action="credit_report" method="get">
                                                    <input type="hidden" name="date" value="1">
                                                    <div class="input-group" style="width: 20%;float: left;">
                                                        <input type="date" class="form-control" name="dateStart" required> 
                                                    </div>
                                                    <span class="btn" style="float: left;cursor:auto;"> ถึง </span>
                                                    <div class="input-group" style="width: 20%;float: left;">
                                                        <input type="date" class="form-control" name="dateEnd" required>
                                                    </div>
                                                    <div class="input-group ml-2" style="width: 10%;float: left;">
                                                        <input type="submit" class="form-control bg-info text-white" value='ยืนยัน'>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-12"><hr></div>

                                        <div class="col-md-8">
                                            <div class="main-card mb-3 card">
                                                <!-- <div class="card-header">สัดส่วนสินค้า</div> -->
                                                <?php //require_once('chartReport_credit.php') ;?>

                                                <div id="chartWeek" style="height: 300%"></div>
                                            </div>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <div class="card-shadow-success border card card-body border-success text-center p-2">
                                                <h5>ยอดเงิน</h5>

                                                กระเป๋า: <b><?php echo number_format($sumAllCredit->Bag); ?></b><br>
                                                รองเท้า: <b><?php echo number_format($sumAllCredit->Shoe); ?></b><br>
                                                อื่นๆ: <b><?php echo number_format($sumAllCredit->Other); ?></b><br><br>
                                                ยอดรวม: <?php echo number_format($sumAllCredit->Bag+$sumAllCredit->Shoe+$sumAllCredit->Other); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-xl-12 mb-3">
                                            <div class="card-shadow-focus border card card-body border-focus p-2">
                                                <div class="table-responsive">
                                                    <table id="credit" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>#</th>
                                                                <th>รายการ</th>
                                                                <th>รายละเอียด</th>
                                                                <th>ยอดเงิน</th>
                                                                <th>สถานะ</th>
                                                                <th>หมายเหตุ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            if($worksheet) {
                                                                foreach($worksheet as $ws) {
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $ws['worksheet_id']; ?></td>
                                                                        <td class="text-center">                                                                            
                                                                            <?php
                                                                            $subbrand = $ws['worksheet_subbrand'];
                                                                            if($subbrand) {
                                                                                $brand = $ws['worksheet_brand']." - ".$subbrand;
                                                                            }
                                                                            else {
                                                                                $brand = $ws['worksheet_brand'];
                                                                            }

                                                                            $type =  $ws['worksheet_type'];
                                                                            if($type == 'bag') {
                                                                                $typeThai = "กระเป๋า";
                                                                            }
                                                                            elseif($type == 'shoe') {
                                                                                $typeThai = "รองเท้า";
                                                                            }
                                                                            else {
                                                                                $typeThai = 'อื่นๆ';
                                                                            }

                                                                            echo $typeThai."<br>".$brand;
                                                                            ?>
                                                                            
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php 
                                                                            $comment = $ws['worksheet_comment'];
                                                                            if($comment) {
                                                                                $comment = $ws['worksheet_comment'];
                                                                            }
                                                                            else {
                                                                                $comment = "-";
                                                                            }

                                                                            $service_type = $ws['worksheet_service_type'];
                                                                            if($service_type == 'spa') {
                                                                                $service_type = 'Spa & Cleaning';
                                                                            }
                                                                            elseif($service_type == 'color') {
                                                                                $service_type = 'Re-color & Paint';
                                                                            }
                                                                            else {
                                                                                $service_type = 'Fix & Repair';
                                                                            }

                                                                            echo $service_type."<br>".$comment;
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php 
                                                                            $credit = $ws['worksheet_credit']; 
                                                                            if($credit) {
                                                                                $credit = number_format($ws['worksheet_credit']); 
                                                                            }
                                                                            else {
                                                                                $credit = '-';
                                                                            }

                                                                            echo $credit;
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php 
                                                                            $get_credit = $ws['worksheet_get_money'];
                                                                            if($get_credit) {
                                                                                $date_get = date_create($get_credit);
                                                                                $date_get = date_format($date_get,"Y-m-d");
                                                                                $get_credit = 'ชำระเงินแล้ว'.'<br>'.$date_get;
                                                                            } 
                                                                            else {
                                                                                $get_credit = 'ยังไม่ชำระเงิน';
                                                                            }

                                                                            echo $get_credit;
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php 
                                                                            $flag = $ws['worksheet_flag'];
                                                                            if($flag == 0) {
                                                                                $note = $ws['worksheet_status'].'<br>'.$ws['worksheet_track']; 
                                                                            }
                                                                            else {
                                                                                $note = $ws['worksheet_track'];
                                                                            } 
                                                                            echo $note; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('menu/footer.php'); ?>
            </div>
        </div>
    </div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
<script>
    $(document).ready(function() {
        $('#credit').DataTable({
            "language": {
                "emptyTable": "ไม่มีข้อมูล"
            },
            "order": [[ 0, "desc" ]]
        });
    });
    function showInputDate(){
        var x = document.getElementById("showInputDate");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
<script type="text/javascript">
    var domWeek = document.getElementById("chartWeek");
    var myChartWeek = echarts.init(domWeek);
    var appWeek = {};

    var optionWeek;

    optionWeek = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {            
                type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',
                data: ['กระเป๋า', 'รองเท้า', 'อื่นๆ'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: 'ราคารวม',
                type: 'bar',
                barWidth: '60%',
                data: [<?php echo $sumAllCredit->Bag; ?>, <?php echo $sumAllCredit->Shoe; ?>, <?php echo $sumAllCredit->Other; ?>]
            
            }
        ]
    };

    if (optionWeek && typeof optionWeek === 'object') {
        myChartWeek.setOption(optionWeek);
    }

</script>

<body>
</html>
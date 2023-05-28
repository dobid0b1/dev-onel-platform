<?php date_default_timezone_set("Asia/Bangkok"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>D A S H B O A R D | W E B &nbsp; M A N A G E</title>
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
        <script>
            $(document).ready( function () {
                var tableWorksheet = $('#tableWorksheet').DataTable({
                    "lengthMenu": [[5, 20, 50, -1], [5, 20, 50, "All"]],
                    "order": [[ 2, "desc" ]],
                    "ajax": '<?php echo base_url('dashboard/showAllWorksheet');?>'
                });
                // setInterval( function () {
                //     tableWorksheet.ajax.reload();
                // }, 5000 );
            } );
        </script>
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
                                    <i class="pe-7s-rocket icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Dashboard
                                    <div class="page-title-subheading">
                                        ข้อมูลสรุป, จัดการใบงาน, กราฟแสดงผล
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>           
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">ใบงานค้าง</div>
                                <div class="table-responsive p-3">
                                    <table id="tableWorksheet" width="100%" style="font-size: .8rem"
                                    class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>สินค้า</th>
                                                <th class="text-center">วันเดือนปี</th>
                                                <th class="text-center">สถานะ</th>
                                                <th class="text-center">การจัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                        if ($countWorksheet) {
                            foreach($countWorksheet as $countW){
                                $allCount = $countW['allCount'];
                                if($allCount == 0){
                                    $allCount = 1;
                                }

                                if(empty($countW['w'])){
                                    $w = 0;
                                }else $w = $countW['w'];

                                if(empty($countW['r'])){
                                    $r = 0;
                                }else $r = $countW['r'];

                                if(empty($countW['s'])){
                                    $s = 0;
                                }else $s = $countW['s'];

                                $w = ($w*100)/$allCount;
                                $r = ($r*100)/$allCount;
                                $s = ($s*100)/$allCount;
                            }
                        }
                    ?>
                    
                    <div class="row">
                        <!--<div class="col-md-6 col-lg-4">-->
                        <!--    <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-left card">-->
                        <!--        <div class="widget-content">-->
                        <!--            <div class="widget-content-outer">-->
                        <!--                <div class="widget-content-wrapper">-->
                        <!--                    <div class="widget-content-left pr-2 fsize-1">-->
                        <!--                        <div class="widget-numbers mt-0 fsize-3 text-warning"><?php echo number_format($w,2); ?>%</div>-->
                        <!--                    </div>-->
                        <!--                    <div class="widget-content-right w-100">-->
                        <!--                        <div class="progress-bar-xs progress">-->
                        <!--                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo number_format($w,2); ?>%;"></div>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="widget-content-left fsize-1">-->
                        <!--                    <div class="text-muted opacity-6">รอลูกค้าส่งสินค้า</div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-md-6 col-lg-6">
                            <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left pr-2 fsize-1">
                                                <div class="widget-numbers mt-0 fsize-3 text-danger"><?php echo number_format($r,2); ?>%</div>
                                            </div>
                                            <div class="widget-content-right w-100">
                                                <div class="progress-bar-xs progress">
                                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo number_format($r,2); ?>%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left fsize-1">
                                            <div class="text-muted opacity-6">ร้านค้ารับสินค้าแล้ว</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left pr-2 fsize-1">
                                                <div class="widget-numbers mt-0 fsize-3 text-success"><?php echo number_format($s,2); ?>%</div>
                                            </div>
                                            <div class="widget-content-right w-100">
                                                <div class="progress-bar-xs progress">
                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo number_format($s,2); ?>%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left fsize-1">
                                            <div class="text-muted opacity-6">ส่งกลับลูกค้าแล้ว</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="main-card mb-3 card">
                                <div class="card-header">สัดส่วนสินค้า</div>
                                <?php require_once('moneyChart.php') ;?>
                            </div>
                        </div>
                        <div class="col-7" id="top5">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="col-6">5 อันดับผู้มาใช้บริการ</div>
                                    <div class="col-6 text-right">
                                        <a href="<?php echo base_url();?>dashboard">
                                            <button class="btn btn-info">รีเฟรช</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 p-2 text-center">
                                            <table width="100%" style="font-size: .8rem"
                                            class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>จำนวนเงินรวม(บาท)</th>
                                                        <th>ส่งงาน(ครั้ง)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    if($top5){
                                                        $top = 1;
                                                        foreach($top5 as $tf){
                                                            echo '<tr>';
                                                            echo '<td>';
                                                            if($top == 1){
                                                                echo '<img src="'.base_url().'images/1.png" width="30px">';
                                                            }
                                                            else if($top == 2){
                                                                echo '<img src="'.base_url().'images/2.png" width="30px">';
                                                            }
                                                            else if($top == 3){
                                                                echo '<img src="'.base_url().'images/3.png" width="30px">';
                                                            }
                                                            else{
                                                                echo $top;
                                                            }
                                                            echo '</td>';
                                                            echo '<td width="50%" class="text-left">'.$tf['user_name'].'</td>';
                                                            echo '<td width="25%">'.number_format($tf['countAll'],0).'</td>';
                                                            echo '<td width="25%">'.number_format($tf['countWS']).'</td>';
                                                            echo '</tr>';
                                                            $top++;
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
                        <div class="col-12" id="trackStaff">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="col-6">ติดตามพนักงาน (งานค้าง)</div>
                                    <div class="col-6 text-right">
                                        <a href="<?php echo base_url();?>dashboard">
                                            <button class="btn btn-info">รีเฟรช</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                            if($countWSStaff){
                                                foreach($countWSStaff as $cWS){
                                                    echo '<div class="col-3 ">';
                                                    echo '<div class="main-card mb-3 card text-center p-2">';
                                                    echo '<h1 class="text-info">'.$cWS['countWS'].'</h1>';
                                                    echo $cWS['staff_name'].'<br>ตำแหน่ง: ';
                                                    echo $cWS['staff_position'];
                                                    echo '</div></div>';
                                                }
                                            }
                                        ?>
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

    <div class="modal fade" id="detailWS" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียดใบงาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 p-3 mb-2">
                        สถานะ : <span id="worksheetStatus"></span><br>
                    </div>

                    <div class="col-6">
                        <div class="form-floating mb-3">

                            <input list="track" class="form-control" id="worksheetTrackDatalist" 
                            placeholder=".." onChange="get_data()" 
                            autocomplete="off" required>
                            <datalist id="track">
                                <?php
                                    foreach($datalistTrack as $dlT){
                                        echo '<option value="'.$dlT['worksheet_track'].'">';
                                    }
                                ?>
                            </datalist>
                            <label for="floatingInput">ขั้นตอน:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="worksheetStaff" aria-label="Floating label select example">
                                <option value="">เลือกพนักงานรับผิดชอบ</option>
                                <?php 
                                    if($allStaff){
                                        foreach($allStaff as $aS){
                                            echo '<option value="'.$aS['staff_name'].'">'.$aS['staff_name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>

                            <label for="floatingSelect">ผู้รับผิดชอบ:</label>
                        </div>
                    </div>

                    <?php 
                        $staff_level = $this->session->userdata('staff_ses_level');
                        if($staff_level == 'admin' || $staff_level == 'manager') {
                    ?>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="worksheetPrice" placeholder="..">
                                <label for="floatingInput">ราคา:</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="worksheetDateMoney" placeholder="..">
                                <label for="floatingInput">วันที่รับโอน:</label>
                            </div>
                        </div>
                    <?php
                    }else{ ?>
                        <input type="hidden" class="form-control" id="worksheetPrice" placeholder="..">
                        <input type="hidden" class="form-control" id="worksheetDateMoney" placeholder="..">
                    <?php
                    }
                    ?>
                    
                    <h6 class="text-center">การจัดส่ง</h6><br>
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input list="provider" class="form-control" id="providerLogis" placeholder=".." >
                            <datalist id="provider">
                                <option value="เคอรี่ เอ็กเพรส">
                                <option value="แฟรช เอ็กเพรส">
                                <option value="ไปรษณีย์ไทย">
                            </datalist>
                            <label for="floatingInput">บริการขนส่ง:</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tagLogis" placeholder=".."
                            onChange="getTagLogis()">
                            <label for="floatingInput">เลขที่พัสดุ:</label>
                        </div>
                    </div>


                </div>

                <hr><h6 class="text-center">ข้อมูลสินค้า</h6><br>
                <div class="row p-0">
                    <div class="col-2 text-center">
                        <div id='imgType'></div>
                    </div>
                    <div class="col-10">
                        <div class="row">
                            <div class="col-2 pr-2 pl-2">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" id="worksheetID" placeholder=".." readonly>
                                    <label for="floatingInput">#item:</label>
                                </div>
                            </div>
                            <div class="col-10 pr-3 pl-1">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" id="worksheetComment" placeholder="..">
                                    <label for="floatingInput">อาการ/สิ่งที่ต้องทำ:</label>
                                </div>
                            </div>

                            <div class="col-6 pr-2 pl-2">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" id="worksheetBrand" placeholder=".." readonly>
                                    <label for="floatingInput">ยื่ห้อ:</label>
                                </div>
                            </div>

                            <div class="col-6 pr-3 pl-1">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" id="worksheetSubbrand" placeholder=".." readonly>
                                    <label for="floatingInput">รุ่น:</label>
                                </div>
                            </div>
                        </div>                     
                        
                    </div>

                    <div class="col-6 pr-2 pl-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="worksheetRD" placeholder=".." readonly>
                            <label for="floatingInput">วันที่ร้านรับสินค้า:</label>
                        </div>
                    </div>
                    <div class="col-6 pr-3 pl-1">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="worksheetED" placeholder=".." readonly>
                            <label for="floatingInput">วันที่ส่งกลับ:</label>
                        </div>
                    </div>
                </div><br>

                <hr>
                <div class="row">
                    <div class="col-3">
                        <div id='imgOne'></div>
                    </div>

                    <div class="col-3">
                        <div id='imgTwo'></div>
                    </div>
                </div>

                <hr><h6 class="text-center">ข้อมูลลูกค้า</h6><br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="worksheetName" placeholder=".." readonly>
                            <label for="floatingInput">ชื่อ:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="worksheetPhone" placeholder=".." readonly>
                            <label for="floatingInput">เบอร์โทรศัพท์:</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="confirmWsBtn()">บันทึก</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
            </div>
        </div>
    </div>

    <script>
        function showDetailWS(wsID){
            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>dashboard/getDetailWorksheet',
                data: {wsID: wsID},
                cache: 0,
                async: 1,

                success: function(resp){
                    var obj = $.parseJSON(resp);

                    if(obj[0].worksheet_get_money){
                        const myArr = obj[0].worksheet_get_money.split(" ");
                        $('#worksheetDateMoney').val(myArr[0]);
                    }else{
                        $('#worksheetDateMoney').val('0000-00-00');
                    }

                    if(obj[0].worksheet_status == 'รอส่งร้าน'){
                        var status = "<span class='badge badge-warning'>รอลูกค้าส่งสินค้า</span>";
                        var statusBtn = "<button class='btn btn-success' onclick='showDetailW()'>ยืนยันการรับสินค้า</button>";
                    }else if(obj[0].worksheet_status == 'ร้านรับแล้ว'){
                        var status = "<span class='badge badge-danger'>กำลังดำเนินการ</span>";
                        var statusBtn = "<button class='btn btn-warning'>ยืนยันการการจัดส่ง</button>";
                    }else{
                        var status = "<span class='badge badge-success'>ส่งสินค้าคืนลูกค้าแล้ว</span>";
                        var statusBtn = "";
                    }

                    if(obj[0].worksheet_img_path_one){
                        imgOne = `<a href="<?php echo base_url();?>${obj[0].worksheet_img_path_one}" target="_new">`;
                        imgOne += `<img src="<?php echo base_url();?>${obj[0].worksheet_img_path_one}" alt="" width="100%">`;
                        imgOne += `</a>`;
                    }
                    if(obj[0].worksheet_img_path_two){
                        imgTwo = `<a href="<?php echo base_url();?>${obj[0].worksheet_img_path_two}" target="_new">`;
                        imgTwo += `<img src="<?php echo base_url();?>${obj[0].worksheet_img_path_two}" alt="" width="100%">`;
                        imgTwo += `</a>`;
                    }

                    $('#imgOne').html(imgOne);
                    $('#imgTwo').html(imgTwo);
                    $('#worksheetStatus').html(status);
                    $('#worksheetID').val(obj[0].worksheet_id);
                    $('#worksheetBrand').val(obj[0].worksheet_brand);
                    $('#worksheetSubbrand').val(obj[0].worksheet_subbrand);

                    if(obj[0].worksheet_create_date){
                        wsCD = obj[0].worksheet_create_date;
                    }else wsCD = 'ไม่มีข้อมูล';

                    if(obj[0].worksheet_receive_date){
                        wsRD = obj[0].worksheet_receive_date;
                    }else wsRD = 'ไม่มีข้อมูล';

                    if(obj[0].worksheet_end_date){
                        wsED = obj[0].worksheet_end_date;
                    }else wsED = 'ไม่มีข้อมูล';

                    $('#worksheetCD').val(wsCD);
                    $('#worksheetRD').val(wsRD);
                    $('#worksheetED').val(wsED);
                    $('#worksheetComment').val(obj[0].worksheet_comment);
                    $('#worksheetTrackDatalist').val(obj[0].worksheet_track);
                    $('#worksheetName').val(obj[0].user_name);
                    $('#worksheetPhone').val(obj[0].user_phone);

                    if(obj[0].worksheet_type == 'bag'){
                        imgType = `<img src="<?php echo base_url();?>images/bag.png" alt="" width="100%"><br>กระเป๋า`;
                    }else if(obj[0].worksheet_type == 'shoe'){
                        imgType = `<img src="<?php echo base_url();?>images/shoe.png" alt="" width="100%"><br>รองเท้า`;
                    }else{
                        imgType = `<img src="<?php echo base_url();?>images/other.png" alt="" width="100%"><br>อื่นๆ`;
                    }
                    $('#imgType').html(imgType);
                    $('#statusBtn').html(statusBtn);
                    $('#worksheetStaff').val(obj[0].worksheet_staff);
                    $('#worksheetPrice').val(obj[0].worksheet_credit);
                    $('#providerLogis').val(obj[0].worksheet_provider_logis);
                    $('#tagLogis').val(obj[0].worksheet_tag_logis);


                    $('#detailWS').modal('show');
                }
            });

        }

        function confirmWsBtn(){
            var wsTrack = $('#worksheetTrackDatalist').val();
            var wsStaff = $('#worksheetStaff').val();
            var wsPrice = $('#worksheetPrice').val();
            var wsID = $('#worksheetID').val();
            var wsRD = $('#worksheetRD').val();
            var wsED = $('#worksheetED').val();
            var providerLogis = $('#providerLogis').val();
            var tagLogis = $('#tagLogis').val();
            var getMoney = $('#worksheetDateMoney').val();
            var Comment = $('#worksheetComment').val();

            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>dashboard/updateWorksheetData',
                data: {wsTrack: wsTrack,
                        wsStaff: wsStaff,
                        wsPrice: wsPrice,
                        wsID: wsID,
                        wsRD: wsRD,
                        wsED: wsED,
                        providerLogis: providerLogis,
                        tagLogis: tagLogis,
                        dateMoney: getMoney,
                        comment: Comment},
                cache: 0,
                async: 1,

                success: function(resp){
                    var obj = $.parseJSON(resp);

                    $('#detailWS').modal('hide');
                    let timerInterval
                    Swal.fire({
                        title: 'แก้ไขสำเร็จ',
                        icon: 'success',
                        timer: 1500,
                        timerProgressBar: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)

                            location.reload();
                        }
                    })
                }
            });
        }

        function get_data(){
            var worksheetRD = $('#worksheetRD').val();
            if(worksheetRD == 'ไม่มีข้อมูล'){
                $('#worksheetRD').val('<?php echo date("Y-m-d H:i:s");?>');
            }
        }

        function getTagLogis(){
            var worksheetED = $('#worksheetED').val();
            if(worksheetED == 'ไม่มีข้อมูล'){
                $('#worksheetED').val('<?php echo date("Y-m-d H:i:s");?>');
            }
        }
    </script>

<body>
</html>


<?php date_default_timezone_set("Asia/Bangkok"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>W O R K S H E E T | W E B &nbsp; M A N A G E</title>
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
                    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
                    "order": [[ 2, "desc" ]],
                    "ajax": '<?php echo base_url('dashboard/showAllWorksheet');?>'
                });
                var successWorksheet = $('#successWorksheet').DataTable({
                    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
                    "order": [[ 4, "desc" ]],
                    "ajax": '<?php echo base_url('dashboard/showSuccessWorksheet');?>'
                });
                var nomoneyWorksheet = $('#nomoneyWorksheet').DataTable({
                    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
                    "order": [[ 2, "desc" ]],
                    "ajax": '<?php echo base_url('dashboard/showNomoneyWorksheet');?>'
                });
                
                // setInterval( function () {
                //     tableWorksheet.ajax.reload();
                //     successWorksheet.ajax.reload();
                // }, 3000 );
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
                                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>ใบงาน
                                    <div class="page-title-subheading">
                                        จัดการใบงาน, ใบงานค้าง
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>           
                    
                        <div class="col-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">กำลังดำเนินการ</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">จัดส่งแล้ว</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="nomoney-tab" data-bs-toggle="tab" data-bs-target="#nomoney" type="button" role="tab" aria-controls="nomoney" aria-selected="false">จัดส่งแล้ว(ยังไม่สำเร็จ)</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="main-card mb-3 card">
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

                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="main-card mb-3 card">
                                                <div class="table-responsive p-3">
                                                    <table id="successWorksheet" width="100%" style="font-size: .8rem"
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

                                </div>

                                <div class="tab-pane fade" id="nomoney" role="tabpanel" aria-labelledby="nomoney-tab">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="main-card mb-3 card">
                                                <div class="table-responsive p-3">
                                                    <table id="nomoneyWorksheet" width="100%" style="font-size: .8rem"
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
                    if($staff_level == 'admin'|| $staff_level == 'manager') {
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

                    <div class="col-6 pr-2 pl-2">
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
                <!-- <button type="button" class="btn btn-primary" onclick="confirmWsBtn()">บันทึก</button> -->
                <div id="showBtnConfirm"></div>
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

                    if(obj[0].worksheet_flag == '0' || obj[0].worksheet_credit == '' 
                        || obj[0].worksheet_get_money == '0000-00-00 00:00:00'
                        || obj[0].worksheet_get_money == null ){
                        showBtnConfirm = `<button type="button" class="btn btn-primary" onclick="confirmWsBtn()">บันทึก</button>`;
                    }else{
                        showBtnConfirm = ``;
                    }
                    $('#showBtnConfirm').html(showBtnConfirm);

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
                    let timerInterval
                    var obj = $.parseJSON(resp);

                    $('#detailWS').modal('hide');
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

        function addPoint(wsID){
            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>worksheet/addPointUser',
                data: {wsID: wsID},
                cache: 0,
                async: 1,

                success: function(resp){
                    let timerInterval
                    var obj = $.parseJSON(resp);

                    Swal.fire({
                        title: 'เพิ่มคะแนนสำเร็จ',
                        icon: 'success',
                        timer: 800,
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
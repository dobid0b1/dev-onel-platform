<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>C U S T O M E R | W E B &nbsp; M A N A G E</title>
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
                var tableCust = $('#tableCust').DataTable({
                    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
                    "order": [[ 0, "desc" ]],
                    "ajax": '<?php echo base_url('customer/allCustomers');?>',
                    "columnDefs": [
                        { "width": "10%", "targets": 0 },
                        { "width": "25%", "targets": 1 },
                        { "width": "30%", "targets": 2 },
                        { "width": "10%", "targets": 3 },
                        { "width": "25%", "targets": 4 }
                    ]
                });
                // setInterval( function () {
                //     tableCust.ajax.reload();
                // }, 2000 );
            } );
            
            function infoCust(custID){
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url();?>Customer/infoCust",
                    data: {custID: custID},
                    cache: 0,
                    async: 1,

                    success: function(resp){
                        var obj = $.parseJSON(resp);
                        var len = obj.length;

                        $('#userID').val(obj[0].user_id);
                        $('#userName').val(obj[0].user_name);
                        $('#userPhone').val(obj[0].user_phone);
                        $('#userAddress').val(obj[0].user_address);
                        $('#userDistrict').val(obj[0].user_district);
                        $('#userAmphoe').val(obj[0].user_amphoe);
                        $('#userProvince').val(obj[0].user_province);
                        $('#userZipcode').val(obj[0].user_zipcode);
                        
                        $('#infoCust').modal('show');
                    }
                });
            }

            function hisCust(custID){
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url();?>Customer/hisCust",
                    data: {custID: custID},
                    cache: 0,
                    async: 1,

                    success: function(resp){
                        var obj = $.parseJSON(resp);
                        var len = obj.length;
                        let dataHis = ``;
                        if(len > 0){
                            for(x=0;x<len;x++){
                                if(obj[x].worksheet_status == 'ส่งคืนแล้ว'){
                                    dataHis += `<tr class="text-success" style="cursor: pointer;" onclick="detailHisData('${obj[x].worksheet_id}')">`;
                                }else{
                                    dataHis += `<tr style="cursor: pointer;" onclick="detailHisData('${obj[x].worksheet_id}')">`;
                                }
                                dataHis += `<td class="text-center">${obj[x].worksheet_id}</td>`;

                                if(obj[x].worksheet_type == 'bag'){
                                    dataHis += `<td class="text-center"><i class="fas fa-shopping-bag"></i> กระเป๋า</td>`;
                                }
                                if(obj[x].worksheet_type == 'shoe'){
                                    dataHis += `<td class="text-center"><i class="fas fa-shoe-prints"></i> รองเท้า</td>`;
                                }
                                if(obj[x].worksheet_type == 'other'){
                                    dataHis += `<td class="text-center"><i class="fas fa-tag"></i> อื่นๆ</td>`;
                                }
                                


                                dataHis += `<td class="text-center">${obj[x].worksheet_brand}</td>`;

                                if(obj[x].worksheet_status == 'ส่งคืนแล้ว'){
                                    dataHis += `<td class="text-center">${obj[x].worksheet_status}`;
                                    dataHis += `&nbsp;<i class="fas fa-check-circle"></i></td>`;
                                }
                                if(obj[x].worksheet_status == 'ร้านรับแล้ว'){
                                    dataHis += `<td class="text-center">${obj[x].worksheet_status}`;
                                    dataHis += `&nbsp;<i class="fas fa-tools text-primary"></i></td>`;
                                }
                                if(obj[x].worksheet_status == 'รอส่งร้าน'){
                                    dataHis += `<td class="text-center">${obj[x].worksheet_status}`;
                                    dataHis += `&nbsp;<i class="fas fa-clock text-warning"></i></td>`;
                                }

                                dataHis += `<td class="text-center">${obj[x].worksheet_comment}</td>`;
                                dataHis += `<td class="text-center">`;
                                if(obj[x].worksheet_status == 'ส่งคืนแล้ว'){
                                    if(obj[x].worksheet_end_date){
                                        dataHis += obj[x].worksheet_end_date;
                                    }
                                }else{
                                    dataHis += `<i class='text-warning'>อยู่่ระหว่างดำเนินการ</i>`;
                                }
                                dataHis += `</td>`;
                                dataHis += `</tr>`;
                            }
                        }else{
                            dataHis += `<tr><td colspan="6" class="text-center"><i>ไม่มีข้อมูล</i></td></tr>`;
                        }
                        

                        $('#qq').html(dataHis);
                    }
                });

                $('#hisCust').modal('show');
            }

            function detailHisData(wsID){
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url();?>Customer/detailWS",
                    data: {wsID: wsID},
                    cache: 0,
                    async: 1,

                    success: function(resp){
                        var obj = $.parseJSON(resp);
                        var len = obj.length;

                        console.log(obj);

                        let track = '';
                        let comment = '';
                        let imgOne = '';
                        let imgTwo = '';
                        let wsCD = '';
                        let wsRD = '';
                        let wsED = '';
                        if(obj[0].worksheet_track){
                            track = obj[0].worksheet_track;
                        }else{
                            track = '-';
                        }
                        if(obj[0].worksheet_comment){
                            comment = obj[0].worksheet_comment;
                        }else{
                            comment = 'ไม่ระบุ';
                        }

                        if(obj[0].worksheet_img_path_one){
                            imgOne = `<img src="<?php echo base_url();?>${obj[0].worksheet_img_path_one}" alt="" width="100%">`;
                        }
                        if(obj[0].worksheet_img_path_two){
                            imgTwo = `<img src="<?php echo base_url();?>${obj[0].worksheet_img_path_two}" alt="" width="100%">`;
                        }

                        $('#wsStatus').html(obj[0].worksheet_status);
                        $('#wsID').val(obj[0].worksheet_id);
                        $('#wsBrand').val(obj[0].worksheet_brand);
                        $('#wsSubbrand').val(obj[0].worksheet_subbrand);
                        $('#wsComment').val(comment);
                        $('#wsTrack').html(track);
                        $('#wsImgOne').html(imgOne);
                        $('#wsImgTwo').html(imgTwo);

                        if(obj[0].worksheet_create_date){
                            wsCD = obj[0].worksheet_create_date;
                        }else wsCD = 'ไม่มีข้อมูล';

                        if(obj[0].worksheet_receive_date){
                            wsRD = obj[0].worksheet_receive_date;
                        }else wsRD = 'ไม่มีข้อมูล';

                        if(obj[0].worksheet_end_date){
                            wsED = obj[0].worksheet_end_date;
                        }else wsED = 'ไม่มีข้อมูล';

                        $('#wsCreateDate').val(wsCD);
                        $('#wsRecieveDate').val(wsRD);
                        $('#wsEndDate').val(wsED);
                    }
                });

                $('#detailHisData').modal('show');
            }

            function confirmBtn(){
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>customer/updateDataCust',
                    data: {custID: $('#userID').val(),
                            custName: $('#userName').val(),
                            custPhone: $('#userPhone').val(),
                            custAddress: $('#userAddress').val(),
                            custDistrict: $('#userDistrict').val(),
                            custAmphoe: $('#userAmphoe').val(),
                            custProvince: $('#userProvince').val(),
                            custZipcode: $('#userZipcode').val()},
                    cache: 0,
                    async: 1,

                    success: function(resp){
                        let timerInterval
                        $('#infoCust').modal('hide');

                        Swal.fire({
                            title: 'แก้ไขข้อมูลสำเร็จ',
                            timer: 1500,
                            timerProgressBar: true,
                            showCancelButton: false,
                            showConfirmButton: false,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        location.reload();
                    }
                });
            }

            function addCust(){
                $('#addCust').modal('show');
            }
        </script>
    <!-- ------------------------------------------ -->
</head>

<body>
    <?php
        $haveCust = $this->session->flashdata('haveCust');
        $hcTxt = $this->session->flashdata('hcTxt');

        if($haveCust){
    ?>
        <script>
            Swal.fire({
                title: 'มีข้อมูลสมาชิกในระบบอยู่แล้ว',
                icon: 'warning',
                timer: 1500,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false,
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })
        </script>
    <?php
        }
    ?>
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
                                <div>การจัดการลูกค้า
                                    <div class="page-title-subheading">
                                        ข้อมูลลูกค้า, แก้ไขข้อมูล
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>  

                    <div class="row m-0">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="col-6">ข้อมูลลูกค้า</div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-success" onclick="addCust()">+ เพิ่มลูกค้า</button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive p-3">
                                    <table id="tableCust" width="100%" style="font-size: .8rem;"
                                    class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">รายชื่อลูกค้า</th>
                                                <th class="text-center">ที่อยู่ส่งกลับ</th>
                                                <th class="text-center">คะแนน</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('menu/footer.php'); ?>
            </div>

        </div>
    </div>

    <div class="modal fade" id="infoCust" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ข้อมูลลูกค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="userID" id="userID">
                <div class="row p-2">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="userName" class="form-control" id="userName" placeholder="..">
                            <label for="floatingInput">ชื่อ</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="userPhone" class="form-control" id="userPhone" placeholder=".." maxlength='10'>
                            <label for="floatingInput">เบอร์โทรศัพท์</label>
                        </div>
                    </div><hr>

                    <div class="title-header mb-2">ที่อยู่ในการจัดส่ง</div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" name="userAddress" class="form-control" id="userAddress" placeholder="..">
                            <label for="floatingInput">บ้านเลขที่</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="userDistrict" class="form-control" id="userDistrict" placeholder="..">
                            <label for="floatingInput">แขวง/ตำบล</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="userAmphoe" class="form-control" id="userAmphoe" placeholder="..">
                            <label for="floatingInput">เขต/อำเภอ</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="userProvince" class="form-control" id="userProvince" placeholder="..">
                            <label for="floatingInput">จังหวัด</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="userZipcode" class="form-control" id="userZipcode" placeholder="..">
                            <label for="floatingInput">รหัสไปรษณีย์</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="confirmBtn()">ยืนยันการแก้ไข</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hisCust" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ประวัติการใช้งาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                    <div class="col-12" style="height: 15rem;overflow: auto">
                        
                        <table id="tableHistory" class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#wsID</th>
                                    <th class="text-center">ประเภท</th>
                                    <th class="text-center">สินค้า</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center">อาการ/สิ่งที่ต้องทำ</th>
                                    <th class="text-center">วันที่ส่งกลับ</th>
                                </tr>
                            </thead>
                            <tbody id="qq"></tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailHisData" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ข้อมูลใบงาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                    <div class="col-12 text-center mb-2 text-secondary p-3 text-white">
                        <h4 class="title-header" id="wsStatus"></h4>
                        <div style="font-size: .8rem">
                            <span class="text-danger">ขั้นตอน: </span>
                            <span class="text-secondary" id="wsTrack"></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="wsID" placeholder=".." disabled>
                            <label for="floatingInput">wsID</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="wsBrand" placeholder=".." disabled>
                            <label for="floatingInput">แบรนด์สินค้า</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="wsSubbrand" placeholder=".." disabled>
                            <label for="floatingInput">รุ่น</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="wsComment" placeholder=".." disabled>
                            <label for="floatingInput">อาการ/สิ่งที่ต้องทำ</label>
                        </div>
                        <hr>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="wsCreateDate" placeholder=".." disabled>
                            <label for="floatingInput">วันที่ลงทะเบียน</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="wsRecieveDate" placeholder=".." disabled>
                            <label for="floatingInput">วันที่ร้านรับสินค้า</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="wsEndDate" placeholder=".." disabled>
                            <label for="floatingInput">วันที่ส่งกลับ</label>
                        </div>
                        <hr>
                    </div>
                    
                    <h4 class="title-header">รูปสินค้า</h4>
                    <div class="col-6 text-center">
                        <div id='wsImgOne'></div>
                    </div>
                    <div class="col-6 text-center">
                        <div id='wsImgTwo'></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCust" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มลูกค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post" class="g-3 needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="addName" placeholder=".." required>
                                    <label for="floatingInput">ชื่อ:</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="addPhone" 
                                    maxlength='10' onkeypress="return onlyNumberKey(event)" placeholder=".." required>
                                    <label for="floatingInput">เบอร์โทรศัพท์:</label>
                                </div>
                            </div>
                        </div><hr>

                        <div class="title-header mb-3">ข้อมูลติดต่อกลับ</div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="addAddress" placeholder=".." required>
                                    <label for="floatingInput">บ้านเลขที่:</label>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="Floating label select example"
                                    id="showProvince" onchange="selectProvince(this)" name="addProvince" required>
                                        <option value="">เลือกจังหวัด</option>
                                        <?php 
                                            if($provinceData) {
                                                foreach($provinceData as $pD) {   
                                                ?>
                                                    <option value="<?php echo $pD['province']; ?>"><?php echo $pD['province']; ?></option>
                                                <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <label for="floatingSelect">จังหวัด:</label>
                                </div>
                            </div>
                            <div class="col-6 mb-3" id="showAmphoe"></div>
                            <div class="col-6" id="showDistrict"></div>
                            <div class="col-6" id="showZipcode"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="confirmBtn" class="btn btn-primary" value="เพิ่มลูกค้า">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function onlyNumberKey(evt) {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
                return false; 
            return true; 
        } 
        
        function selectProvince(nameProvince){
            var nameProvince = nameProvince.value;
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>customer/selectAmphoe",
                data: {province: nameProvince},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;
                    let dataAmphoe = ``;
                    dataAmphoe += `
                        <div class="form-floating">
                        <select class="form-select" aria-label="Floating label select example"
                        id="showAmphoe" onchange="selectAmphoe(this,'${nameProvince}')" name="addAmphoe" required>
                        <option value="">เลือกอำเภอ/เขต</option>`;
                        if(len > 0) {
                            for(x=0;x<len;x++){
                                dataAmphoe += `<option value="${obj[x].amphoe}">${obj[x].amphoe}</option>`;
                            }
                        }     
                    dataAmphoe += `</select><label for="floatingSelect">อำเภอ/เขต:</label></div>`;
                    $('#showAmphoe').html(dataAmphoe);
                }
            });
        }

        function selectAmphoe(nameAmphoe, nameProvince){
            var nameAmphoe = nameAmphoe.value;
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>customer/selectDistrict",
                data: {amphoe: nameAmphoe},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;
                    let dataDistrict = ``;
                    dataDistrict += `
                        <div class="form-floating">
                        <select class="form-select" aria-label="Floating label select example"
                        id="showDistrict" onchange="selectZipcode(this,'${nameAmphoe}','${nameProvince}')" name="addDistrict" required>
                        <option value="">เลือกตำบล/แขวง</option>`;
                        if(len > 0) {
                            for(x=0;x<len;x++){
                                dataDistrict += `<option value="${obj[x].district}">${obj[x].district}</option>`;
                            }
                        }     
                    dataDistrict += `</select><label for="floatingSelect">ตำบล/แขวง:</label></div>`;
                    $('#showDistrict').html(dataDistrict);
                }
            });
        }

        function selectZipcode(nameDistrict, nameAmphoe, nameProvince){
            var nameDistrict = nameDistrict.value;
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>customer/selectZipcode",
                data: {district: nameDistrict,
                        province: nameProvince,
                        amphoe: nameAmphoe
                        },   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;
                    let dataZipcode = ``;
                    if(len > 0) {
                        dataZipcode += `<div class="form-floating mb-3">`;
                        dataZipcode += `<input type="email" class="form-control" name="addZipcode" value="${obj[0].zipcode}" maxlength="5" readonly>`;
                        dataZipcode += `<label>รหัสไปรษณีย์:</label></div>`;
                    } 
                    $('#showZipcode').html(dataZipcode);
                }
            });
        }

        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
<body>
</html>


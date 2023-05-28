<?php
    date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดตามงาน</title>
    <link rel="icon" href="<?php echo base_url();?>liff/images/logo.png">
    
    <link href="<?php echo base_url();?>liff/css/styleAll.css" rel="stylesheet">
    <link href="<?php echo base_url();?>liff/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url();?>liff/css/timeline.css" rel="stylesheet">

    <!-- ========= CSS ========= -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="<?php echo base_url(); ?>liff/css/styleAll.css" rel="stylesheet">

    <!-- ========= JS =========-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.12/dist/sweetalert2.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.12/dist/sweetalert2.all.min.js"></script>
    <!-- ====================== -->

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header text-center"><br>
        <a href="tracking">
            <button class='btn btn-info'>refresh</button> 
        </a><br>

        <div id='sumHistory'></div><br>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-12">
                        <div class="timeline timeline-line-solid">
                            <div id="dataTrack"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="box2"></div>
    </div>

    <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
        function runApp() {
            liff.getProfile().then(profile => {
                checkUser(profile.userId);
            }).catch(err => console.error(err));
        }

        liff.init({ liffId: "1656273522-YzwpxZoM" }, () => {
        if (liff.isLoggedIn()) {
            runApp()
        } else {
            liff.login();
        }
        }, err => console.error(err.code, error.message));

        function checkUser(lineID){
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>liff/member/checkDataMember",
                data: {lineID: lineID},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;

                    if(len > 0){
                        allTracking(lineID);
                    }
                    else{
                        let box2 = ``;
                        box2 += `<h5>กรุณาลงทะเบียนสมาชิกก่อนใช้บริการค่ะ</h5><br>
                                <a href="<?php echo base_url();?>liff/member">
                                    <button class="btn btn-primary">ลงทะเบียนสมาชิก</button>
                                </a>`; 
                        $('#box2').html(box2);
                    }
                }
            });
        }

        function allTracking(lineID){
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>liff/tracking/allTracking",
                data: {lineID: lineID},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;

                    let sumHis = ``;
                    if (len > 0) {
                        sumHis += `<h6 class='card-title'>ทั้งหมด ${len} รายการ</h6>`;
                    }else{
                        sumHis += `<center>ทั้งหมด 0 รายการ</center><br>`;
                        sumHis += `<h3 class='card-title'>ไม่มีข้อมูล</h3>`;
                        sumHis += `<div class='text-danger'><i>**ไม่มีสินค้าที่ค้างในระบบ <br>หรือท่านยังไม่เคยรับบริการจากทางร้าน</i></div>`;
                    }
                    $('#sumHistory').html(sumHis);

                    if(len > 0){
                        let dataTrack = ``;
                        dataTrack += `<span class="timeline-label">`;
                        dataTrack += `<span class="label">Tracking</span>`;
                        dataTrack += `</span>`;
                        for(x=0;x<len;x++){
                            dataTrack += `<div class="timeline-item">`;
                            dataTrack += `<div class="timeline-point timeline-point"></div>`;
                            dataTrack += `<div class="timeline-event">`;
                            dataTrack += `<div class="widget has-shadow">`;
                                dataTrack += `<div class="widget-header d-flex align-items-center" onclick='datailModal("${obj[x].worksheet_id}")'`;
                                dataTrack += `style="box-shadow: 0px 0px 5px lightgray;">`;
                                    dataTrack += `<div class="user-image">`;
                                        if(obj[x].worksheet_type == 'bag'){
                                            dataTrack += `<img class="rounded-circle" src="<?php echo base_url();?>liff/images/bag.png" alt="bag">`;
                                        }
                                        if(obj[x].worksheet_type == 'shoe'){
                                            dataTrack += `<img class="rounded-circle" src="<?php echo base_url();?>liff/images/shoe.png" alt="bag">`;
                                        }
                                    dataTrack += `</div>`;
                                    dataTrack += `<div class="d-flex flex-column mr-auto">`;
                                        dataTrack += `<div class="title">`;
                                        dataTrack += `<span class="username">${obj[x].worksheet_brand}</span><br>`;
                                        dataTrack += `<i style="float:left;font-size: .9rem">${(obj[x].worksheet_subbrand)?obj[x].worksheet_subbrand:'-'}</i>`;
                                        dataTrack += `</div>`;
                                    dataTrack += `</div>`;
                                dataTrack += `</div>`;
                            dataTrack += `<div class="widget-body" onclick='datailModal("${obj[x].worksheet_id}")'>`;

                                dataTrack += `<img class="imgBG" src='<?php echo base_url();?>${obj[x].worksheet_img_path_one}' width='100%'>`;

                                dataTrack += `<div style="font-size: .8rem" class='mb-0 text-danger'>ขั้นตอน</div>`;

                                if(obj[x].worksheet_status == 'ร้านรับแล้ว'){
                                    if(obj[x].worksheet_track){
                                        dataTrack += `<div style="font-size: 1.2rem" class='mb-2'>${obj[x].worksheet_track}</div>`;
                                    }
                                    else{
                                        dataTrack += `<div style="font-size: 1.2rem" class='mb-2'>รับสินค้าแล้ว</div>`;
                                    }
                                }
                                if(obj[x].worksheet_status == 'รอส่งร้าน'){
                                    dataTrack += `<div style="font-size: 1.2rem;" >ยังไม่ถึงร้าน</div>`;
                                    dataTrack += `<div class="text-danger" style="font-size: .5rem;">* อาจอยู่ระหว่างจัดส่ง</div>`;
                                }
                                if(obj[x].worksheet_status == 'ส่งคืนแล้ว'){
                                    dataTrack += `<div style="font-size: 1.2rem;" >ส่งคืนแล้ว</div>`;
                                }
                            
                            dataTrack += `<div style="font-size: .8rem;" >ถึงร้านเมื่อ : ${(obj[x].worksheet_receive_date)?obj[x].worksheet_receive_date:'<i>ไม่มีข้อมูล</i>'}</div>`;
                            dataTrack += `<div class="text-center text-secondary" style="bottom: 0;position: relative;font-size: .7rem">คลิกเพื่อดูรายละเอียด</div>`;

                            dataTrack += `</div>`;
                            dataTrack += `</div>`;
                                if(obj[x].worksheet_receive_date){
                                    var onlyDate = `${obj[x].worksheet_receive_date}`;
                                    var onlyDate = onlyDate.split(" ");

                                    var date1 = new Date(onlyDate[0]);
                                    var date2 = new Date('<?php echo date("Y-m-d");?>');
                                    var diffTime = Math.abs(date2 - date1);
                                    var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

                                    if(diffDays <= 1){
                                        dataTrack += `<div class="time-left">น้อยกว่า 1 วัน</div>`;
                                    }
                                    else if(diffDays >= 7 && diffDays < 14){
                                        dataTrack += `<div class="time-left"><span class="text-warning"><b>`+diffDays+`</b></span> วันในระบบ</div>`;
                                    }
                                    else if(diffDays >= 14){
                                        dataTrack += `<div class="time-left"><span class="text-danger"><b>`+diffDays+`</b></span> วันในระบบ</div>`;
                                    }
                                    else{
                                        dataTrack += `<div class="time-left">`+diffDays+` วันในระบบ</div>`;
                                    }
                                }else{
                                    dataTrack += `<div class="time-left">-</div>`;
                                }
                            dataTrack += `</div>`;
                            dataTrack += `</div>`;
                        }
                        $('#dataTrack').html(dataTrack);
                    }

                }
            });
        }

        function datailModal(wsID){
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>liff/history/getDataWorksheet",
                data: {wsID: wsID},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;

                    if (len > 0) {
                        let dataWS = '';
                        // dataWS += `<table class="align-middle mb-0 table table-borderless table-striped table-hover" style="font-size: .9rem">`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">ประเภท:</th>`;
                        // dataWS += `<td>${obj[0].worksheet_type}</td>`;
                        // dataWS += `</tr>`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">ยี่ห้อ:</th>`;
                        // dataWS += `<td>${obj[0].worksheet_brand}</td>`;
                        // dataWS += `</tr>`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">รุ่น:</th>`;
                        // dataWS += `<td>${(obj[0].worksheet_subbrand)?obj[0].worksheet_subbrand:'<i>-</i>'}</td>`;
                        // dataWS += `</tr>`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">รายละเอียด:</th>`;
                        // dataWS += `<td><textarea width="50%" rows="3">${(obj[0].worksheet_comment)?obj[0].worksheet_comment:'<i>ไม่มีข้อมูล</i>'}</textarea></td>`;
                        // dataWS += `</tr>`;

                        // dataWS += `<tr><td colspan="2"></td></tr>`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">วันที่ลงทะเบียน:</th>`;
                        // dataWS += `<td>${(obj[0].worksheet_create_date)?obj[0].worksheet_create_date:'<i>ไม่มีข้อมูล</i>'}</td>`;
                        // dataWS += `</tr>`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">วันที่ร้านรับสินค้า:</th>`;
                        // dataWS += `<td>${(obj[0].worksheet_receive_date)?obj[0].worksheet_receive_date:'<i>ไม่มีข้อมูล</i>'}</td>`;
                        // dataWS += `</tr>`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">วันที่ส่งกลับ:</th>`;
                        // dataWS += `<td>${(obj[0].worksheet_end_date)?obj[0].worksheet_end_date:'<i>ไม่มีข้อมูล</i>'}</td>`;
                        // dataWS += `</tr>`;

                        // dataWS += `<tr><td colspan="2"></td></tr>`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">ขั้นตอน:</th>`;
                        //     if(obj[0].worksheet_status == 'ร้านรับแล้ว'){
                        //         dataWS += `<td>${(obj[0].worksheet_track)?obj[0].worksheet_track:'<i>ร้านค้ารับสินค้าแล้ว</i>'}</td>`;
                        //     }
                        //     if(obj[0].worksheet_status == 'รอส่งร้าน'){
                        //         dataWS += `<td><i>ยังไม่ถึงร้าน</i>`;
                        //         dataWS += `<div class="text-danger" style="font-size: .8rem;">* อาจอยู่ระหว่างจัดส่ง</div></td>`;
                        //     }
                        //     if(obj[0].worksheet_status == 'ส่งคืนแล้ว'){
                        //         // dataHis += `<div style="font-size: 1.2rem;" >ส่งสินค้าคืนแล้ว</div>`;
                        //         dataWS += `<td><i>ส่งสินค้าคืนแล้ว</i>`;
                        //     }
                        // dataWS += `</tr>`;

                        // dataWS += `<tr><td colspan="2"></td></tr>`;

                        // dataWS += `<tr>`;
                        // dataWS += `<th class="text-right">รูป 1:</th>`;
                        // dataWS += `<td>`;
                        //     if(obj[0].worksheet_img_path_one){
                        //         // dataWS += `<a href="https://onelth.com/platform/yesiam/${obj[0].worksheet_img_path_one}">`;
                        //         dataWS += `<button class="btn btn-info" onclick="showImg('${obj[0].worksheet_img_path_one}')">`;
                        //         dataWS += `คลิกเพื่อดูรูป`;
                        //         // dataWS += `</a>`;
                        //         dataWS += `</botton>`;
                        //     }else{
                        //         dataWS += `<i>ไม่มีข้อมูล</i>`;
                        //     }
                        // dataWS += `</td>`;
                        // dataWS += `</tr>`;

                        // if(obj[0].worksheet_img_path_two){
                        //     dataWS += `<tr>`;
                        //     dataWS += `<th class="text-right">รูป 2:</th>`;
                        //     dataWS += `<td>`;
                        //     // dataWS += `<a href="https://onelth.com/platform/yesiam/${obj[0].worksheet_img_path_two}">`;
                        //     dataWS += `<button class="btn btn-info" onclick="showImg('${obj[0].worksheet_img_path_two}')">`;
                        //     dataWS += `คลิกเพื่อดูรูป`;
                        //     // dataWS += `</a>`;
                        //     dataWS += `</botton>`;
                        //     dataWS += `</td>`;
                        //     dataWS += `</tr>`;
                        // }

                        // dataWS += `</table>`;

                        dataWS += `
                            <div class="col-12 mb-3 bg-info text-center">
                                ขั้นตอน: ${obj[0].worksheet_track}
                            </div>
                            <div class="row">
                                <div class="col-3 text-center">`;
                                if(obj[0].worksheet_type == 'bag'){
                                    dataWS += `<img src="<?php echo base_url(); ?>images/bag.png" width="100%"><br>กระเป๋า`;
                                }else if(obj[0].worksheet_type == 'shoe'){
                                    dataWS += `<img src="<?php echo base_url(); ?>images/shoe.png" width="100%"><br>รองเท้า`;
                                }else{
                                    dataWS += `<img src="<?php echo base_url(); ?>images/other.png" width="100%"><br>อื่นๆ`;
                                }
                            dataWS += `</div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" value="${obj[0].worksheet_brand}" readonly>
                                                <label>ยี่ห้อสินค้า:</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" value="${obj[0].worksheet_subbrand}" readonly>
                                                <label>รุ่น:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="." readonly>${obj[0].worksheet_comment}</textarea>
                                        <label for="floatingTextarea">อาการ/สิ่งที่ต้องทำ:</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                    <center><img src="<?php echo base_url(); ?>${obj[0].worksheet_img_path_one}" 
                                    width="80%" height="100px" onclick="showImg('${obj[0].worksheet_img_path_one}')"></center>
                                    </div>
                                    <div class="col-6">
                                    <center><img src="<?php echo base_url(); ?>${obj[0].worksheet_img_path_two}" 
                                    width="80%" height="100px" onclick="showImg('${obj[0].worksheet_img_path_two}')"></center>
                                    </div>
                                </div>


                                <div class="col-12 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" 
                                        value="${obj[0].worksheet_receive_date}" readonly>
                                        <label>วันที่รับสินค้า:</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" 
                                        value="${(obj[0].worksheet_end_date)?obj[0].worksheet_end_date:'ไม่มีข้อมูล'}" readonly>
                                        <label>วันที่ส่งกลับ:</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" 
                                        value="${(obj[0].worksheet_provider_logis)?obj[0].worksheet_provider_logis:'ไม่มีข้อมูล'}" readonly>
                                        <label>บริการขนส่ง:</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" 
                                        value="${(obj[0].worksheet_tag_logis)?obj[0].worksheet_tag_logis:'ไม่มีข้อมูล'}" readonly>
                                        <label>เลขพัสดุ:</label>
                                    </div>
                                </div>
                            </div>
                            `;
                        $('#wsID').html(dataWS);
                    }
                }
            });

            $('#detailWorksheet').modal('show');
        }
        function showImg(img){
            let imgPath = ``;
            imgPath += `<img src="<?php echo base_url();?>${img}" width='100%'>`;
            $('#ssIMG').html(imgPath);

            $('#showImg').modal('show');
        }
    </script>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" 
    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detailWorksheet">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="row">
                    <div class="col-12 p-3">
                        <div id='wsID'></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" 
    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showImg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="row m-0 mt-3 text-center">
                    <div class="col-12 mb-2 p-3">
                        <div id='ssIMG'></div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
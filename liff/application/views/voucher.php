<?php
    date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แลกคะแนน</title>
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
        <a href="voucher">
            <button class='btn btn-info'>refresh</button> 
        </a><br>

        <div id="box2"></div>

        <div class="row m-0 mt-3 text-center" id="bShow">
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body">

                        <div id="txtV" style="font-size: 80%;"></div>

                        <h6 class="card-title text-center mb-3">คะแนนทั้งหมด</h6>
                        <h2 id="allPoint"></h2><hr>

                        <input type="hidden" id="userID">
                        
                        <?php
                            foreach($allVoucher as $aV){
                                $vID = $aV['voucher_id'];
                        ?>
                            <form id="fV">
                                <div class="row p-2">
                                    <div class="col-12 rounded border border-primary p-2">
                                        <div class="row">
                                            <div class="col-8 text-left">
                                                รับส่วนลด <?php echo number_format($aV['voucher_discount'],0); ?> บาท<br>
                                                <span style="font-size: 80%;"><?php echo number_format($aV['voucher_user_point'],0); ?> คะแนน</span>
                                                
                                            </div>
                                            <div class="col-4">
                                                <button type="button" class="btn btn-primary">
                                                    <span style="font-size: 80%;" onclick="btnV(<?php echo $vID; ?>)">แลกคะแนน</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
        function runApp() {
            liff.getProfile().then(profile => {
                checkUser(profile.userId);
            }).catch(err => console.error(err));
        }

        liff.init({ liffId: "1656273522-2YjX7vRa" }, () => {
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
                        $('#allPoint').html(obj[0].user_point);
                        $('#userID').val(obj[0].user_id);

                        if(obj[0].user_voucher_flag == '1'){
                            let txtVoucher = ``;
                            txtVoucher += `<div class="row mb-3">
                            <div class="col-12 p-2 bg-secondary text-white rounded">
                                คุณมีส่วนลดที่ยังไม่ได้ใช้<br>
                                <span style="font-size: 90%;">โปรดติดต่อร้านค้า</span>
                            </div></div>
                            `;
                            $('#txtV').html(txtVoucher);
                        }
                    }
                    else{
                        $('#bShow').hide();
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

        function btnV(vID){
            var userID = $('#userID').val();

            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>liff/voucher/detailMember",
                data: {userID: userID},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var uPoint = parseFloat(obj[0].user_point);
                    var vFlag = obj[0].user_voucher_flag;

                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url();?>liff/voucher/detailVoucher",
                        data: {vID: vID},   
                        cache: false,
                        async: 1,
                        
                        success: function(result){ 
                            var obj = $.parseJSON(result);
                            var usePoint = parseFloat(obj[0].voucher_user_point);

                            if(uPoint >= usePoint){
                                if(vFlag == '0'){
                                    Swal.fire({
                                        title: 'ต้องการแลกส่วนลด ?',
                                        text: ". . .",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'ยืนยัน',
                                        cancelButtonText: 'ยกเลิก'
                                        }).then((result) => {
                                        if (result.isConfirmed) {

                                            $.ajax({
                                                type: "post",
                                                url: "<?php echo base_url();?>liff/voucher/confirmVoucher",
                                                data: {vID: vID, userID: userID, usePoint: usePoint, uPoint: uPoint},   
                                                cache: false,
                                                async: 1,
                                                
                                                success: function(result){ 
                                                    Swal.fire(
                                                        'สำเร็จ',
                                                        'สามารถแจ้งทางร้านว่าต้องการใช้ส่วนลดได้เลยค่ะ',
                                                        'success'
                                                    ).then((result) => {
                                                    if (result.isConfirmed) {
                                                        location.reload();
                                                    }
                                                    })
                                                }
                                            });
                                            
                                        }
                                    })
                                }
                                else{
                                    
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สามารถแลกได้',
                                    text: 'โปรดใช้ส่วนลดที่มีก่อนค่ะ กรุณาแจ้งร้านค้า'
                                })
                                }
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สามารถแลกได้',
                                    text: 'คะแนนไม่พอต่อการแลกส่วนลด'
                                })
                            }
                            
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>
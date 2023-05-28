<?php 
if(isset($_GET['lineID'])) {
    if($_GET['lineID']) {
        $line_id = $_GET['lineID'];
    } 
    else {
        // redirect('https://onelth.com/platform/yesiam/service');
        header("location: https://access.line.me/oauth2/v2.1/authorize?app_id=1656240710-mdXq0rXl&client_id=1656240710&scope=chat_message.write+openid+profile&state=mjV2YY5jYOTQ&response_type=code&code_challenge_method=S256&code_challenge=Iyvb9A0hmAjbNWa7sc7kFAJcklkeI5IZiN6E8NB6Oos&liff_sdk_version=2.9.0&type=L&redirect_uri=https%3A%2F%2Fonelth.com%2Fplatform%2Fyesiam%2Fservice&bot_prompt=normal");
    }
}
else {
    header("location: https://access.line.me/oauth2/v2.1/authorize?app_id=1656240710-mdXq0rXl&client_id=1656240710&scope=chat_message.write+openid+profile&state=mjV2YY5jYOTQ&response_type=code&code_challenge_method=S256&code_challenge=Iyvb9A0hmAjbNWa7sc7kFAJcklkeI5IZiN6E8NB6Oos&liff_sdk_version=2.9.0&type=L&redirect_uri=https%3A%2F%2Fonelth.com%2Fplatform%2Fyesiam%2Fservice&bot_prompt=normal");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="<?php echo base_url(); ?>images/YesIAm_logo.png">
    <title>Spa & Cleaning | Yes I Am</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="css/styleAll.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.12/dist/sweetalert2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.12/dist/sweetalert2.all.min.js"></script>

    <style>
    section {
        display: flex;
        flex-flow: row wrap;
    }
    section > div {
        flex: 1;
        padding: 0.5rem;
    }
    input[type=radio] {
        display: none;
    }
    input[type=radio]:not(:disabled) ~ label {
        cursor: pointer;
    }
    input[type=radio]:disabled ~ label {
        color: #bcc2bf;
        border-color: #bcc2bf;
        box-shadow: none;
        cursor: not-allowed;
    }
    .labelM {
        height: 100%;
        display: block;
        background: white;
        border: 2px solid #0dcaf0;
        border-radius: 20px;
        padding: 1rem;
        /* margin-bottom: 1rem; */
        text-align: center;
        box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
        position: relative;
    }
    input[type=radio]:checked + label {
        background: #0dcaf0;
        color: white;
        /* box-shadow: 0px 0px 20px rgba(0, 255, 128, 0.75); */
    }
    input[type=radio]:checked + label::after {
        color: #3d3f43;
        border: 2px solid #1dc973;
        box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
    }

    .textRes {
        color: red;
        text-align: center;
    }
    </style>

    <script>
        function onlyNumberKey(evt) { 							
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
                return false; 
            return true; 
        } 

        function sendData() {
            var goodsType = $('input[name="customerGoodsType"]:checked').val();
            if(goodsType == 'shoe' || goodsType == 'bag' || goodsType == 'other') {
                $("#customerGoodsTypeRes").html("");
            }
            else {
                $("#customerGoodsTypeRes").html("* กรุณากรอกเลือกประเภทสินค้า");                
            }

            var goodsBrand = $("#customerGoodsBrand").val();
            if(goodsBrand == '') {
                $("#customerGoodsBrandRes").html("* กรุณาเลือกแบรนด์สินค้า");
            }
            else {
                $("#customerGoodsBrandRes").html("");
            }

            var goodsModel = $("#customerGoodsModel").val();
            if(goodsModel == '') {
                $("#customerGoodsModelRes").html("* กรุณาระบุรุ่นสินค้า");
            }
            else {
                $("#customerGoodsModelRes").html("");
            }

            var goodsDes = $("#customerGoodsDes").val();
            if(goodsDes == '') {
                $("#customerGoodsDesRes").html("* กรุณาระบุอาการ");
            }
            else {
                $("#customerGoodsDesRes").html("");
            }

            var goodsImage1 = document.getElementById("customerGoodsImage1").value;
            if(goodsImage1 == '') {
                $("#customerGoodsImage1Res").html("* กรุณาแนบรูปสินค้า");
            }
            else {
                $("#customerGoodsImage1Res").html("");
            }

            var goodsImage2 = document.getElementById("customerGoodsImage2").value;
            if(goodsImage2 == '') {
                $("#customerGoodsImage2Res").html("* กรุณาแนบรูปสินค้า");
            }
            else {
                $("#customerGoodsImage2Res").html("");
            }

            if( (goodsType == 'shoe' || goodsType == 'bag' || goodsType == 'other') && goodsBrand != '' 
                && goodsModel != '' && goodsDes != '' && goodsImage1 != '' && goodsImage2 != '') {
                $("#formAddData").submit();
                Swal.fire({
                    title: 'กำลังอัพโหลดข้อมูล<br><br>กรุณารถสักครู่',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        swal.showLoading()
                    },
                    background: 'rgba(0, 0, 0, 0)',
                    backdrop: `
                        rgba(255, 255, 255, 0.4)
                    `
                });
            }  
        }
    </script>

</head>
<body>
<?php
$resStatus = $this->session->flashdata('resStatus');
$resStatusText = $this->session->flashdata('resStatusText');
if($resStatus == 1) {
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<span style="color: white;"><?php echo $resStatusText; ?></span>',
            allowEscapeKey: true,
            allowOutsideClick: true,
            showConfirmButton: false,                                                    
            background: 'rgba(0, 0, 0, 1)',
            backdrop: `
                rgba(255, 255, 255, 0.4)
            `
        }); 
    </script>
<?php
}

elseif($resStatus == 2) {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '<span style="color: white;"><?php echo $resStatusText; ?></span>',
                allowEscapeKey: true,
                allowOutsideClick: true,
                showConfirmButton: false,                                                    
                background: 'rgba(0, 0, 0, 1)',
                backdrop: `
                    rgba(255, 255, 255, 0.4)
                `
            }); 
        </script>
    <?php
    }
?> 

    <div class="container-fluid">
        <div class="container">
            <?php 
            if($member) {
            ?>
            <form method="post" action="<?php base_url(); ?>Spa_Cleaning/add_data" enctype="multipart/form-data" accept-charset="utf-8" id="formAddData">
                <input type="hidden" name="line_id" value="<?php echo $line_id; ?>">
                <div class="row mb-3">  
                    <div class="col-12 p-4 pb-3 text-center">
                        <h1>Spa & Cleaning</h1>
                        <h5>* กรอกแบบฟอร์ม</h5>
                    </div> 
                    
                    <div class="col-12 col-xl-3 col-md-1"></div>
                    <div class="col-12 col-xl-6 col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">ข้อมูลสินค้า</h5>
                                <div class="row">
                                    <section>
                                        <div>
                                        <input type="radio" id='r1' name="customerGoodsType" value="bag">
                                        <label class="labelM" for='r1'>
                                            <h5>กระเป๋า <br> (Bag)</h5>
                                            <h1><i class="fas fa-shopping-bag"></i></h1>
                                        </label>
                                        </div>

                                        <div>
                                        <input type="radio" id='r2' name="customerGoodsType" value="shoe">
                                        <label class="labelM" for='r2'>
                                            <h5>รองเท้า <br> (Shoe)</h5>
                                            <h1><i class="fas fa-shoe-prints"></i></h1>
                                        </label>
                                        </div>

                                        <div>
                                        <input type="radio" id='r3' name="customerGoodsType" value="other">
                                        <label class="labelM" for='r3'>
                                            <h5>อื่นๆ <br> (Other)</h5>
                                            <h1><i class="fas fa-ellipsis-h"></i></h1>
                                        </label>
                                        </div>
                                    </section>  
                                    <span class="textRes" id="customerGoodsTypeRes"></span>                              

                                    <div class="col-12 col-xl-6 col-md-6 mt-3">
                                        <div class="form-floating mb-3 text-center">
                                            <select class="form-select form-control" name="customerGoodsBrand" id="customerGoodsBrand">
                                                <option value="">เลือกแบรนด์สินค้า</option>
                                                <?php 
                                                if($brandname) {
                                                    foreach($brandname as $bn) {   
                                                    ?>
                                                        <option value="<?php echo $bn['brand_name']; ?>"><?php echo $bn['brand_name']; ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <label>แบรนด์สินค้า</label>
                                            <span class="textRes" id="customerGoodsBrandRes"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-md-6 mt-3">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="text" class="form-control" placeholder="กรอกรุ่น" maxlength="30" name="customerGoodsModel" id="customerGoodsModel">
                                            <label>รุ่น</label>
                                            <span class="textRes" id="customerGoodsModelRes"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-md-6 mt-1">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="text" class="form-control" placeholder="กรอกขนาด" maxlength="30" name="customerGoodsSize" id="customerGoodsSize">
                                            <label>ขนาด</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-md-6 mt-1">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="text" class="form-control" placeholder="กรอกอาการ" maxlength="50" name="customerGoodsDes" id="customerGoodsDes">
                                            <label>ระบุอาการ</label>
                                            <span class="textRes" id="customerGoodsDesRes"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-md-6 mt-1">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="file" name="customerGoodsImage1" id="customerGoodsImage1" class="form-control" placeholder="อัพโหลดรูป" accept="image/jpg, image/jpeg, image/png">
                                            <label>อัพโหลดรูปที่ 1</label>
                                            <span class="textRes" id="customerGoodsImage1Res"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-md-6 mt-1">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="file" name="customerGoodsImage2" id="customerGoodsImage2" class="form-control" placeholder="อัพโหลดรูป" accept="image/jpg, image/jpeg, image/png">
                                            <label>อัพโหลดรูปที่ 2</label>
                                            <span class="textRes" id="customerGoodsImage2Res"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-12 col-md-12 mt-1 text-center">
                                        <button type="button" class="btn btn-info" onclick="sendData()" id="btnSenddata">ยืนยันส่งข้อมูล</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-3 col-md-1"></div>  
                </div>
            </form>
            <?php
            }
            else {
            ?>
            <div class="row mb-4">  
                <div class="col-12 p-4 text-center">
                    <h1>Spa & Cleaning</h1>
                    <h5>* กรอกแบบฟอร์ม</h5>
                </div> 
                <div class="col-12 col-xl-3 col-md-1"></div>                
                <div class="col-12 col-xl-6 col-md-10 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <br>
                            <div class="row">
                                <div class="col-12 col-xl-12 col-md-12">
                                    <h5>* กรุณากรอกข้อมูลให้ครบถ้วนก่อนใช้บริการ</h5>
                                </div>

                                <div class="col-12 col-xl-12 col-md-12 mt-3">
                                    <button class="btn btn-info" onclick="location.href='<?php echo base_url(); ?>member'">กรอกข้อมูล</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-3 col-md-1"></div>
            </div>
            <?php
            }
            ?>

            
        </div>
    </div>
</body>
</html>
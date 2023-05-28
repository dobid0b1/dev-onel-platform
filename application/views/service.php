
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styleAll.css" rel="stylesheet">
        <title>แบบฟอร์มบริการ</title>
        <link rel="icon" href="<?php echo base_url();?>liff/images/logo.png">

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
                text-align: center;
                box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
                position: relative;
            }
            input[type=radio]:checked + label {
                background: #0dcaf0;
                color: white;
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
    </head>
    <body>
        <div id="showLoading" class="text-center" style="display: none; position: fixed; z-index:999; width: 100%; height: 100%; bottom: 0; opacity: .9; background-color: white;">
            <img src="<?php echo base_url();?>liff/images/loading.gif" alt="" width="100%">
            <br>
            <h4>กำลังอัพโหลดข้อมูล ...</h4>
            <h6>โปรดรอสักครู่ค่ะ</h6>
        </div>

        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header animated fadeInDown"><br>
			<center>
				<h2>แบบฟอร์มบริการ</h2> 
                <i style="color: red;font-size: .8rem">
                    * กรอกข้อมูลให้ครบถ้วน <br>
                    เพื่อความสะดวกในการติดตามสินค้า
                </i>
			</center>

            <form method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                <div class="col-12 mb-2">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating text-center">

                                        <select class="form-select" name="userID"
                                        aria-label="Floating label select example" required>
                                            <option value="">เลือกลูกค้า</option>
                                            <?php
                                                if($allCust){
                                                    foreach($allCust as $aC){
                                                        echo "<option value='".$aC['user_id']."'>".$aC['user_name']."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label>ลูกค้า:</label>
                                    </div>
                                    <i>หากไม่มีรายชื่อลูกค้า <a href="<?php echo base_url(); ?>customer/addCust">click</a></i>
                                </div>
                            </div><hr>

                            <div id="detailProduct">
                                <div class="row">
                                    <section>
                                        <div>
                                            <input type="radio" id='radioBag' name="insertType" value="bag" required>
                                            <label class="labelM" for='radioBag'>
                                                <h5>กระเป๋า <br> (Bag)</h5>
                                                <h1><i class="fas fa-shopping-bag"></i></h1>
                                            </label>
                                        </div>
                                        <div>
                                            <input type="radio" id='radioShoe' name="insertType" value="shoe">
                                            <label class="labelM" for='radioShoe'>
                                                <h5>รองเท้า <br> (Shoe)</h5>
                                                <h1><i class="fas fa-shoe-prints"></i></h1>
                                            </label>
                                        </div>
                                        <div>
                                            <input type="radio" id='radioOther' name="insertType" value="other">
                                            <label class="labelM" for='radioOther'>
                                                <h5>อื่นๆ <br> (Other)</h5>
                                                <h1><i class="fas fa-ellipsis-h"></i></h1>
                                            </label>
                                        </div>
                                    </section>     
                                    <span class="textRes" id="customerGoodsTypeRes"></span> 

                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-control" name="serviceType" required>
                                                <option value="">เลือกประเภทงาน</option>
                                                <option value="spa">Spa & Cleaning</option>
                                                <option value="color">Re-color & Paint</option>
                                                <option value="fix">Fix & repair</option>
                                            </select>
                                            <label>ประเภทงาน:</label>
                                        </div>
                                    </div>

                                    <div class="col-12">

                                        <div class="form-floating mb-3">
                                            <select class="form-select form-control" name="insertBrand" 
                                            id="brand" onchange="ifother()" required>
                                                <option value="">เลือกแบรนด์สินค้า</option>
                                                <?php 
                                                    if($allBrand) {
                                                        foreach($allBrand as $aB) {
                                                            echo '<option value="'.$aB['brand_name'].'">';
                                                            echo $aB['brand_name'];
                                                            echo '</option>';
                                                        }
                                                    }
                                                ?>
                                                <option value="other">อื่นๆ</option>
                                            </select>
                                            <label>แบรนด์สินค้า:</label>
                                        </div>
                                    </div>
                                    <div class="col-12" id="yy" style="display: none;">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder=".." name="brandplus">
                                            <label for="floatingInput">ระบุยี่ห้อ:</label>
                                        </div>
                                    </div>
                                    <script>
                                        function ifother(){
                                            if($('#brand').val() == 'other'){
                                                document.getElementById('yy').style.display = 'block';
                                            }
                                        }
                                    </script>

                                    <div class="col-12">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="text" class="form-control" name="insertSubbrand"
                                            maxlength="30" placeholder=".">
                                            <label>รุ่น:</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="text" class="form-control" name="insertComment"
                                            maxlength="50" placeholder="." required>
                                            <label>ระบุอาการ หรือ สิ่งที่ต้องทำ:</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="file" name="customerGoodsImage1"
                                            id="customerGoodsImage1" class="form-control" 
                                            placeholder="อัพโหลดรูป" required>
                                            <label>อัพโหลดรูปที่ 1</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating mb-3 text-center">
                                            <input type="file" name="customerGoodsImage2" 
                                            id="customerGoodsImage2" class="form-control" 
                                            placeholder="อัพโหลดรูป" required>
                                            <label>อัพโหลดรูปที่ 2</label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <input class="btn btn-primary" type="submit" name="insertBtn"
                                        onclick="insertWS()" value="ส่งข้อมูล">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
        <script>
            // ================= Line liff ===================
                function runApp() {
                    liff.getProfile().then(profile => {
                        $('#lineID').val(profile.userId);
                    }).catch(err => console.error(err));
                }

                liff.init({ liffId: "1656273522-YyORapAx" }, () => {
                    if (liff.isLoggedIn()) {
                        runApp()
                    } 
                    else {
                        liff.login();
                    }
                }, err => console.error(err.code, error.message));
            // ====================================

            function detailProduct(){
                document.getElementById('detailProduct').style.display = 'block';
            }

            function insertWS() {
                var insertType = $('input[name="insertType"]:checked').val();
                if(insertType == 'shoe' || insertType == 'bag' || insertType == 'other') {
                    $("#customerGoodsTypeRes").html("");
                }
                else {
                    $("#customerGoodsTypeRes").html("* กรุณากรอกเลือกประเภทสินค้า");                
                }
            }

            (function () { 'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    else {
                        document.getElementById("showLoading").style.display = 'block';
                    }

                    form.classList.add('was-validated')
                }, false)
                })
            })()
        </script>
    </body>
</html>
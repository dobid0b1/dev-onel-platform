<?php
    date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสมาชิก</title>
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

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header animated fadeInDown"><br>
        <center>
            <h2>แก้ไขข้อมูลสมาชิก</h2> 
            <i style="color: red;font-size: .8rem">
                * กรอกข้อมูลให้ครบถ้วน *
            </i>
        </center>

        <div class="row m-0 mt-3 text-center">
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-center mb-3">ข้อมูลสินค้า</h6>
                        <form method="post" class="row g-3 needs-validation" novalidate>
                            <div class="col-12 col-xl-6 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder=".." name="memberName" autocomplete="off" id="showName" required>
                                    <label>ชื่อลูกค้า:</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" name="memberPhone" placeholder=".." maxlength="10" onkeypress="return onlyNumberKey(event)" id="showPhone" required>
                                    <label>เบอร์โทรศัพท์:</label>
                                </div>
                            </div>

                            <div class="col-12" id="showDataAddress"></div>

                            <div class="col-12" id="test1">
                                <h6 class="card-title text-center mb-3">ที่อยู่ปัจจุบัน (สำหรับจัดส่ง)</h6>
                                <div class="row">
                                    <input type="hidden" class="form-control" id="lineID" name="lineID" required>

                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="memberAddress" placeholder="บ้านเลขที่" maxlength="150" id="showAddress" required>
                                            <label>บ้านเลขที่:</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-control" id="showProvince" onchange="selectProvince(this)" name="nameProvince" required>
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
                                            <label>จังหวัด:</label>
                                        </div>
                                    </div>

                                    <div class="col-12" id="showAmphoe"></div>
                                    <div class="col-12" id="showDistrict"></div>
                                    <div class="col-12" id="showZipcode"></div>
                                    
                                    <div class="col-12 text-center">
                                        <input type="submit" class="btn btn-info" value="บันทึก" name="submitBtn">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- <div class="container-fluid">
        <div class="container">
            <form method="post">
                <div class="row mb-4">  
                    <div class="col-12 p-4 text-center">
                        <h1>ข้อมูลสมาชิก</h1>
                        <h6>* กรอกข้อมูลให้ครบถ้วน *</h6>
                    </div>  
                    
                    <div class="col-12 col-xl-3 col-md-1"></div>                
                    <div class="col-12 col-xl-6 col-md-10 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">ข้อมูลลูกค้า</h5>
                                <br>
                                <input type="hidden" id="lineID" name="lineID">
                                <div class="row">
                                    <div class="col-12 col-xl-6 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder=".." name="memberName" autocomplete="off" id="showName" required>
                                            <label>ชื่อลูกค้า</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control" name="memberPhone" placeholder=".." maxlength="10" onkeypress="return onlyNumberKey(event)" id="showPhone" required>
                                            <label>เบอร์โทรศัพท์</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-3 col-md-1"></div>
                    <div class="col-12 col-xl-3 col-md-1"></div>

                    <div class="col-12 col-xl-6 col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">ที่อยู่ปัจจุบัน (สำหรับจัดส่ง)</h5>
                                <div class="row">

                                    <div class="col-12 col-xl-6 col-md-6 mt-2">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="memberAddress" placeholder="บ้านเลขที่" maxlength="150" id="showAddress" required>
                                            <label>บ้านเลขที่</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-md-6 mt-2">
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-control" id="showProvince" onchange="selectProvince(this)" name="nameProvince" required>
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
                                            <label>จังหวัด</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 col-md-6 mt-2" id="showAmphoe"></div>
                                    <div class="col-12 col-xl-6 col-md-6 mt-2" id="showDistrict"></div>
                                    <div class="col-12 col-xl-6 col-md-6 mt-2" id="showZipcode"></div>
                                    
                                    <div class="col-12 col-xl-12 col-md-12 mt-1 text-center">
                                        <input type="submit" class="btn btn-info" value="แก้ไขข้อมูล" name="submitBtn">
                                        <a href="<?php echo base_url();?>member">
                                            <button type="button" class="btn btn-danger">ยกเลิก</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-3 col-md-1"></div>  
                </div>
            </form>
        </div>
    </div> -->
    <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
        // ================= Line liff ===================
            function runApp() {
                liff.getProfile().then(profile => {
                    $('#lineID').val(profile.userId);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url(); ?>liff/member/checkDataMember",
                        data: {lineID: profile.userId},   
                        cache: false,
                        async: 1,
                        
                        success: function(result){ 
                            var obj = $.parseJSON(result);
                            var len = obj.length;

                            $('#showName').val(obj[0].user_name);
                            $('#showPhone').val(obj[0].user_phone);
                            $('#showAddress').val(obj[0].user_address);
                        }
                    });
                }).catch(err => console.error(err));
            }

            liff.init({ liffId: "1656273522-ZXYxrzd6" }, () => {
                if (liff.isLoggedIn()) {
                    runApp()
                } else {
                    liff.login();
                }
            }, err => console.error(err.code, error.message));
        // ====================================

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
                url: "<?php echo base_url(); ?>liff/member/selectAmphoe",
                data: {province: nameProvince},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;
                    let dataAmphoe = ``;
                    dataAmphoe += `
                        <div class="form-floating mb-3">
                        <select class="form-select form-control" onchange="selectAmphoe(this)" name="nameAmphoe" required>
                        <option value="">เลือกอำเภอ/เขต</option>`;
                        if(len > 0) {
                            for(x=0;x<len;x++){
                                dataAmphoe += `<option value="${obj[x].amphoe}">${obj[x].amphoe}</option>`;
                            }
                        }     
                    dataAmphoe += `</select><label>อำเภอ/เขต:</label></div>`;
                    $('#showAmphoe').html(dataAmphoe);
                }
            });
        }

        function selectAmphoe(nameAmphoe){
            var nameAmphoe = nameAmphoe.value;
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>liff/member/selectDistrict",
                data: {amphoe: nameAmphoe},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;
                    let dataDistrict = ``;
                    dataDistrict += `
                        <div class="form-floating mb-3">
                        <select class="form-select form-control" onchange="selectZipcode(this)" name="nameDistrict" required>
                        <option value="">เลือกตำบล/แขวง</option>`;
                        if(len > 0) {
                            for(x=0;x<len;x++){
                                dataDistrict += `<option value="${obj[x].district}">${obj[x].district}</option>`;
                            }
                        }     
                    dataDistrict += `</select><label>ตำบล/แขวง:</label></div>`;
                    $('#showDistrict').html(dataDistrict);
                }
            });
        }

        function selectZipcode(nameDistrict){
            var nameDistrict = nameDistrict.value;
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>liff/member/selectZipcode",
                data: {district: nameDistrict},   
                cache: false,
                async: 1,
                
                success: function(result){ 
                    var obj = $.parseJSON(result);
                    var len = obj.length;
                    let dataZipcode = ``;
                    if(len > 0) {
                        dataZipcode += `<div class="form-floating mb-3">`;
                        dataZipcode += `<input type="email" class="form-control" name="zipcode" value="${obj[0].zipcode}" maxlength="5" readonly>`;
                        dataZipcode += `<label>รหัสไปรษณีย์:</label></div>`;
                    } 
                    $('#showZipcode').html(dataZipcode);
                }
            });
        }

        // function windowClose() {
        //     window.open('','_parent','');
        //     window.close();
        // }

        (function () { 'use strict'

        var forms = document.querySelectorAll('.needs-validation')

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
</body>
</html>
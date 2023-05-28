<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body>
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
            <a href="../service">
                <button type="button" class="btn btn-secondary">ยกเลิก</button>
            </a>
        </div>
    </form>

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
                        id="showAmphoe" onchange="selectAmphoe(this)" name="addAmphoe" required>
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

        function selectAmphoe(nameAmphoe){
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
                        id="showDistrict" onchange="selectZipcode(this)" name="addDistrict" required>
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

        function selectZipcode(nameDistrict){
            var nameDistrict = nameDistrict.value;
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>customer/selectZipcode",
                data: {district: nameDistrict},   
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
</body>
</html>
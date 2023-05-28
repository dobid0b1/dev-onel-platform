<?php date_default_timezone_set("Asia/Bangkok"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>A D D W O R K S H E E T | W E B &nbsp; M A N A G E</title>
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
                                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>เพิ่มใบงาน
                                    <div class="page-title-subheading">
                                        เพิ่มใบงาน
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-6" id="selectCust">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="col-6">เลือกลูกค้า</div>
                                    <div class="col-6 text-right">
                                        <a href="<?php echo base_url();?>customer">
                                            <button class="btn btn-success">+ เพิ่มลูกค้า</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive p-3">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="nameCust" aria-label="Floating label select example">
                                            <option value="">เลือกลูกค้า</option>
                                            <?php 
                                                if($allCust){
                                                    foreach($allCust as $aC){
                                                        echo '<option value="'.$aC['user_id'].'">'.$aC['user_name'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label for="floatingInput">ชิ่อลูกค้า:</label>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-info" onclick="showDetail()">เพิ่มสินค้า</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id="addDetail" style="display:none;">
                            <div class="main-card mb-3 card">
                                <div class="card-header">รายละเอียดสินค้า</div>

                                <form method="post" enctype="multipart/form-data" 
                                class="row g-3 needs-validation" novalidate>
                                    <div class="table-responsive p-3">
                                        <div class="row p-3">
                                            <div class="col-4">
                                                <input type="radio" class="btn-check" name="custType" id="success-tt" value="bag" autocomplete="off" checked>
                                                <label class="btn btn-outline-primary p-2 col-12" for="success-tt">
                                                    <i class="fas fa-shopping-bag"></i><br>
                                                    กระเป๋า
                                                </label>
                                            </div>

                                            <div class="col-4">
                                                <input type="radio" class="btn-check" name="custType" id="warning-outlined" value="shoe"autocomplete="off">
                                                <label class="btn btn-outline-primary p-2 col-12" for="warning-outlined">
                                                    <i class="fas fa-shoe-prints"></i><br>
                                                    รองเท้า
                                                </label>
                                            </div>

                                            <div class="col-4">
                                                <input type="radio" class="btn-check" name="custType" id="danger-outlined" value="other" autocomplete="off">
                                                <label class="btn btn-outline-primary p-2 col-12" for="danger-outlined">
                                                    <i class="fas fa-ellipsis-h"></i><br>
                                                    อื่นๆ
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row p-3">
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Floating label select example" name="serviceType" required>
                                                        <option value="">เลือกประเภท</option>
                                                        <option value="spa">Spa & Cleaning</option>
                                                        <option value="color">Recolor & Paint</option>
                                                        <option value="fix">Fix & Repair</option>
                                                    </select>
                                                    <label for="floatingSelect">ประเภท:</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Floating label select example" 
                                                    name="brand" id="brand" onchange="ifother()" required>
                                                        <option value="">เลือกแบรนด์สินค้า</option>
                                                        <?php 
                                                            if($allBrand) {
                                                                foreach($allBrand as $aB) {   
                                                                ?>
                                                                    <option value="<?php echo $aB['brand_name']; ?>"><?php echo $aB['brand_name']; ?></option>
                                                                <?php
                                                                }
                                                            }
                                                        ?>
                                                        <option value="other">อื่นๆ</option>
                                                    </select>
                                                    <label for="floatingSelect">ยี่ห้อ:</label>
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
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" placeholder=".." name="subbrand">
                                                    <label for="floatingInput">รุ่น:</label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" placeholder=".." name="comment" required>
                                                    <label for="floatingInput">ระบุอาการ:</label>
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
                                        </div>
                                        <input type="hidden" name="custID" id="custID">
                                        <center>
                                            <input type="submit" name="confirmBtn" class="btn btn-info" value="เปิดใบงาน">
                                        </center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        
                    
                </div>
                <?php require_once('menu/footer.php'); ?>
            </div>
        </div>
    </div>
    <script>
        function showDetail(){
            if($('#nameCust').val()){
                $('#custID').val($('#nameCust').val());
                document.getElementById("addDetail").style.display = "block";
            }else{
                console.log(0);
            }
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
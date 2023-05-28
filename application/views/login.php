<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOGIN | W E B &nbsp; M A N A G E</title>
        <link rel="icon" href="<?php echo base_url();?>images/logo.png">

        <!-- ----------------- STYLE ----------------- -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
            <link rel="stylesheet" href="<?php echo base_url();?>css/styleAll.css">
            <link rel="stylesheet" href="<?php echo base_url();?>css/loginNew.css">
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
    <body">
        <div class="wrapper">
            <div class="row" style="margin-top: 15%">
                <div class="col-4"></div>
                <div class="col-4">
                    
                    <div class="col-12 text-center">
                        <form method="post" class="row g-3 needs-validation" novalidate>
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12 mb-3 text-center">
                                        <h5>เข้าสู่ระบบ</h5>
                                        <i class="text-danger">* กรุณากรอกข้อมูลให้ครบถ้วน</i>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="userLogin" 
                                            placeholder="username" autocomplete="off" required>
                                            <label for="floatingInput">ชื่อผู้ใช้:</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="passLogin"placeholder="password" required>
                                            <label for="floatingInput">รหัสผ่าน:</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" class="btn btn-primary" name="btnLogin"value="เข้าสู่ระบบ">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <?php
            $status = $this->session->flashdata('status');
            if($status == 2) {
        ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเข้าสู่ระบบได้',
                    html: 'ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง<br>กรุณาลองใหม่อีกครั้ง',
                    confirmButtonText: `ลองอีกครั้ง`,
                })
            </script>
        <?php } ?>
        <script>
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
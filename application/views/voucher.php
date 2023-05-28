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
                $('#tableCust').DataTable({
                    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
                    "order": [[ 2, "desc" ]],
                    "ajax": '<?php echo base_url('voucher/allReVoucher');?>',
                    "columnDefs": [
                        { "width": "10%", "targets": 0 },
                        { "width": "25%", "targets": 1 },
                        { "width": "25%", "targets": 2 },
                        { "width": "20%", "targets": 3 },
                        { "width": "20%", "targets": 4 }
                    ]
                });

                $('#reVoucher').DataTable({
                    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
                    "order": [[ 3, "desc" ]],
                    "ajax": '<?php echo base_url('voucher/reVoucher');?>',
                    "columnDefs": [
                        { "width": "10%", "targets": 0 },
                        { "width": "25%", "targets": 1 },
                        { "width": "25%", "targets": 2 },
                        { "width": "25%", "targets": 3 },
                        { "width": "15%", "targets": 4 }
                    ]
                });
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
                                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>การจัดการส่วนลด
                                    <div class="page-title-subheading">
                                        รายละเอียดการรับส่วนลด
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>  

                    <div class="row m-0">
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="col-6">ลูกค้ารับที่ส่วนลด</div>
                                </div>
                                
                                <div class="table-responsive p-3">
                                    <table id="tableCust" width="100%" style="font-size: .8rem;"
                                    class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">รายชื่อลูกค้า</th>
                                                <th class="text-center">วันที่รับส่วนลด</th>
                                                <th class="text-center">ส่วนลด</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="col-6">ประวัติการรับส่วนลด</div>
                                </div>
                                
                                <div class="table-responsive p-3">
                                    <table id="reVoucher" width="100%" style="font-size: .8rem;"
                                    class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">รายชื่อลูกค้า</th>
                                                <th class="text-center">วันที่ลูกค้ารับส่วนลด</th>
                                                <th class="text-center">วันที่ใช้ส่วนลด</th>
                                                <th class="text-center">ส่วนลด</th>
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

    <script>
        function useVoucher(uID, lvID){
            console.log(uID);
            console.log(lvID);

            $.ajax({
                type: 'post',
                url: '<?php echo base_url();?>voucher/updateV',
                data: {uID: uID, lvID: lvID},
                cache: 0,
                async: 1,

                success: function(resp){
                    let timerInterval

                    Swal.fire({
                        title: 'สำเร็จ',
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

        function onlyNumberKey(evt) {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
                return false; 
            return true; 
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


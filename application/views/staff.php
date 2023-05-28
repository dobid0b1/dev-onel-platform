<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>S T A F F | W E B &nbsp; M A N A G E</title>
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
                    "lengthMenu": [[5, 20, 50, -1], [5, 20, 50, "All"]],
                    "order": [[ 0, "desc" ]],
                    "ajax": '<?php echo base_url('staff/allStaff');?>',
                    "columnDefs": [
                        { "width": "10%", "targets": 0 },
                        { "width": "35%", "targets": 1 },
                        { "width": "20%", "targets": 2 },
                        { "width": "20%", "targets": 3 },
                        { "width": "15%", "targets": 4 }
                    ]
                });
                setInterval( function () {
                    tableCust.ajax.reload();
                }, 2000 );
            } );
            
            function infoStaff(staffID){
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url();?>staff/infoStaff",
                    data: {staffID: staffID},
                    cache: 0,
                    async: 1,

                    success: function(resp){
                        var obj = $.parseJSON(resp);
                        var len = obj.length;

                        console.log(obj);
                        $('#updateUser').val(obj[0].staff_username);
                        $('#updatePass').val(obj[0].staff_password);
                        $('#updateName').val(obj[0].staff_name);
                        $('#updatePosition').val(obj[0].staff_position);
                        $('#updateLevel').val(obj[0].staff_level);
                        $('#staffID').val(obj[0].staff_id);

                        let btnSus = ``;
                        if(obj[0].staff_flag == '0'){
                            btnSus = `<button type="button" onclick="changeFlag(${obj[0].staff_id}, 1)" 
                                    class="btn btn-success" data-bs-dismiss="modal">เปิดใช้งานบัญชี</button>`;
                        }else{
                            btnSus = `<button type="button" onclick="changeFlag(${obj[0].staff_id},0)" 
                                    class="btn btn-danger" data-bs-dismiss="modal">ระงับบัญชี</button>`;
                        }
                        $('#btnSus').html(btnSus);

                        $('#infoStaff').modal('show');
                    }
                });
            }

            function changeFlag(staffID, flag){
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url();?>staff/changeFlag',
                    data: {staffID: staffID,
                            flag: flag},
                    cache: 0,
                    async: 1,

                    success: function(resp){
                        let timerInterval
                        if(flag == 0){
                            text = 'ระงับบัญชีสำเร็จ';
                        }else{
                            text = 'เปิดใช้งานบัญชีสำเร็จ';
                        }
                        Swal.fire({
                            title: text,
                            timer: 1500,
                            timerProgressBar: true,
                            showCancelButton: false,
                            showConfirmButton: false,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                    }
                });
            }

            function addStaff(){
                $('#addStaff').modal('show');
            }
        </script>
    <!-- ------------------------------------------ -->
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php require_once('menu/topBar.php'); ?>
        <div class="app-main">
            <?php require_once('menu/sideBar.php'); ?>

            <div class="app-main__outer m-0">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>ตั้งค่าพนักงาน
                                    <div class="page-title-subheading">
                                        ข้อมูลพนักงาน, ระงับบัญชี
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-12">
                            <div class="main-card card">
                                <div class="card-header p-0">
                                    <div class="col-6">รายชื่อพนักงาน</div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-success" onclick="addStaff()">+ เพิ่มพนักงาน</button>
                                    </div>
                                </div>
                                <div class="table-responsive p-3">
                                    <table id="tableCust" width="100%" style="font-size: .8rem;"
                                    class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">รายชื่อพนักงาน</th>
                                                <th class="text-center">ตำแหน่ง</th>
                                                <th class="text-center">ระดับ</th>
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

    <div class="modal fade" id="infoStaff" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ข้อมูลพนักงาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="updateUser" id="updateUser" placeholder=".." required>
                        <label for="floatingInput">Username:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="updatePass" id="updatePass" placeholder=".." required>
                        <label for="floatingInput">Password:</label>
                    </div>
                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="updateName" id="updateName" placeholder=".." required>
                        <label for="floatingInput">ชื่อ:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input list="position" class="form-control" name="updatePosition"
                        placeholder=".." autocomplete="off" id="updatePosition" required>
                        <datalist id="position">
                            <?php
                                foreach($datalistPosotion as $dlP){
                                    echo '<option value="'.$dlP['staff_position'].'">';
                                }
                            ?>
                        </datalist>
                        <label for="floatingInput">ตำแหน่ง:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="updateLevel" id="updateLevel"
                        aria-label="Floating label select example" required>
                            <option value="staff">พนักงาน</option>
                            <option value="manager">ผู้จัดการ</option>
                            <option value="admin">ผู้ดูแลระบบ</option>
                        </select>
                        <label for="floatingInput">ระดับ:</label>
                    </div>
                    <input type="hidden" id="staffID" name="staffID">
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="updateBtn" value="ยืนยันการแก้ไข">
                    <div id="btnSus"></div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addStaff" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มพนักงาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post" class="g-3 needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="addUserName" placeholder=".." required>
                                    <label for="floatingInput">Username:</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="addPassword" placeholder=".." required>
                                    <label for="floatingInput">Password:</label>
                                </div>
                            </div>
                            <div class="col-12"><hr></div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="addName" placeholder=".." required>
                                    <label for="floatingInput">ชื่อ:</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input list="position" class="form-control" name="addPosition"
                                    placeholder=".." autocomplete="off" required>
                                    <datalist id="position">
                                        <?php
                                            foreach($datalistPosotion as $dlP){
                                                echo '<option value="'.$dlP['staff_position'].'">';
                                            }
                                        ?>
                                    </datalist>
                                    <label for="floatingInput">ตำแหน่ง:</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating">
                                    <select class="form-select" name="addLevel"
                                    aria-label="Floating label select example" required>
                                        <option value="">เลือกระดับพนักงาน</option>
                                        <option value="staff">พนักงาน</option>
                                        <option value="manager">ผู้จัดการ</option>
                                        <option value="admin">ผู้ดูแลระบบ</option>
                                    </select>
                                    <label for="floatingSelect">ระดับพนักงาน:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="confirmBtn" class="btn btn-primary" value="เพิ่มพนักงาน">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </form>




            </div>
        </div>
    </div>

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
<body>
</html>


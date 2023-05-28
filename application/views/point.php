<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>C R E D I T | W E B &nbsp; M A N A G E</title>
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
                                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>ตั้งค่าคะแนนสะสม
                                    <div class="page-title-subheading">
                                        
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>  


                    <div class="row m-0">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="col-6">รายละเอียดคะแนนสะสม</div>
                                    <!-- <div class="col-6 text-right">
                                        <button class="btn btn-success" onclick="addCust()">+ เพิ่มคูปอง</button>
                                    </div> -->
                                </div>
                                <div class="row p-3">
                                <?php 
                                    if($allVoucher){
                                        foreach($allVoucher as $aV){
                                ?>
                                    <div class="col-4">
                                        <div class="main-card mb-3 card">
                                            <div class="card-header">
                                                <div class="col-12"><?php echo $aV['voucher_name'];?></div>
                                            </div>   

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" readonly
                                                            value="<?php echo $aV['voucher_user_point'];?>" placeholder="..">
                                                            <label for="floatingInput">คะแนน:</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" readonly
                                                            value="<?php echo $aV['voucher_discount'];?>" placeholder="..">
                                                            <label for="floatingInput">ส่วนลด:</label>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-12 text-center">
                                                        <button class="btn btn-warning">Edit</button>
                                                        <button class="btn btn-danger">delete</button>
                                                    </div> -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php require_once('menu/footer.php'); ?>
            </div>
        </div>
    </div>



<body>
</html>
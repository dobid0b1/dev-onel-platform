<div class="app-header header-shadow">
    <div class="app-header__logo">
        Craftbrand Service Center
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>  

    <div class="app-header__content m-0">
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="<?php echo base_url();?>images/logo.png" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <button type="button" tabindex="0" class="dropdown-item" onclick="location.href='<?php echo base_url(); ?>dashboard'">Dashboard</button>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item" onclick="location.href='<?php echo base_url(); ?>logout'">ออกจากระบบ</button>
                                </div>
                            </div>

                        </div>
                        <div class="widget-content-left  ml-3 header-user-info text-right">
                            <div class="widget-heading">
                                ชื่อผู้ใช้: <?php echo $this->session->userdata('staff_ses_name'); ?>
                            </div>
                            <div class="widget-subheading">
                                ระดับ: 
                                <?php
                                    if($this->session->userdata('staff_ses_level') == 'manager'){
                                        echo "ผู้จัดการ";
                                    }else if($this->session->userdata('staff_ses_level') == 'staff'){
                                        echo "พนักงาน";
                                    }else{
                                        echo "ผู้ดูแลระบบ";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
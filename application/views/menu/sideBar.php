<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
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
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboard</li>
                <li>
                    <a href="<?php echo base_url();?>dashboard">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>

                <li class="app-sidebar__heading">การจัดการลูกค้า</li>
                <li>
                    <a href="<?php echo base_url();?>customer">
                        <i class="metismenu-icon pe-7s-users"></i>
                        การจัดการลูกค้า
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-ticket"></i>
                        การจัดการส่วนลด
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>voucher">
                                <i class="metismenu-icon"></i>
                                สมาชิกรับส่วนลด
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>point">
                                <i class="metismenu-icon"></i>
                                จัดการส่วนลด
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="app-sidebar__heading">การจัดการใบงาน</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        ใบงาน
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>worksheet">
                                <i class="metismenu-icon"></i>
                                ใบงานทั้งหมด
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>worksheet/addWorksheet">
                                <i class="metismenu-icon"></i>
                                เพิ่มใบงาน
                            </a>
                        </li>
                    </ul>
                </li>

                <?php 
                $staff_level = $this->session->userdata('staff_ses_level');
                if($staff_level == 'admin' || $staff_level == 'manager') {
                ?>
                <li class="app-sidebar__heading">การจัดการรายงาน</li>
                <li>
                    <a href="#">
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        รายงาน
                        <i class="metismenu-icon pe-7s-note2"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>credit_report">
                                <i class="metismenu-icon"></i>
                                รายงานการเงิน
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>customer_report">
                                <i class="metismenu-icon"></i>
                                รายงานบุคคล
                            </a>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url();?>staff_report">
                                <i class="metismenu-icon"></i>
                                รายงานพนักงาน
                            </a>
                        </li> -->
                     </ul>
                </li>
                <!--<li>-->
                <!--    <a href="#">-->
                <!--        ภาพรวมการเงิน-->
                <!--        <i class="metismenu-icon pe-7s-note2"></i>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="app-sidebar__heading">การตั้งค่า</li>
                <!-- <li>
                    <a href="<?php echo base_url();?>point">
                        <i class="metismenu-icon pe-7s-ticket"></i>
                            ตั้งค่าคะแนนสะสม
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo base_url();?>staff">
                        <i class="metismenu-icon pe-7s-users"></i>
                            ตั้งค่าพนักงาน
                    </a>
                    
                </li>
                <?php
                }                
                ?>
            </ul>
        </div>
    </div>
</div>
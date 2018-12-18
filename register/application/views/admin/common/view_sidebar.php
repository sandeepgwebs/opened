<div class="sidebar-scroll">
    <div id="sidebar" class="nav-collapse collapse">

        <ul class="sidebar-menu">
            <li class="sub-menu active">
                <a class="" href="<?php echo base_url($this->config->item('admin_folder') . 'dashboard');?>">
                    <i class="icon-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-user"></i>
                    <span>Registrations</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="<?php echo base_url($this->config->item('admin_folder') . 'manage_registrations');?>">Manage Registrations</a></li>
                    <li><a class="" href="<?php echo base_url($this->config->item('admin_folder') . 'manage_fee');?>">Manage Fee</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-file-text"></i>
                    <span>Content</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="<?php echo base_url($this->config->item('admin_folder') . 'manage_content');?>">Content</a></li>
                </ul>
            </li>


        </ul>
    </div>
</div>
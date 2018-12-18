<div id="header" class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <div class="sidebar-toggle-box hidden-phone">
                <div class="icon-reorder"></div>
            </div>
            <!--<a class="brand" href="<?php /*echo base_url($this->config->item('admin_folder'));*/?>dashboard"><img src="<?php /*echo base_url('images/logo.png');*/?>" /></a>-->

            <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="arrow"></span>
            </a>

            <div class="top-nav ">
                <ul class="nav pull-right top-menu" >
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="username"><?php echo $this->user->getusername()."(". $this->user->getuserid() .")"; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="<?php echo base_url($this->config->item('admin_folder'));?>changepassword"><i class="icon-cog"></i> My Settings</a></li>
                            <li><a href="<?php echo base_url($this->config->item('admin_folder'));?>logout"><i class="icon-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
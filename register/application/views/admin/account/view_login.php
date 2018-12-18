<?php $this->load->view('admin/common/view_header');?>
<!-- BEGIN BODY -->

<body class="lock">
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <a class="center" id="logo" href="<?php echo base_url();?>">
            <!--<img class="center" alt="logo" src="<?php /*echo base_url();*/?>images/logo.png">-->
        </a>
        <!-- END LOGO -->
    </div>
    <div class="login-wrap">
        <?php
            if(isset($invalid) && $invalid == true) {
                ?>
                <div class="notify">
                    <div class="alert alert-block alert-error fade in">
                        <button data-dismiss="alert" class="close" type="button">×</button>
                        <p><i class="icon-remove"></i> Invalid Login Details</p>
                    </div>
                </div>
            <?php
            }
        ?>


        <div class="metro single-size red">
            <div class="locked">
                <i class="icon-lock"></i>
                <span>Login</span>
            </div>
        </div>

        <form action="<?php echo $action;?>" method="post">
            <div class="metro double-size green">
                <div class="input-append lock-input">
                    <input type="text" name="username" class="" placeholder="Username">
                </div>
            </div>
            <div class="metro double-size yellow">
                <div class="input-append lock-input">
                    <input type="password" name="password" class="" placeholder="Password">
                </div>
            </div>
            <div class="metro single-size terques login">
                <button type="submit" class="btn login-btn">
                    Login
                    <i class="icon-long-arrow-right"></i>
            </div>
        </form>

    </div>
    <?php $this->load->view('admin/common/view_footer');?>
</body>
<!-- END BODY -->
</html>